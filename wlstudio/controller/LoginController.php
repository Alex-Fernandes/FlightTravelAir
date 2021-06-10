<?php
use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\Session;
use ArmoredCore\WebObjects\View;
use ArmoredCore\WebObjects\Debug;

//finder dynamicos
// User::find_by_(nome do campo a pesquisar)

/* Roles:
-passageiro
-opcheckin
-gestorvoo
-admin

em minusculas
*/

class LoginController extends BaseController
{
    //manda para a pagina do login
    public function getLoginForm(){
        View::make('login.loginForm');
    }

    //recebe os dados do login
    public function doLogin(){
        $username = Post::get('username');
        $password = Post::get('password');

        $login = User::find_by_username_and_password($username, $password);
        //Debug::barDump($login);

        if(!is_null($login)){
            $authmgr = new AuthManager();
            $authmgr->setLogin($login);

            $role = AuthManager::getRole();

            switch ($role){
                case 'admin':
                    Redirect::toRoute('adminapp/index');
                    break;

                case 'passageiro':
                    Redirect::toRoute('passageiroapp/index');
                    break;

                case 'opcheckin':
                    Redirect::toRoute('opcheckinapp/index');
                    break;

                case 'gestorvoo':
                    Redirect::toRoute('gestorvooapp/index');
                    break;

                default:
                    Redirect::toRoute('login.loginForm');
                    break;
            }
        }
        else{
            Redirect::toRoute('login/loginForm');
        }
    }

    public function doLogout(){
        AuthManager::logOut();
    }

    //manda para a pagina para registar
    public function getResistration(){
        View::make('login.registarForm');
    }

    //recebe os dados do registar
    public function doRegistration(){
        $user = new User(Post::getAll());
        $user->role = 'passageiro';

        if($user->is_valid()){
            $user->save();
            Redirect::toRoute('login/loginForm');
        } else {
            //redirect to form with data and errors
            Redirect::flashToRoute('login/registarForm', ['user' => $user]);
        }
    }

}