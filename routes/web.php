<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;


$router->get('/', function () use ($router) {
  return $router->app->version();
});


$router->post('/getLogin', 'UserController@getLogin');
$router->get('/csvToXls', 'FileController@csvToXls');
$router->post('/addSetting', function (Request $request) use ($router) {
  $requestAll = $request->all();
  DB::connection('facebook')->table('settings')->insert($requestAll);
  return response()->json(DB::connection('facebook')->table('settings')->get()->toArray());

});


$router->get('/BlogList', function (Request $request) use ($router) {
 // DB::connection('blog')->table('settings')->insert($requestAll);
 //DB::connection('facebook')->table('settings')->get()->toArray();
  return response()->json([]);

});


$router->get('/CargoTracking', function (Request $request) use ($router) {
  $cargoStatusTypes = [
  "0" => "Paketleme",	
  "1" => "Teslimler",
  "2" => "İadeler",
  "3" => "Haber Formları",
  "4" => "Dağıtımda",	
  "5" => "Kayıp",
  "6" => "Sorunlu",
  "1,2,6" => "Teslim,İade ve Sorunlu kargolar"
  ];




$url1 = "http://kargotakip.deposerileti.com:90/xml.asp?user=7700000423&password=123DEF123&alim_start=24/03/2020&alim_end=26/03/2020";
$url = "http://kargotakip.deposerileti.com:90/xml.asp?user=7700000423&password=123DEF123&alim_start=20/04/2020&alim_end=30/04/2020";
$headers = [
    'Accept: application/json, application/xml, text/plain, text/html, *.*'
];

$cacheKey = 'deposerileti';
//Cache::forget($cacheKey);
if (Cache::has($cacheKey)) {
  $response =  Cache::get($cacheKey);
} else {
$xmlfile = getCurl($url, $headers);
$response = simplexml_load_string($xmlfile);
$response = json_encode($response);
$response = json_decode($response, true); 
  if ($response) {

    Cache::put($cacheKey, $response, (7200*24*30));
    $response =  Cache::get($cacheKey);

  } else {
    $response = ['message' => 'bir hata var'];
  }
}
$response['cargoStatusTypes'] = $cargoStatusTypes;
  return response()->json($response);

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


$router->get('/whmpanel', function (Request $request) {
  $url = "https://62.210.12.26:2087/json-api/listaccts?api.version=1";
  $headers = [
      'Authorization: whm yonetim2:OLXACQWGUZUDKCJCBCF3KPFVQ4N4FMC1',
      'Accept: application/json, application/xml, text/plain, text/html, *.*'
  ];

  $cacheKey = 'whmData';
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


