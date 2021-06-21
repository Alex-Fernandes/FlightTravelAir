<?php


use ArmoredCore\Interfaces\ResourceControllerInterface;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\View;

class LayoverPlanesController extends BaseAuthController
{

    public function index()
    {
        $this->loginFilterbyRole('gestorvoo');
        $planes = Plane::all();
        $planeslegs = Layoverplanes::all();
        return View::make('layoverplanes.index', ['planes' => $planes, 'layoverplanes' => $planeslegs]);
    }

    public function create($id)
    {
        $this->loginFilterbyRole('gestorvoo');
        $planes = Plane::all();
        $layover = Layover::find([$id]);
        return View::make('layoverplanes.create', ['planes' => $planes, 'layover' => $layover]);
    }

    public function store()
    {
        $this->loginFilterbyRole('gestorvoo');
        //create new resource (activerecord/model) instance with data from POST
        //your form name fields must match the ones of the table fields
        $planeLegs = new Layoverplanes(Post::getAll());

        if($planeLegs->is_valid()){
            $planeLegs->save();
            Redirect::toRoute('layoverplanes/index');
        } else {
            //redirect to form with data and errors
            Redirect::flashToRoute('layoverplanes/create', ['layoverplanes' => $planeLegs]);
        }
    }

    public function show($id)
    {
        $this->loginFilterbyRole('gestorvoo');
        $planeLegs = Layoverplanes::find([$id]);

        if (is_null($planeLegs)) {
            //TODO redirect to standard error page
        } else {
            return View::make('layoverplanes.show', ['layoverplanes' => $planeLegs]);
        }
    }

    public function edit($id)
    {
        $this->loginFilterbyRole('gestorvoo');
        $planeLegs = Layoverplanes::find([$id]);
        $planes = Plane::all();
        $layover = Layover::all();

        if (is_null($planeLegs)) {
            //TODO redirect to standard error page
        } else {
            return View::make('layoverplanes.edit', ['layoverplanes' => $planeLegs, 'planes' => $planes, 'layover' => $layover]);
        }
    }

    public function update($id)
    {
        $this->loginFilterbyRole('gestorvoo');
        //find resource (activerecord/model) instance where PK = $id
        //your form name fields must match the ones of the table fields
        $planeLegs = Layoverplanes::find([$id]);
        $planeLegs->update_attributes(Post::getAll());

        if($planeLegs->is_valid()){
            $planeLegs->save();
            Redirect::toRoute('layoverplanes/index');
        } else {
            //redirect to form with data and errors
            Redirect::flashToRoute('layoverplanes/edit', ['layoverplanes' => $planeLegs]);
        }
    }

    public function destroy($id)
    {
        $this->loginFilterbyRole('gestorvoo');
        $planeLegs = Layoverplanes::find([$id]);
        $planeLegs->delete();
        Redirect::toRoute('layoverplanes/index');
    }
}