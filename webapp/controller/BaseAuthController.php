<?php

use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\View;

class BaseAuthController extends BaseController
{
    public function loginFilter(){

        if(!AuthManager::isUserLogged()){
            Redirect::toRoute('login/loginForm');
        }

    }

    public function loginFilterbyRole($role){

        if(AuthManager::isUserLogged()){

            if($role != AuthManager::getRole()){
                Redirect::toRoute('login/loginForm');
                //nao tem permissoes para acder a aesta funcionalidade
            }
        }
        else{
            Redirect::toRoute('login/loginForm');
            //tem de ter permissoes para aceder a esta funcionalidade
        }

    }

}