<?php

use ArmoredCore\Interfaces\ResourceControllerInterface;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\View;

class FlightSalesController extends BaseAuthController implements ResourceControllerInterface
{
    public function index()
    {
        $this->loginFilterbyRole('passageiro');
        $flighsales = FlightSales::all();
        return View::make('flightsales.index', ['flightsales' => $flighsales]);
    }


    public function create()
    {

    }

    public function store()
    {
        // TODO: Implement store() method.
    }

    public function show($id)
    {
        $this->loginFilterbyRole('passageiro');
        $flighsales = FlightSales::find([$id]);

        if (is_null($flighsales)) {

        } else {
            return View::make('flightsales.show', ['flightsales' => $flighsales]);
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