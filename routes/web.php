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

$router->group(['prefix' => 'ticket'], function () use ($router) {
    $router->get('/', 'TicketController@index');
    $router->post('/', 'TicketController@store');
    $router->patch('/{id}', 'TicketController@update');
    $router->delete('/{id}', 'TicketController@destroy'); 
});

$router->options('{any:.*}', function () {
return response('', 200);
});