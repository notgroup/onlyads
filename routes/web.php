<?php

use Illuminate\Support\Facades\Cache;
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



$router->group(['middleware' => 'auth'], function () use ($router) {

  $router->get('/getSettings', function (Request $request) use ($router) {

    return response()->json(DB::connection('facebook')->table('settings')->get()->toArray());

  });

});


$router->get('/contents/{entity_type_id}', 'ContentController@getContents');
$router->get('/content/{content_id}', 'ContentController@getContent');
$router->get('/frontcontent/{content_id}', function (Request $request, $content_id) {
  $res = file_get_contents(__DIR__.'/demoResponseItem.json');
  return response()->json(json_decode($res, 1));
});




$router->get('/domains', function (Request $request) {
  $url = "https://api.cloudflare.com/client/v4/zones?per_page=100";
  $headers = [
      'X-Auth-Email: ekegroupgorsel@gmail.com',
      'X-Auth-Key: 283cbb4f336b00ca9f8ac9f607188b333094f',
      'Accept: application/json, application/xml, text/plain, text/html, *.*'
  ];

  $cacheKey = 'cloudflareDomains';
  if (Cache::has($cacheKey)) {
    $response =  Cache::get($cacheKey);
  } else {
      $response = getCurl($url, $headers);
    if ($response) {

      Cache::put($cacheKey, $response, (3600*24*30));
      $response =  Cache::get($cacheKey);

    } else {
      $response = ['message' => 'bir hata var'];
    }
  }



  return response()->json(json_decode($response, 1));
});








require_once('facebook.php');


