<?php


use ArmoredCore\Interfaces\ResourceControllerInterface;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\View;

class PlaneLegsAppController extends BaseAuthController implements ResourceControllerInterface
{


    public function index()
    {
        $this->loginFilterbyRole('gestorvoo');
        $planes = Plane::all();
        $planeslegs = Planelegs::all();
        return View::make('planelegs.index', ['planes' => $planes, 'planelegs' => $planeslegs]);
    }

    public function create()
    {
        $this->loginFilterbyRole('gestorvoo');
        $planes = Plane::all();
        $legs = Legs::all();
        return View::make('planelegs.create', ['planes' => $planes, 'legs' => $legs]);
    }

    public function createCustom($legs)
    {
        $this->loginFilterbyRole('gestorvoo');
        $planes = Plane::all();
        $legs = Legs::all(array('idvoo' => array('role == ?', $legs)));
        return View::make('planelegs.create', ['planes' => $planes, 'legs' => $legs]);
    }

    public function store()
    {
        $this->loginFilterbyRole('gestorvoo');
        //create new resource (activerecord/model) instance with data from POST
        //your form name fields must match the ones of the table fields
        $planeLegs = new Planelegs(Post::getAll());

        if($planeLegs->is_valid()){
            $planeLegs->save();
            Redirect::toRoute('planelegs/index');
        } else {
            //redirect to form with data and errors
            Redirect::flashToRoute('planelegs/create', ['planelegs' => $planeLegs]);
        }
    }

    public function show($id)
    {
        $this->loginFilterbyRole('gestorvoo');
        $planeLegs = Planelegs::find([$id]);

        if (is_null($planeLegs)) {
            //TODO redirect to standard error page
        } else {
            return View::make('planelegs.show', ['planelegs' => $planeLegs]);
        }
    }

    public function edit($id)
    {
        $this->loginFilterbyRole('gestorvoo');
        $planeLegs = Planelegs::find([$id]);
        $planes = Plane::all();
        $legs = Legs::all();

        if (is_null($planeLegs)) {
            //TODO redirect to standard error page
        } else {
            return View::make('planelegs.edit', ['planelegs' => $planeLegs, 'planes' => $planes, 'legs' => $legs]);
        }
    }

    public function update($id)
    {
        $this->loginFilterbyRole('gestorvoo');
        //find resource (activerecord/model) instance where PK = $id
        //your form name fields must match the ones of the table fields
        $planeLegs = Planelegs::find([$id]);
        $planeLegs->update_attributes(Post::getAll());

        if($planeLegs->is_valid()){
            $planeLegs->save();
            Redirect::toRoute('planelegs/index');
        } else {
            //redirect to form with data and errors
            Redirect::flashToRoute('planelegs/edit', ['planelegs' => $planeLegs]);
        }
    }

    public function destroy($id)
    {
        $this->loginFilterbyRole('gestorvoo');
        $planeLegs = Planelegs::find([$id]);
        $planeLegs->delete();
        Redirect::toRoute('planelegs/index');
    }
}