<?php

use Illuminate\Http\Request;
$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->post('/getLogin', 'UserController@getLogin');
$router->post('/addSetting', function (Request $request) use ($router) {
  $requestAll = $request->all();
  DB::connection('facebook')->table('settings')->insert($requestAll);
  return response()->json(DB::connection('facebook')->table('settings')->get()->toArray());

});
$router->get('/getSettings', function (Request $request) use ($router) {

  return response()->json(DB::connection('facebook')->table('settings')->get()->toArray());

});
require_once('facebook.php');
