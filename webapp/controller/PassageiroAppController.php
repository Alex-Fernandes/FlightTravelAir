<?php

use ArmoredCore\WebObjects\Debug;
use ArmoredCore\WebObjects\View;

class PassageiroAppController extends BaseAuthController
{
    public function index(){
        $this->loginFilterbyRole('passageiro');
        return View::make('passageiro.index');
    }

}