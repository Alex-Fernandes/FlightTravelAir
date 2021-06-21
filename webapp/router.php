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
Router::resource('aeroporto', 'AeroportoController');
//Users
Router::resource('user', 'UserAppController');
//Flights
Router::resource('flights', 'FlightController');
//Layover
Router::resource('layover', 'LayoverController');
//Plane
Router::resource('plane', 'PlaneController');

//Layoverplanes
Router::get('layoverplanes/index',      'LayoverPlanesController/index');
Router::get('layoverplanes/create',      'LayoverPlanesController/create');
Router::Post('layoverplanes/store',      'LayoverPlanesController/store');
Router::get('layoverplanes/edit',      'LayoverPlanesController/edit');
Router::Post('layoverplanes/update',      'LayoverPlanesController/update');
Router::Post('layoverplanes/destroy',      'LayoverPlanesController/destroy');

/***** PassageiroAPP Controller *****/
Router::resource('passageiro', 'PassageiroAppController');

/***** OpCheckInAPP Controller *****/
Router::get('opcheckin/index', 'OPCheckInAppController/index');
Router::get('opcheckin/checkin', 'FlightSalesController/index');
Router::get('opcheckin/store', 'FlightSalesController/store');

/***** GestorVooAppController Controller *****/
Router::get('gestorvooapp/index', 'GestorVooAppController/index');













/************** End of URLEncoder Routing Rules ************************************/