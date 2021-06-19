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
        $airport = Airports::all();
        $date = date('Y-m-d', time());
        $layover = Layover::all(array('conditions' => array('dateend >= ?', $date)  ,'order' => 'dateorigin asc'));
        return View::make('passageiro.voos', ['user' => $user, 'layover' => $layover, 'airport' => $airport]);
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

    public function selectdropdown(){
        $this->loginFilterbyRole('passageiro');
        $selection = Post::getAll();
        $date = date('Y-m-d', time());
        $airport = Airports::all();
        $layover = Layover::all(array('conditions' => array('idaeroportodestino = ? and dateend >= ?', $selection, $date) ,'order' => 'dateorigin asc'));
        return View::make('passageiro.voos', ['layover' => $layover, 'airport' => $airport]);

    }

}