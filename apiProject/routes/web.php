<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use Illuminate\Support\Facades\Route;

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
    echo "<center> Welcome </center>";
});

$router->get('/version', function () use ($router) {
    return $router->app->version();
});

Route::post('login', 'AuthController@login');

Route::group([
    'prefix' => 'api'
], function ($router) {
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('user-profile', 'AuthController@me');
    Route::post('refresh', 'AuthController@refresh');
    // Students Methods
    Route::post('store', 'StudentsController@store');
    Route::post('update', 'StudentsController@update');
    Route::post('delete', 'StudentsController@delete');
    Route::get('list', 'StudentsController@list');
    Route::get('getById', 'StudentsController@getOne');
});
