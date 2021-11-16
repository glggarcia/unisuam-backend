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

use App\Http\Controllers\IndicationController;

$router->get('api/indications', "IndicationController@getAll", "as", "indications");
$router->post('api/indications', "IndicationController@create", "as", "create_indication");
$router->delete('api/indications/{id}', "IndicationController@delete", "as", "delete_indication");
$router->patch('api/indications/{id}', "IndicationController@update", "as", "update_indication");
