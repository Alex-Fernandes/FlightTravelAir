<?php


use ArmoredCore\WebObjects\View;

class OPCheckInAppController extends BaseAuthController
{
    public function index(){
        $this->loginFilterbyRole('opcheckin');
        return View::make('opcheckin.index');
    }

}