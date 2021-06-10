<?php


use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\Session;

class AuthManager implements IAuthManager
{
    static public function isUserLogged(){
        if(Session::has('APPuserid')){
            return true;
        }
        else{
            return false;
        }
    }

    static public function getRole(){

        if(Session::has('APPuserid')){
            return Session::get('APPuserrole');
        }
        else{
            return null;
        }
    }

    static public function getId(){

        if(Session::has('APPuserid')){
            return Session::get('APPuserid');
        }
        else{
            return null;
        }
    }

    public function setLogin($user){
        Session::set('APPuserid', $user->id);
        Session::set('APPuserrole', $user->role);
    }

    static public function logOut(){

        if(self::isUserLogged()){
            Session::destroy();
            Redirect::toRoute('login/loginForm');
        }
    }

}