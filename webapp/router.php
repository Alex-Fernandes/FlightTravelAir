<?php
/**
 * Created by PhpStorm.
 * User: smendes
 * Date: 02-05-2016
 * Time: 11:18
 */
use ArmoredCore\Facades\Router;

/****************************************************************************
 *  URLEncoder/HTTPRouter Routing Rules
 *  Use convention: controllerName/methodActionName
 ****************************************************************************/

/******************** Rotas Publicas *****************************/

/**** Home Controller ****/
Router::get('/',			'HomeController/index');
Router::get('home/',		'HomeController/index');
Router::get('home/index',	'HomeController/index');
Router::get('home/start',	'HomeController/start');

/***** Login Controller *****/
Router::get('login/loginForm',  	'LoginController/getLoginForm');
Router::get('login/registarForm',	'LoginController/getResistration');
Router::Post('login/registar',	    'LoginController/doRegistration');
Router::Post('login/login',	    'LoginController/doLogin');
Router::get('login/logout',	    'LoginController/doLogout');

/******************** Rotas Protegidas *****************************/

/***** AdminAPP Controller *****/
Router::get('adminapp/index',      'AdminAppController/index');

//Airports
Router::resource('aeroporto', 'AeroportoAppController');
//Users
Router::resource('user', 'UserAppController');
//Flights
Router::resource('flights', 'FlightAppController');
//Legs
Router::resource('legs', 'LegsAppController');
//Plane
Router::resource('plane', 'PlaneAppController');
//Planelegs
Router::get('planelegs/index',      'PlaneLegsAppController/index');
Router::get('planelegs/create',      'PlaneLegsAppController/createCustom');
Router::Post('planelegs/store',      'PlaneLegsAppController/store');
Router::get('planelegs/edit',      'PlaneLegsAppController/edit');
Router::Post('planelegs/update',      'PlaneLegsAppController/update');
Router::Post('planelegs/destroy',      'PlaneLegsAppController/destroy');

/***** PassageiroAPP Controller *****/
Router::get('passageiroapp/index', 'PassageiroAppController/index');

/***** OpCheckInAPP Controller *****/
Router::get('opcheckinapp/index', 'OPCheckInAppController/index');

/***** GestorVooAppController Controller *****/
Router::get('gestorvooapp/index', 'GestorVooAppController/index');













/************** End of URLEncoder Routing Rules ************************************/