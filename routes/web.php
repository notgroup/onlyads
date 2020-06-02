<?php

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
$router->get('/', function () use ($router) {
    //return '<a href="http://notgroupgithubio.test/yuz-kalkani-siperlik2/index.html?pixel=123456&ref=asd_12">Test</a>';
    return [];
});
$router->post('/addStockAction', function (Request $request) use ($router) {

    $contentAttr = [
        'entity_type_id' => 44,
        'creator_id'     => $request->user()->id,
        'parent_id'      => 0,
    ];
    $request->merge($contentAttr);
    $content = Content::create($request->all());
    return response()->json($content);
});

$router->post('/addPayAction', function (Request $request) use ($router) {

    $payAction = DB::connection('accounting')->table('payAction')->insert($request->all());
   
    return response()->json($payAction);
});
$router->get('/getPayActions', function (Request $request) use ($router) {

    $payActions = DB::connection('accounting')->table('payAction')
    ->get()->toArray();
   
    return response()->json($payActions);
});
$router->get('/getPayReports', function (Request $request) use ($router) {

    $payActions = DB::connection('accounting')->table('payAction')
    ->select('startDate as day', 'actionType', 'spendType', DB::raw('sum(price) total'), DB::raw('count(*) count'))
    ->groupBy([
        'day',
        'actionType',
        'spendType'
    ])
    ->get()->toArray();
   
    return response()->json($payActions);
});
$router->get('/getAccountCard/{cardId}', function (Request $request, $cardId) use ($router) {

    $card = DB::connection('accounting')->table('accountCard')->find($cardId);
    $history = DB::connection('accounting')->table('payAction')->where('sourceId', $cardId)->get()->toArray();
   
    return response()->json([
        'card' => $card,
        'history' => $history,
    ]);
});
$router->post('/addAccountCard', function (Request $request) use ($router) {

    $cardAction = DB::connection('accounting')->table('accountCard');
    if ($request->has('id')) {
        $cardAction->updateOrInsert(['id' => $request->get('id')], $request->all());
    } else {
        $cardAction->insert($request->all());
    }
    
   
    return response()->json($request->all());
});




$router->get('/test', function (Request $request) use ($router) {

    $city = DB::table('zone')->where('name', $request->get('city'))->first();
    $town = DB::table('town')->where('zone_id', $city->zone_id)->where('name', $request->get('district'))->first();
    return response()->json([$city, $town]);
});

$router->post('/getLogin', 'UserController@getLogin');
$router->get('/csvToXls', 'FileController@csvToXls');

$router->get('/CargoReport', function (Request $request) use ($router) {

/*

SELECT
json_unquote(json_extract(meta, '$.cargoDetail.alimtarihi')) as alimtarihi,
json_unquote(json_extract(meta, '$.cargoDetail.durum')) as durum,
json_unquote(json_extract(meta, '$.adsource')) as adsource,
json_unquote(json_extract(meta, '$.products[0].meta.product_group_id')) as product_group_id,
json_unquote(json_extract(meta, '$.products[0].content_id')) as product_id,
count(*) as count,
sum(json_extract(meta, '$.finalPrice')) as price
FROM `contents`
WHERE `entity_type_id` = '33'
and json_extract(meta, '$.cargoDetail') is not null
and json_extract(meta, '$.cargoDetail') != '{}'
and json_extract(meta, '$.cargoDetail.alimtarihi') != 'null'
and json_unquote(json_extract(meta, '$.cargoDetail.durum')) != 'null'
and json_unquote(json_extract(meta, '$.products[0].content_id')) is not null
group by alimtarihi, durum, adsource, product_group_id, product_id
order by alimtarihi desc
LIMIT 1000;
$cargoStatusTypes = [
"0" => "packing",
"1" => "delivered",
"2" => "returned",
"3" => "message",
"4" => "on_delivery",
"5" => "unknown",
"6" => "problem",
];
$cargoStatusTypes = [
"0" => "Paketleme",
"1" => "Teslimler",
"2" => "İadeler",
"3" => "Haber Formları",
"4" => "Dağıtımda",
"5" => "Kayıp",
"6" => "Sorunlu",
];
 */

    $cacheKey = 'CargoReport';
//Cache::forget($cacheKey);
    if (Cache::has($cacheKey)) {
        $response = Cache::get($cacheKey);
    } else {

        $response = Content::select(
            'cargotracking.acceptDate as acceptDate',
            'cargotracking.shipmentStatus as shipmentStatus',
            \DB::raw("CAST(json_extract(contents.meta, '$.adsource') AS UNSIGNED) as adsource"),
            \DB::raw("json_extract(meta, '$.products[0].meta.product_group_id') as product_group_id"),
            \DB::raw("json_extract(meta, '$.products[0].content_id') as product_id"),
            \DB::raw('count(*) as total'),
            \DB::raw("sum(json_extract(meta, '$.finalPrice')) as price")
        )
            ->join('cargotracking', 'contents.content_id', '=', 'cargotracking.refOrderId')
        //->join('cargotracking',DB::raw("json_extract(contents.meta, '$.refOrderId')"), '=', 'cargotracking.orderId')
            ->where('entity_type_id', 33)
            ->groupBy([
                'acceptDate',
                'shipmentStatus',
                'adsource',
                'product_group_id',
                'product_id',
            ])->orderBy('acceptDate', "desc")->get()->toArray();
        Cache::put($cacheKey, $response, (30 * 60));
    }
/*
print_r($facets->toSql());
die();
 */
    return response()->json($response);

});
$router->get('/AgentReport', function (Request $request) use ($router) {

/*
    $cacheKey = 'AgentReport';
//Cache::forget($cacheKey);
    if (Cache::has($cacheKey)) {
        $response = Cache::get($cacheKey);
    } else {

        $response = Content::select(
            'cargotracking.acceptDate as acceptDate',
            'cargotracking.shipmentStatus as shipmentStatus',
            \DB::raw("CAST(json_extract(contents.meta, '$.adsource') AS UNSIGNED) as adsource"),
            \DB::raw("json_extract(meta, '$.products[0].meta.product_group_id') as product_group_id"),
            \DB::raw("json_extract(meta, '$.products[0].content_id') as product_id"),
            \DB::raw('count(*) as total'),
            \DB::raw("sum(json_extract(meta, '$.finalPrice')) as price")
        )
            ->join('cargotracking', 'contents.content_id', '=', 'cargotracking.refOrderId')
        //->join('cargotracking',DB::raw("json_extract(contents.meta, '$.refOrderId')"), '=', 'cargotracking.orderId')
            ->where('entity_type_id', 33)
            ->groupBy([
                'acceptDate',
                'shipmentStatus',
                'adsource',
                'product_group_id',
                'product_id',
            ])->orderBy('acceptDate', "desc")->get()->toArray();
        Cache::put($cacheKey, $response, (30 * 60));
    }*/
/*
print_r($facets->toSql());
die();
 */


$response = DB::table('log_history')->select(
    DB::raw("subject_id, log_type, action_type, content->>'$.new_value' value, count(*) as total")
)->groupBy(DB::raw("subject_id, log_type, action_type, value"))->get()->toArray();



    return response()->json($response);

});
$router->get('/SalesReport', function (Request $request) use ($router) {



$response = DB::table('contents as ct')
->selectRaw("cast(ct.created_at as DATE) day,
cast(ct.meta->>'$.country' as unsigned) country,
cast(ct1.meta->>'$.product_group_id' as unsigned) product_group_id,
ct1.content_id product_id, 
cast(ct.meta->>'$.adsource' as unsigned) adsource, 
count(ct.content_id) ordersCount, 
sum(ct1.meta->>'$.product_quantity') productQuantity,
sum(ct1.meta->>'$.shipment_cost') shipmentCost,
sum(ct2.meta->>'$.cost') productCost,
sum(ct1.meta->>'$.shipment_cost') + sum(ct2.meta->>'$.cost') totalCost,
sum(ct.meta->>'$.finalPrice') totalPrice,
sum(ct.meta->>'$.finalPrice') - sum(ct1.meta->>'$.shipment_cost' + ct2.meta->>'$.cost') gain")
->join('contents as ct1', function ($join) {
    $join->whereRaw("ct1.entity_type_id = 4 and JSON_CONTAINS(ct.meta, json_array(CAST(ct1.content_id as CHAR)), '$.product_id')");
})
->join('contents as ct2', function ($join) {
    $join->whereRaw("ct2.entity_type_id = 32 and ct1.meta->>'$.product_group_id' = CAST(ct2.content_id as CHAR)");
})
->where('ct.entity_type_id', 33)
->groupBy(DB::raw("day, country, product_group_id, product_id, adsource"))->get()->toArray();



    return response()->json($response);

});
$router->get('/ConfirmReport', function (Request $request) use ($router) {



$ordersByDay = DB::table('contents as ct')
->selectRaw("cast(ct.created_at as DATE) day,
count(ct.content_id) ordersCount, count(ct.meta->>'$.update_confirmed') confirmedCount")
->where('ct.entity_type_id', 33)
->groupBy(DB::raw("day"))->get()->toArray();


/*
select cast(ct.created_at as DATE) day,
cast(ct.meta->>'$.update_confirmed' as DATE) confirmed_date,
count(ct.content_id) orders_count
from contents ct
where ct.entity_type_id = 33  and ct.meta->>'$.update_confirmed' is not null
group by day, confirmed_date
having confirmed_date
*/

$ordersByStatus = DB::table('contents as ct')
->selectRaw("cast(ct.created_at as DATE) day, cast(ct.meta->>'$.update_confirmed' as DATE) confirmed_date, count(ct.content_id) ordersCount")
->whereRaw("ct.entity_type_id = 33 and ct.meta->>'$.update_confirmed' is not null")
->groupByRaw("day, confirmed_date")
->havingRaw("confirmed_date")
->get();



$response = [
    "ordersByDay" => $ordersByDay,
    "ordersByStatus" => $ordersByStatus,
];

    return response()->json($response);

});
$router->get('/ConfirmReportProductGroup', function (Request $request) use ($router) {



$ordersByProductGroups = DB::table('contents as ct')
->selectRaw("ct2.content_id product_group_id, ct1.content_id product_id,
count(ct.content_id) ordersCount,
count(cast(ct.meta->>'$.update_confirmed' as DATE)) confirmedCount")
->where('ct.entity_type_id', 33)
->join('contents as ct1', function ($join) {
    $join->whereRaw("ct1.entity_type_id = 4 and JSON_CONTAINS(ct.meta, json_array(CAST(ct1.content_id as CHAR)), '$.product_id')");
})
->join('contents as ct2', function ($join) {
    $join->whereRaw("ct2.entity_type_id = 32 and ct1.meta->>'$.product_group_id' = CAST(ct2.content_id as CHAR)");
})
->groupBy(DB::raw("product_group_id, product_id"))
->havingRaw("product_group_id")
->get()->toArray();



$response = [
    "ordersByProductGroups" => $ordersByProductGroups
];

    return response()->json($response);

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
    ];
    $startDate   = $request->has('startDate') ? date("Y-m-d", strtotime($request->get('startDate'))) : date('Y-m-d');
    $endDate     = $request->has('endDate') ? date("Y-m-d", strtotime($request->get('endDate'))) : date('Y-m-d');
    $agentStatus = $request->has('agentStatus') ? $request->get('agentStatus') : 0;
    $cargoStatus = $request->has('cargoStatus') ? $request->get('cargoStatus') : 0;

    $response = [];
    $contents = Content::select(['contents.*'])->where('entity_type_id', 33)
    //->where('meta->shipmentStatus', 'delivered')
        ->join('cargotracking', 'contents.content_id', '=', 'cargotracking.refOrderId')
        ->with(['cargoDetail']);
    if ($request->has('search') && $request->get('search')) {
        if (is_numeric($request->get('search'))) {
            $contents->where('content_id', '=', $request->get('search'));
        } else {
            $fullName = strtolower($request->get('search'));
            $contents->whereRaw("LOWER(json_extract(meta, '$.fullname')) like '%$fullName%'");
        }

    }
    if ($request->has('fullName')) {

    }
    if ($request->has('shipmentStatus') && $request->get('shipmentStatus')) {

        $contents->where('cargotracking.shipmentStatus', '=', $request->get('shipmentStatus'));
    }
    if ($request->has('city') && $request->get('city')) {

        $contents->where('meta->city', '=', $request->get('city'));
    }
    if ($request->has('agentStatus') && $request->get('agentStatus')) {
        $contents->where('meta->agentStatus', '=', $request->get('agentStatus'));
    }
    $response                      = $contents->orderBy('content_id', 'desc')->limit(10)->simplePaginate(100)->toArray();
    $response['cargoStatusTypes']  = $cargoStatusTypes;
    $response['facetsCargoStatus'] = Content::select('cargotracking.shipmentStatus as shipmentStatus', \DB::raw('count(*) as total'))
        ->where('entity_type_id', 33)
        ->join('cargotracking', 'contents.content_id', '=', 'cargotracking.refOrderId')
        ->groupBy(['shipmentStatus'])
        ->get()
        ->pluck('total', 'shipmentStatus');
    $response['facetsAgentAction'] = Content::select('meta->agentStatus as agentStatus', \DB::raw('count(*) as total'))
        ->where('entity_type_id', 33)
        ->join('cargotracking', 'contents.content_id', '=', 'cargotracking.refOrderId')
        ->groupBy(['agentStatus'])
        ->get()
        ->pluck('total', 'agentStatus');

    return response()->json($response);

});








$router->get('/CronTracking/{shipmentId}', function (Request $request, $shipmentId) use ($router) {

    /*
CRON AÇILACAK
http://roketads.test/CronTracking/24996

    */
    $shipmentMethod   = Content::find((int) $shipmentId);
    if ($shipmentMethod && strpos(strtolower($shipmentMethod->meta['name']), 'deposer') !== false) {

    $shipmentStatus   = DB::table('situations')->where('type', 'shipmentStatus')->get()->pluck('value', 'option');
    $cargoStatusTypes = [
        "0" => "packing",
        "1" => "delivered",
        "2" => "returned",
        "3" => "message",
        "4" => "on_delivery",
        "5" => "unknown",
        "6" => "problem",
    ];
    $cargoStatusTypeNames = [
        "0" => "Paketleme",
        "1" => "Teslimler",
        "2" => "İadeler",
        "3" => "Haber Formları",
        "4" => "Dağıtımda",
        "5" => "Kayıp",
        "6" => "Sorunlu",
    ];
    $startDate = $request->has('startDate') ? date("d/m/Y", strtotime($request->get('startDate'))) : date('d/m/Y', strtotime('-5 days'));
    $endDate   = $request->has('endDate') ? date("d/m/Y", strtotime($request->get('endDate'))) : date('d/m/Y');
    $query     = [
        "user"       => $shipmentMethod->meta['customerCode'],
        "password"   => $shipmentMethod->meta['password'],
        "alim_start" => $startDate,
        "alim_end"   => $endDate,
    ];

    $query = http_build_query($query);

    $url     = "http://kargotakip.deposerileti.com:90/xml.asp?" . $query;
    $headers = [
        'Accept: application/json, application/xml, text/plain, text/html, *.*',
    ];
    $cacheKey = 'deposerileti_' . $shipmentMethod->content_id . '_' . $startDate;

        $xmlfile = getCurl($url, $headers);
        if (stripos($xmlfile,'<hata>') === false
            //&& 1 == 0
        ) {
            $response         = simplexml_load_string($xmlfile);
            $response         = json_encode($response);
            $response         = json_decode($response, true);
            $response['item'] = array_map(function ($item) use ($shipmentMethod, $cargoStatusTypes) {

                $exampleItem = array_fill_keys(array_keys($item), '');
                $item        = array_merge($exampleItem, $item);
                //DB::connection('cargo')->table('deposer')->updateOrInsert(['gonderino' => $item['gonderino']], $item);
                $formatItem = [
                    "fullName"        => ($item['aliciadi'] . ' ' . $item['alicisoyad']) ?: null,
                    "cityName"        => $item['sehiradi'] ?: null,
                    "shipmentType"    => $shipmentMethod->content_id,
                    "branch"          => $item['sube'] ?: null,
                    "branchPhone"     => $item['subetel'] ?: null,
                    "price"           => $item['tutar'] ?: null,
                    "shipmentStatus"  => $cargoStatusTypes[$item['durum']] ?: null,
                    "orderId"         => $item['sipno'] ?: null,
                    "customerNumber"  => $item['muskod'] ?: null,
                    "customerBarcode" => $item['musteribarkod'] ?: null,
                    "senderId"        => $item['gonderino'] ?: null,
                    "preResult"       => $item['onsonuc'] ?: null,
                    "result"          => $item['sonuc'] ?: null,
                    "exitNumber"      => $item['cikisno'] ?: null,
                    "resultDate"      => cargoDateFormat($item['sonuctarihi']) ?: null,
                    "acceptDate"      => cargoDateFormat($item['alimtarihi']) ?: null,
                    "exitDate"        => cargoDateFormat($item['cikistarihi']) ?: null,
                    "paymentDate1"    => cargoDateFormat($item['tahsiltarihi']) ?: null,
                    "paymentDate2"    => cargoDateFormat($item['odemetarihi']) ?: null,
                ];

                /*DB::table('cargotracking')->updateOrInsert(
                    ['senderId' => $formatItem['senderId']],
                    $formatItem);*/

                return $formatItem;
            }, $response['item']);

        /*    $fileName = 'assets/uploads/' . 'testCargoTrackerTable';
            $dt       = fopen($fileName . '.csv', 'w');
            fputcsv($dt, array_keys($response['item'][0]));
            foreach ($response['item'] as $key => $item) {
                fputcsv($dt, $item);
            }

            fclose($dt);
*/
return response()->json($response);

        } else {
            return   $response = ['item' => [], 'message' => 'bir hata var'];
        }




        }


});
$router->get('/CargoTracking/{orderId}', function (Request $request, $orderId) use ($router) {

    $order = Content::where('entity_type_id', 33)->where('content_id', $orderId)->first();

    $shipmentMethods = Content::find((int) $order->meta['shipment_id']);
    $query           = [
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
        return response()->json(DB::table('settings')->get()->toArray());
    });
    $router->get('/deleteSetting/{optionId}', function (Request $request, $optionId) use ($router) {
        DB::table('settings')->where('option_id', $optionId)->delete();
        return response()->json(DB::table('settings')->get()->toArray());
    });
    $router->post('/addSetting', function (Request $request) use ($router) {
        $requestAll = $request->all();
        DB::table('settings')->insert($requestAll);
        return response()->json(DB::table('settings')->get()->toArray());

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
        $users       = DB::table('users')->get()->pluck('username','id')->toArray();
        $cities          = DB::table('zone')->get()->toArray();
        $towns           = DB::table('town')->get()->toArray();
        $roles           = DB::table('roles')->get()->toArray();
        $products        = Content::where('entity_type_id', 4)->get()->toArray();
        $shipmentMethods = Content::where('entity_type_id', 36)->get()->toArray();
        $productsGroup   = Content::where('entity_type_id', 32)->get()->toArray();
        $paymentMethods  = Content::where('entity_type_id', 35)->get()->toArray();
        $adsources       = Content::where('entity_type_id', 37)->get()->keyBy('content_id')->toArray();
        //$accountCards       = Content::where('entity_type_id', 42)->get()->keyBy('content_id')->toArray();
        $accountCards       = DB::connection('accounting')->table("accountCard")->get()->toArray();
        $accountingProperties       = DB::connection('accounting')->table("situations")->get()->groupBy('type');
        $orderStatuses   = DB::table('situations')->where('type', 'orderStatus')->get()->toArray();
        $agentActions    = DB::table('situations')->where('type', 'agentAction')->get()->toArray();
        $response        = [
            "accountCards"           => $accountCards,
            "accountingProperties"           => $accountingProperties,
            "users"           => $users,
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
    echo Content::where(['entity_type_id' => 33])->where('meta->phone_number', $request->meta['phone_number'])->count();
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
require_once 'facebook_manage.php';
