<?php


use ArmoredCore\Interfaces\ResourceControllerInterface;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\View;

class UserAppController extends BaseAuthController implements ResourceControllerInterface
{

    public function index()
    {
        $this->loginFilterbyRole('admin');
        $user = User::all(array('conditions' => array('role != ?', 'passageiro')));
        return View::make('user.index', ['user' => $user]);
    }

    public function create()
    {
        $this->loginFilterbyRole('admin');
        View::make('user.create');
    }

    public function store()
    {
        $this->loginFilterbyRole('admin');
        //create new resource (activerecord/model) instance with data from POST
        //your form name fields must match the ones of the table fields
        $user = new User(Post::getAll());

        if($user->is_valid()){
            $user->save();
            Redirect::toRoute('user/index');
        } else {
            //redirect to form with data and errors
            Redirect::flashToRoute('user/create', ['user' => $user]);
        }
    }

    public function show($id)
    {
        return $this->index();
    }

    public function edit($id)
    {
        $this->loginFilterbyRole('admin');
        $user = User::find([$id]);

        if (is_null($user)) {
            //TODO redirect to standard error page
        } else {
            return View::make('user/edit', ['user' => $user]);
        }
    }

    public function update($id)
    {
        $this->loginFilterbyRole('admin');
        //find resource (activerecord/model) instance where PK = $id
        //your form name fields must match the ones of the table fields
        $user = User::find([$id]);
        $user->update_attributes(Post::getAll());

        if($user->is_valid()){
            $user->save();
            Redirect::toRoute('user/index');
        } else {
            //redirect to form with data and errors
            Redirect::flashToRoute('user/edit', ['user' => $user]);
        }
    }

    public function destroy($id)
    {
        $this->loginFilterbyRole('admin');
        $user = User::find([$id]);
        $user->delete();
        Redirect::toRoute('user/index');
    }
}