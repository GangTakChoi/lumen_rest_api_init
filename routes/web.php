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

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });

// $router->get('/user', ['middleware' => 'auth','UserController@getUserInfo']);

// $router->post('/user/{id}', 'UserController@addUser');

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('users', ['middleware' => 'auth', 'uses' => 'UserController@getAllUsers']);

    $router->post('users/login', ['uses' => 'UserController@login']);

    $router->post('users', ['uses' => 'UserController@create']);
});

// $router->view('/web', 'test');

$router->get('/{route:.*}/', function ()  {
    return view('app');
});
