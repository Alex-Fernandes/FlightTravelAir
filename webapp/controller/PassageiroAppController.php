<?php

use ArmoredCore\WebObjects\Debug;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\View;

class PassageiroAppController extends BaseAuthController
{

    public function index()
    {
        $this->loginFilterbyRole('passageiro');
        return View::make('passageiro.start');
    }

    public function voos(){
        $this->loginFilterbyRole('passageiro');
        $user = User::find([$_SESSION['APPuserid']]);
        $layover = Layover::all(array('order' => 'dateorigin asc'));
        return View::make('passageiro.index', ['user' => $user, 'layover' => $layover]);
    }

    public function profile()
    {
        $this->loginFilterbyRole('passageiro');
        $user = User::find([$_SESSION['APPuserid']]);
        return View::make('passageiro.profile', ['user' => $user]);
    }

    public function edit($id)
    {
        $this->loginFilterbyRole('passageiro');
        $user = User::find([$id]);

        if (is_null($user)) {
            //TODO redirect to standard error page
        } else {
            return View::make('passageiro/edit', ['user' => $user]);
        }
    }

    public function update($id)
    {
        $this->loginFilterbyRole('passageiro');
        //find resource (activerecord/model) instance where PK = $id
        //your form name fields must match the ones of the table fields
        $user = User::find([$id]);
        $user->update_attributes(Post::getAll());

        if($user->is_valid()){
            $user->save();
            Redirect::toRoute('passageiro/index', $user->id);
        } else {
            //redirect to form with data and errors
            Redirect::flashToRoute('passageiro/edit', ['user' => $user], $user->id);
        }
    }

}