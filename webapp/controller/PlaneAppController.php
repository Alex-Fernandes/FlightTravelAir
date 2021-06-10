<?php

use ArmoredCore\Interfaces\ResourceControllerInterface;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\View;

class PlaneAppController extends BaseAuthController implements ResourceControllerInterface
{

    public function index()
    {
        $this->loginFilterbyRole('gestorvoo');
        $plane = Plane::all();
        return View::make('plane.index', ['planes' => $plane]);
    }

    public function create()
    {
        $this->loginFilterbyRole('gestorvoo');
        return View::make('plane.create');
    }

    public function store()
    {
        $this->loginFilterbyRole('gestorvoo');
        //create new resource (activerecord/model) instance with data from POST
        //your form name fields must match the ones of the table fields
        $plane = new Plane(Post::getAll());

        if($plane->is_valid()){
            $plane->save();
            Redirect::toRoute('plane/index');
        } else {
            //redirect to form with data and errors
            Redirect::flashToRoute('plane/create', ['planes' => $plane]);
        }
    }

    public function show($id)
    {
        $this->loginFilterbyRole('gestorvoo');
        $plane = Plane::find([$id]);

        if (is_null($plane)) {
            //TODO redirect to standard error page
        } else {
            return View::make('plane.show', ['planes' => $plane]);
        }
    }


    public function edit($id)
    {
        $this->loginFilterbyRole('gestorvoo');
        $plane = Plane::find([$id]);

        if (is_null($plane)) {
            //TODO redirect to standard error page
        } else {
            return View::make('plane.edit', ['planes' => $plane]);
        }
    }


    public function update($id)
    {
        $this->loginFilterbyRole('gestorvoo');
        //find resource (activerecord/model) instance where PK = $id
        //your form name fields must match the ones of the table fields
        $plane = Plane::find([$id]);
        $plane->update_attributes(Post::getAll());

        if($plane->is_valid()){
            $plane->save();
            Redirect::toRoute('plane/index');
        } else {
            //redirect to form with data and errors
            Redirect::flashToRoute('plane/edit', ['planes' => $plane]);
        }
    }


    public function destroy($id)
    {
        $this->loginFilterbyRole('gestorvoo');
        $plane = Plane::find([$id]);
        $plane->delete();
        Redirect::toRoute('plane/index');
    }
}