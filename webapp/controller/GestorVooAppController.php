<?php


use ArmoredCore\WebObjects\View;

class GestorVooAppController extends BaseAuthController
{
    public function index(){
        $this->loginFilterbyRole('gestorvoo');
        return View::make('gestorvoo.index');
    }
}