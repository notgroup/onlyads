<?php


$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->post('/getLogin', 'UserController@getLogin');

require_once('facebook.php');
