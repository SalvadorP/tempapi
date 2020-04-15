<?php

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

$router->get('/', 'FrontController@index');

$router->group(['prefix'=>'api/v1'], function() use($router){
    $router->get('/measures', 'MeasureController@index');
    $router->post('/measure', 'MeasureController@create');
    $router->get('/measure/{id}', 'MeasureController@show');
    $router->put('/measure/{id}', 'MeasureController@update');
    $router->delete('/measure/{id}', 'MeasureController@destroy');
});
