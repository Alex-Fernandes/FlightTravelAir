<?php

use ArmoredCore\WebObjects\Debug;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\View;

class AdminAppController extends BaseAuthController
{
    public function index(){
        $this->loginFilterbyRole('admin');
        return View::make('admin.index');
    }

}