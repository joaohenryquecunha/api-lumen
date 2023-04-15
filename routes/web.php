<?php

/** @var \Laravel\Lumen\Routing\Router $router */
// header('Access-Control-Allow-Origin: *');/*permite a comunucação com vueJS localmente*/
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers:*');
header('Access-Control-Allow-Methods: PUT, PATCH, DELETE, POST');


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
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;
$controller = new LinkController();

//link principal
$router->group(['prefix' => "/api/links"],function() use ($router){

    $router->post('/', 'LinkController@create');
    $router->get('/', 'LinkController@index');
    $router->put('/{id}', 'LinkController@update');
    $router->delete('/{id}', 'LinkController@deleteLink');
    
    $router->post('/{id}/sublinks/createSub', 'LinkController@createSub');
    $router->get('/{link_id}/sublinks', 'LinkController@listSublinks');
    $router->put('/{link_id}/sublinks/{sub_id}', 'LinkController@updateSublink');
    $router->delete('/{id}/sublinks/{sub_id}', 'LinkController@deleteSublink');
});





