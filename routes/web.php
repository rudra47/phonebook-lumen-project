<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('/registration-action', 'RegistrationController@registrationAction');
$router->post('/login', 'LoginController@onLogin');
$router->post('/phone-book/create', ['middleware'=>'auth', 'uses'=>'PhoneBookController@create']);
$router->post('/phone-book/select', ['middleware'=>'auth', 'uses'=>'PhoneBookController@onSelect']);
$router->post('/phone-book/delete', ['middleware'=>'auth', 'uses'=>'PhoneBookController@onDelete']);
