<?php

use ArmoredCore\Interfaces\ResourceControllerInterface;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\View;

class FlightSalesController extends BaseAuthController implements ResourceControllerInterface
{
    public function index()
    {
        $this->loginFilterbyRole('opcheckin');
        $flightsales = Flightsales::all();
        return View::make('opcheckin.checkin', ['flightsales' => $flightsales]);
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