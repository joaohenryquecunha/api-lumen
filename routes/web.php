<?php

/** @var \Laravel\Lumen\Routing\Router $router */
header('Access-Control-Allow-Origin: *');

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



//link principal
$router->post('/', 'APIcontroller@createlink');
$router->get('/', 'APIcontroller@listaLink');
$router->put('/{id}','APIcontroller@updatelink');
$router->delete('/{id}','APIcontroller@deletelink');

//criar url em outra página
$router->post('/redirect/{id}', 'APIcontroller@createurl');
$router->get('/redirect/{id}', 'APIcontroller@listaurl');
$router->put('/redirect/{id}','APIcontroller@updateurl');
$router->delete('/redirect/{id}','APIcontroller@deleteurl');





