<?php

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

$router->get('/', function () use ($router) {
    return '<a href="http://notgroupgithubio.test/yuz-kalkani-siperlik2/index.html?pixel=123456&ref=asd_12">Test</a>';
    return [];
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
        "0"     => "Paketleme",
        "1"     => "Teslimler",
        "2"     => "İadeler",
        "3"     => "Haber Formları",
        "4"     => "Dağıtımda",
        "5"     => "Kayıp",
        "6"     => "Sorunlu",
        "1,2,6" => "Teslim,İade ve Sorunlu kargolar",
    ];
    $startDate = $request->has('startDate') ? date("d/m/Y", strtotime($request->get('startDate'))) : date("d/m/Y");
    $endDate   = $request->has('endDate') ? date("d/m/Y", strtotime($request->get('endDate'))) : date("d/m/Y");
    $query     = [
        "user"       => "7700000423",
        "password"   => "123DEF123",
        "alim_start" => $startDate,
        //"alim_start" => "25/04/2020",
        "alim_end"   => $endDate,
    ];
    $query = http_build_query($query);

    $url     = "http://kargotakip.deposerileti.com:90/xml.asp?" . $query;
    $headers = [
        'Accept: application/json, application/xml, text/plain, text/html, *.*',
    ];

    $cacheKey = 'deposerileti';
   Cache::forget($cacheKey);
    if (Cache::has($cacheKey)) {
        $response = Cache::get($cacheKey);
    } else {
        $xmlfile = getCurl($url, $headers);
        if (!strpos($xmlfile, '<hata>')) {
            $response = simplexml_load_string($xmlfile);
            $response = json_encode($response);
            $response = json_decode($response, true);
              $response['item'] = array_map(function($item){
 
                $exampleItem = array_fill_keys(array_keys($item), NULL);
                $item = array_merge($exampleItem, array_filter($item));
                DB::connection('cargo')->table('deposer')->updateOrInsert(['gonderino' => $item['gonderino']], $item);
                
              return $item;
            }, $response['item']);
          //  DB::connection('cargo')->table('deposer')->insert(array_slice($response['item'], 0, 10));
      // generateCsv('deposer.csv', $response['item']);
            Cache::put($cacheKey, $response, (5));
            $response = Cache::get($cacheKey);

        } else {
            $response = ['item' => [], 'message' => 'bir hata var'];
        }
    }
    $response['cargoStatusTypes'] = $cargoStatusTypes;
    $response['url']              = $url;
    return response()->json($response);

});
$router->get('/CargoTracking/{orderId}', function (Request $request, $orderId) use ($router) {
  //http://kargotakip.deposerileti.com:90/sorgu.asp?MUS_KOD=7700000423&MUS_sif=123DEF123&tip=3&har_kod=E839E4E4
  $response = get_web_page_header("http://kargotakip.deposerileti.com:90/sorgu.asp?MUS_KOD=7700000423&MUS_sif=123DEF123&tip=3&har_kod=" . $orderId);
    return response()->json($response);

});

$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->post('/addUser', 'UserController@addUser');
    $router->get('/getSettings', function (Request $request) use ($router) {

        return response()->json(DB::connection('facebook')->table('settings')->get()->toArray());

    });

});

$router->get('/getMyDetail', 'UserController@getMyDetail');
$router->get('/getUsers', 'UserController@getUsers');
$router->get('/getRoles', 'UserController@getRoles');
$router->get('/getRole/{roleId}', 'UserController@getRole');
$router->get('/getUser/{userId}', 'UserController@getUser');

$router->get('/contents/{entity_type_id}', 'ContentController@getContents');
$router->get('/contents', 'ContentController@getSearchEntity');
$router->get('/content/{content_id}', 'ContentController@getContent');
$router->get('/frontcontent/{content_id}', function (Request $request, $content_id) {
    $res = file_get_contents(__DIR__ . '/demoResponseItem.json');
    return response()->json(json_decode($res, 1));
});

$router->get('/clientInit', function (Request $request) {
    $countries      = DB::table('country')->get()->toArray();
    $cities         = DB::table('zone')->get()->toArray();
    $towns          = DB::table('town')->get()->toArray();
    $roles          = DB::table('roles')->get()->toArray();
    $paymentMethods = Content::where('entity_type_id', 35)->get()->toArray();
    $adsources      = Content::where('entity_type_id', 37)->get()->toArray();
    $orderStatuses  = DB::table('situations')->get()->toArray();
    $response       = [
        "roles"      => $roles,
        "countries"      => $countries,
        "cities"         => $cities,
        "towns"          => $towns,
        "paymentMethods" => $paymentMethods,
        "adsources"      => $adsources,
        "orderStatuses"  => $orderStatuses,
    ];
    return response()->json($response);
});

$router->get('/test01', function (Request $request) {
    echo $request->input('status') ?: 0;
});
$router->get('/domains', function (Request $request) {
    $url     = "https://api.cloudflare.com/client/v4/zones?per_page=100";
    $headers = [
        'X-Auth-Email: ekegroupgorsel@gmail.com',
        'X-Auth-Key: 283cbb4f336b00ca9f8ac9f607188b333094f',
        'Accept: application/json, application/xml, text/plain, text/html, *.*',
    ];

    $cacheKey = 'cloudflareDomains';
    if (Cache::has($cacheKey)) {
        $response = Cache::get($cacheKey);
    } else {
        $response = getCurl($url, $headers);
        if ($response) {

            Cache::put($cacheKey, $response, (3600 * 24 * 30));
            $response = Cache::get($cacheKey);

        } else {
            $response = ['message' => 'bir hata var'];
        }
    }

    return response()->json(json_decode($response, 1));
});

$router->get('/whmpanel', function (Request $request) {
    $url     = "https://62.210.12.26:2087/json-api/listaccts?api.version=1";
    $headers = [
        'Authorization: whm yonetim2:OLXACQWGUZUDKCJCBCF3KPFVQ4N4FMC1',
        'Accept: application/json, application/xml, text/plain, text/html, *.*',
    ];

    $cacheKey = 'whmData';
    if (Cache::has($cacheKey)) {
        $response = Cache::get($cacheKey);
    } else {
        $response = getCurl($url, $headers);
        if ($response) {

            Cache::put($cacheKey, $response, (3600 * 24 * 30));
            $response = Cache::get($cacheKey);

        } else {
            $response = ['message' => 'bir hata var'];
        }
    }

    return response()->json(json_decode($response, 1));
});

require_once 'additems.php';
require_once 'facebook.php';
