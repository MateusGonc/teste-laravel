<?php

use Illuminate\Http\Request;

/** @var Illuminate\Support\Facades\Route $router */


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$router->group(['prefix' => 'usuarios'], function($router){
    $router->post('', ['uses'=>'UsuarioController@create']); //'middleware' => 'jwt'

    $router->post('login', ['uses'=>'Auth\AuthController@authenticate']);

    $router->get('logado', ['uses'=>'Auth\AuthController@logado']);
});



