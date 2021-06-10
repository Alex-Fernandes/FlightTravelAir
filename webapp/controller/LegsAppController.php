<?php

use ArmoredCore\Interfaces\ResourceControllerInterface;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\View;

class LegsAppController extends BaseAuthController implements ResourceControllerInterface
{
    /**
     * @return mixed
     */
    public function index()
    {
        $this->loginFilterbyRole('gestorvoo');
        $flights = Flight::all();
        return View::make('flights.index', ['flights' => $flights]);
    }
    public function indexCustom($id)
    {
        $this->loginFilterbyRole('gestorvoo');
        $legs = Legs::all(array('conditions' => array('idVoo = ?', $id)));
        $aeroportos = AeroportoAppController::getAeroporto();
        return View::make('legs.index' , ['legs' => $legs, 'aeroporto' => $aeroportos]);
    }

    public function create()
    {
        $this->loginFilterbyRole('gestorvoo');
        $aeroportos = AeroportoAppController::getAeroporto();
        $flights = Flight::all();
        return View::make('legs.create', ['flights' => $flights, 'aeroporto' => $aeroportos]);
    }


    public function store()
    {
        $this->loginFilterbyRole('gestorvoo');
        //create new resource (activerecord/model) instance with data from POST
        //your form name fields must match the ones of the table fields
        $legs = new Legs(Post::getAll());

        if($legs->is_valid()){
            $legs->save();
            Redirect::toRoute('legs/indexCustom/', $legs->idvoo);
        } else {
            //redirect to form with data and errors
            Redirect::flashToRoute('legs/create', ['legs' => $legs]);
        }
    }

    public function show($id)
    {
        $this->loginFilterbyRole('gestorvoo');
        $legs = Legs::find([$id]);

        if (is_null($legs)) {
            //TODO redirect to standard error page
        } else {
            return View::make('legs.show', ['legs' => $legs]);
        }
    }


    public function edit($id)
    {
        $this->loginFilterbyRole('gestorvoo');
        $legs = Legs::find([$id]);
        $aeroportos = AeroportoAppController::getAeroporto();
        $flights = Flight::all();

        if (is_null($legs)) {
            //TODO redirect to standard error page
        } else {
            return View::make('legs.edit', ['legs' => $legs , 'aeroporto' => $aeroportos, 'flights' => $flights]);
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
        $legs = Legs::find([$id]);
        $legs->update_attributes(Post::getAll());
        $idvoo = $legs->idvoo;
        if($legs->is_valid()){
            $legs->save();
            Redirect::toRoute('legs/indexCustom',$idvoo);
        } else {
            //redirect to form with data and errors
            Redirect::flashToRoute('legs/edit', ['legs' => $legs]);
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $this->loginFilterbyRole('gestorvoo');
        $legs = Legs::find([$id]);
        $idvoo = $legs->idvoo;
        $legs->delete();
        Redirect::toRoute('legs/indexCustom/',$idvoo);
    }


}