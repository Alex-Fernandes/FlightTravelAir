<?php

use ArmoredCore\Interfaces\ResourceControllerInterface;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\View;

class FlightSalesController extends BaseAuthController
{
    public function index($id)
    {
        $this->loginFilterbyRole('opcheckin');
        $flightsales = Flightsales::all(array('conditions' => array('idvooida = ? and registocheckin IS NULL', $id )));
        $flights = Flight::find([$id]);
        return View::make('opcheckin.checkin', ['flightsales' => $flightsales, 'flights' => $flights]);
    }


    public function create()
    {

    }

    public function store($id)
    {
        $this->loginFilterbyRole('opcheckin');

        $flightsales = Flightsales::find([$id]);

        $flightsales->registocheckin = $_SESSION['APPuserid'];

        if($flightsales->is_valid()){
            $flightsales->save();
            Redirect::toRoute('opcheckin/checkin', $flightsales->idvooida);
        } else {
            //redirect to form with data and errors
            Redirect::flashToRoute('opcheckin/checkin', ['flightsales' => $flightsales]);
        }
    }

    public function show($id)
    {
        $this->loginFilterbyRole('opcheckin');
        $flightsales = Flightsales::find([$id]);

        if (is_null($flightsales)) {

        } else {
            return View::make('flightsales.show', ['flightsales' => $flightsales]);
        }
    }

    public function edit($id)
    {
        // TODO: Implement edit() method.
    }

    public function update($id)
    {
        // TODO: Implement update() method.
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }
}