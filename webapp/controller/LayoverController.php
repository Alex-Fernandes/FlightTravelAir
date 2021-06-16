<?php

use ArmoredCore\Interfaces\ResourceControllerInterface;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\View;

class LayoverController extends BaseAuthController
{
    /**
     * @return
     */
    public function index($id)
    {
        $this->loginFilterbyRole('gestorvoo');

        $flight = Flight::find([$id]);
        $aeroproto = Airports::all();

        return View::make('layover.index' , ['flights' => $flight, 'aeroporto' => $aeroproto]);
    }


    public function create($id)
    {
        $this->loginFilterbyRole('gestorvoo');
        $aeroportos = Airports::all();
        $flights = Flight::find([$id]);
        return View::make('layover.create', ['flights' => $flights, 'aeroporto' => $aeroportos]);
    }


    public function store()
    {
        $this->loginFilterbyRole('gestorvoo');
        //create new resource (activerecord/model) instance with data from POST
        //your form name fields must match the ones of the table fields
        $legs = new Layover(Post::getAll());

        if($legs->is_valid()){
            $this->index($legs->idvoo);
            $legs->save();
            Redirect::toRoute('layover/index/', $legs->idvoo);
        } else {
            //redirect to form with data and errors
            Redirect::flashToRoute('layover/create', ['layover' => $legs],$legs->idvoo);
        }
    }

    public function show($id)
    {
        $this->loginFilterbyRole('gestorvoo');
        $legs = Layover::find([$id]);

        if (is_null($legs)) {
            //TODO redirect to standard error page
        } else {
            return View::make('layover.show', ['layover' => $legs]);
        }
    }


    public function edit($id)
    {
        $this->loginFilterbyRole('gestorvoo');
        $legs = Layover::find([$id]);
        $aeroportos = Airports::all();
        $flights = Flight::all();

        if (is_null($legs)) {
            //TODO redirect to standard error page
        } else {
            return View::make('layover.edit', ['layover' => $legs , 'aeroporto' => $aeroportos, 'flights' => $flights]);
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function update($id)
    {
        $this->loginFilterbyRole('gestorvoo');
        //find resource (activerecord/model) instance where PK = $id
        //your form name fields must match the ones of the table fields
        $legs = Layover::find([$id]);
        $legs->update_attributes(Post::getAll());

        if($legs->is_valid()){
            $this->index($legs->idvoo);
            $legs->save();
            Redirect::toRoute('layover/index', $legs->idvoo);
        } else {
            //redirect to form with data and errors
            Redirect::flashToRoute('layover/edit', ['layover' => $legs]);
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $this->loginFilterbyRole('gestorvoo');
        $legs = Layover::find([$id]);
        $this->index($legs->idvoo);
        $legs->delete();
        Redirect::toRoute('layover/index/');
    }


}