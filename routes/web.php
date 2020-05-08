<?php

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
$router->get('/', function () use ($router) {
    //return '<a href="http://notgroupgithubio.test/yuz-kalkani-siperlik2/index.html?pixel=123456&ref=asd_12">Test</a>';
    return [];
});
$router->get('/test', function (Request $request) use ($router) {

    $city = DB::table('zone')->where('name', $request->get('city'))->first();
    $town = DB::table('town')->where('zone_id', $city->zone_id)->where('name', $request->get('district'))->first();
    return response()->json([$city,$town]);
});

$router->post('/getLogin', 'UserController@getLogin');
$router->get('/csvToXls', 'FileController@csvToXls');
$router->post('/addSetting', function (Request $request) use ($router) {
    $requestAll = $request->all();
    DB::connection('facebook')->table('settings')->insert($requestAll);
    return response()->json(DB::connection('facebook')->table('settings')->get()->toArray());

});

$router->get('/CargoTracking', function (Request $request) use ($router) {
    $facets   = Content::select('meta->cargoDetail->durum as durum', \DB::raw('count(*) as total'))->where('entity_type_id', 33)->groupBy('meta->cargoDetail->durum')->get()->pluck('total', 'durum');

    
    /* $results = $orderContents = Content::select(['contents.*'])->where('entity_type_id', 33)
    ->join('cargotracking', 'cargotracking.orderId', '=', 'contents.content_id')
    //->where('contents.content_id', 10325)
    //->update(['contents.meta' => DB::raw("JSON_REMOVE(contents.meta, '$.orderMeta')")]);
    ->update(['contents.meta->cargoDetail' => DB::raw("JSON_EXTRACT(cargotracking.meta, '$')")]);
    //print_r($results->getBindings());
    //print_r($results->toSql());
    //die();*/
    $cargoStatusTypes = [
        "0"     => "Paketleme",
        "1"     => "Teslimler",
        "2"     => "İadeler",
        "3"     => "Haber Formları",
        "4"     => "Dağıtımda",
        "5"     => "Kayıp",
        "6"     => "Sorunlu",
    ];
    $startDate = $request->has('startDate') ? date("d/m/Y", strtotime($request->get('startDate'))) : date("d/m/Y");
    $endDate   = $request->has('endDate') ? date("d/m/Y", strtotime($request->get('endDate'))) : date("d/m/Y");

    $response         = [];
    $response['item'] = Content::where('entity_type_id', 33)
        ->where('meta->cargoDetail', '!=', '{}')
        ->where('meta->cargoDetail', '!=', 'null')
        ->where('meta->agentStatus', '=', 'processless')
        ->orderBy('content_id', 'desc')
        ->limit(10)->get();
    $response['cargoStatusTypes'] = $cargoStatusTypes;
    $response['facetsCargoStatus'] = Content::select('meta->cargoDetail->durum as durum', \DB::raw('count(*) as total'))->where('entity_type_id', 33)
    ->where('meta->cargoDetail', '!=', '{}')
    ->where('meta->cargoDetail', '!=', 'null')
    ->groupBy('meta->cargoDetail->durum')->get()->pluck('total', 'durum');
    $response['facetsAgentAction'] = Content::select('meta->agentStatus as agentStatus', \DB::raw('count(*) as total'))->where('entity_type_id', 33)
    ->where('meta->cargoDetail', '!=', '{}')
    ->where('meta->cargoDetail', '!=', 'null')
    ->groupBy('meta->agentStatus')->get()->pluck('total', 'agentStatus');

    return response()->json($response);

});

$router->get('/CronTracking', function (Request $request) use ($router) {
    $cargoStatusTypes = [
        "0"     => "Paketleme",
        "1"     => "Teslimler",
        "2"     => "İadeler",
        "3"     => "Haber Formları",
        "4"     => "Dağıtımda",
        "5"     => "Kayıp",
        "6"     => "Sorunlu"
    ];
    $startDate = $request->has('startDate') ? date("d/m/Y", strtotime($request->get('startDate'))) : date("d/m/Y");
    $endDate   = $request->has('endDate') ? date("d/m/Y", strtotime($request->get('endDate'))) : date("d/m/Y");
    $query2    = [
        "user"       => "7700000423",
        "password"   => "123DEF123",
        "alim_start" => $startDate,
        "alim_end"   => $endDate,
    ];
    $query = [
        "user"       => "9500000209",
        "password"   => "E775893",
        "alim_start" => $startDate,
        "alim_end"   => $endDate,
        //"durums" => [4],
    ];
    $query = http_build_query($query);

    $url     = "http://kargotakip.deposerileti.com:90/xml.asp?" . $query;
    $headers = [
        'Accept: application/json, application/xml, text/plain, text/html, *.*',
    ];

    $cacheKey = 'deposerileti' . $startDate;
    //Cache::forget($cacheKey);
    if (Cache::has($cacheKey)) {
        $response = Cache::get($cacheKey);
    } else {
        $xmlfile = getCurl($url, $headers);
        if (!strpos($xmlfile, '<hata>')) {
            $response         = simplexml_load_string($xmlfile);
            $response         = json_encode($response);
            $response         = json_decode($response, true);
            $response['item'] = array_map(function ($item) {

                $exampleItem = array_fill_keys(array_keys($item), null);
                $item        = array_merge($exampleItem, array_filter($item));
                //DB::connection('cargo')->table('deposer')->updateOrInsert(['gonderino' => $item['gonderino']], $item);
                DB::table('cargotracking')->updateOrInsert(
                    ['senderId' => $item['gonderino']],
                    ['orderId'        => $item['sipno'],
                        'senderId'        => $item['gonderino'],
                        'shipmentType'    => 'deposer',
                        'shipmentSubtype' => $item['sube'],
                        'meta'            => json_encode($item),
                    ]);

                return $item;
            }, $response['item']);
            //  DB::connection('cargo')->table('deposer')->insert(array_slice($response['item'], 0, 10));
            // generateCsv('deposer.csv', $response['item']);
            Cache::put($cacheKey, $response, (30 * 60));
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

    $order = Content::where('entity_type_id', 33)->where('meta->cargoDetail->sipno', '=', (string) $orderId)->first();

    $shipmentMethods = Content::find((int) $order->meta['shipment_id']);
    $query = [
        'har_kod' => $orderId,
        'tip'     => 3,
        'MUS_KOD' => $shipmentMethods->meta['customerCode'],
        'MUS_sif' => $shipmentMethods->meta['password'],
    ];

    $query    = http_build_query($query);
    $response = get_web_page_header("http://kargotakip.deposerileti.com:90/sorgu.asp?" . $query);
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
$router->post('/addRole', 'UserController@addRole');
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
    $cacheKey = 'clientInit';
    Cache::forget($cacheKey);
    $response = [];
    if (Cache::has($cacheKey)) {
        $response = Cache::get($cacheKey);
    } else {
        $countries       = DB::table('country')->get()->toArray();
        $cities          = DB::table('zone')->get()->toArray();
        $towns           = DB::table('town')->get()->toArray();
        $roles           = DB::table('roles')->get()->toArray();
        $products        = Content::where('entity_type_id', 4)->get()->toArray();
        $shipmentMethods = Content::where('entity_type_id', 36)->get()->toArray();
        $productsGroup   = Content::where('entity_type_id', 32)->get()->toArray();
        $paymentMethods  = Content::where('entity_type_id', 35)->get()->toArray();
        $adsources       = Content::where('entity_type_id', 37)->get()->toArray();
        $orderStatuses   = DB::table('situations')->where('type', 'orderStatus')->get()->toArray();
        $agentActions    = DB::table('situations')->where('type', 'agentAction')->get()->toArray();
        $response        = [
            "roles"           => $roles,
            "shipmentMethods" => $shipmentMethods,
            "countries"       => $countries,
            "cities"          => $cities,
            "towns"           => $towns,
            "paymentMethods"  => $paymentMethods,
            "adsources"       => $adsources,
            "orderStatuses"   => $orderStatuses,
            "agentActions"    => $agentActions,
            "productsGroup"   => $productsGroup,
            "products"        => $products,
        ];
        Cache::put($cacheKey, $response, (30 * 60));
    }

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
require_once 'outorder.php';
require_once 'facebook.php';
