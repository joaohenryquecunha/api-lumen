<?php

use App\Http\Controllers\LinkController;
$controller = new LinkController();

//link principal
$router->group(['prefix' => "/api/links"],function() use ($router){

    $router->post('/', 'LinkController@create');
    $router->get('/', 'LinkController@index');
    $router->put('/{id}', 'LinkController@update');
    $router->delete('/{id}', 'LinkController@deleteLink');
    
    $router->post('/{id}/sublinks', 'LinkController@createSub');
    $router->get('/{id}/sublinks', 'LinkController@listSublinks');
    $router->put('/{id}/sublinks/{id_sub}', 'LinkController@updateSublink');
    $router->delete('/{id}/sublinks/{id_sub}', 'LinkController@deleteSublink');
    $router->put('count/{id}/sublinks/{id_sub}/', 'LinkController@updateClickCount');
    
    
}); 