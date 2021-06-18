<?php

use ArmoredCore\Interfaces\ResourceControllerInterface;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\View;


class FlightController extends BaseAuthController implements ResourceControllerInterface
{

    public function index()
    {
        $this->loginFilterbyRole('gestorvoo');
        $flights = Flight::all();
        return View::make('flights.index', ['flights' => $flights]);
    }

    public function create()
    {
        $this->loginFilterbyRole('gestorvoo');
        $aeroportos = AeroportoController::getAeroporto();
        return View::make('flights.create', ['aeroporto' => $aeroportos]);
    }

    public function store()
    {
        $this->loginFilterbyRole('gestorvoo');
        //create new resource (activerecord/model) instance with data from POST
        //your form name fields must match the ones of the table fields
        $flight = new Flight(Post::getAll());

        if($flight->is_valid()){
            $flight->save();
            Redirect::toRoute('flights/index');
        } else {
            //redirect to form with data and errors
            Redirect::flashToRoute('flights/create', ['flights' => $flight]);
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $this->loginFilterbyRole('gestorvoo');
        $flight = Flight::find([$id]);

        if (is_null($flight)) {
            //TODO redirect to standard error page
        } else {
            return View::make('flights.show', ['flights' => $flight]);
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $this->loginFilterbyRole('gestorvoo');
        $flight = Flight::find([$id]);
        $aeroportos = AeroportoController::getAeroporto();

        if (is_null($flight)) {
            //TODO redirect to standard error page
        } else {
            return View::make('flights.edit', ['flights' => $flight , 'aeroporto' => $aeroportos]);
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
        $flight = Flight::find([$id]);
        $flight->update_attributes(Post::getAll());

        if($flight->is_valid()){
            $flight->save();
            Redirect::toRoute('flights/index');
        } else {
            //redirect to form with data and errors
            Redirect::flashToRoute('flights/edit', ['flights' => $flight]);
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $this->loginFilterbyRole('gestorvoo');
        $flight = flight::find([$id]);
        $flight->delete();
        Redirect::toRoute('flights/index');
    }
}