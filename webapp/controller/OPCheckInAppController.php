<?php


use ArmoredCore\WebObjects\View;

class OPCheckInAppController extends BaseAuthController
{
    public function index(){
        $this->loginFilterbyRole('opcheckin');
        $flights = Flight::all(array('conditions' => array('id != ?', 3)));
        return View::make('opcheckin.index', ['flights' => $flights]);
    }


}