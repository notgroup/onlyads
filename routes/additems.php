<?php
use App\Models\Content;
use App\User;
use Illuminate\Http\Request;
$router->post('/addContent/{contentTypeId}', 'ContentController@addContent');
$router->post('/setChangeStatus/{contentTypeId}', 'ContentController@setChangeStatus');
$router->post('/addOrder', 'ContentController@addOrder');
$router->get('/getOrder/{orderId}', function (Request $request, int $orderId) use ($router) {
    $order      = Content::find($orderId);
    $likeObject = $order->meta['phone_number'];
    $logHistory = DB::table('log_history')->where('object_id', $orderId)->get()->toArray();

    $oldOrders = Content::where('entity_type_id', 33)
        ->where('meta', 'like', "%$likeObject%")
    //->where('meta->phone_number', $order->meta['phone_number'])
        ->get();

    $response = [
        "order"     => $order,
        "oldOrders" => $oldOrders,
    ];
    return response()->json($response);

});

$router->post('/addlogHistory', function (Request $request) use ($router) {
    $request->merge([
        "subject_id" => $request->user()->id,
        "content"    => json_encode($request->input('content')),
        "created_at" => date('Y-m-d H:i:s'),
    ]);
    DB::table('log_history')->insert($request->all());
    return response()->json([]);

});
$router->get('/getLogHistory/{objectId}', function (Request $request, $objectId) use ($router) {
    $logHistories = DB::table('log_history')->where('object_id', $objectId)->get()->toArray();
    array_map(function ($item) {
        $item->content            = json_decode($item->content, 1);
        $item->content['manager'] = DB::table('users')->find($item->subject_id)->username;
        return $item;
    }, $logHistories);
    return response()->json($logHistories);

});

$router->post('/validate', function (Request $request) use ($router) {
    // DB::connection('blog')->table('settings')->insert($requestAll);
    //DB::connection('facebook')->table('settings')->get()->toArray();
    $validatedData = $this->validate($request, [
        'ref2' => 'required',
    ]);
});

$router->post('/orderForm/payment/method', function (Request $request) use ($router) {
    $stringHtml = '<option value="">Ödeme Metodu Seçiniz</option>';
    $items      = Content::where('entity_type_id', 35)->get()->toArray();
    foreach ($items as $key => $item) {
        $stringHtml .= '<option value="' . $item['content_id'] . '">' . $item['meta']['name'] . '</option>';

    }
    $response = ['html' => $stringHtml];
    return response()->json($response);
});

$router->post('/orderForm/country', function (Request $request) use ($router) {
    $stringHtml = '<option value="">Ülke Seçiniz</option>';
    $countries  = DB::table('country')->get()->toArray();
    foreach ($countries as $key => $country) {
        if ($country->country_id == 215) {
            $stringHtml .= '<option selected value="' . $country->country_id . '">' . $country->name . '</option>';
        } else {
            $stringHtml .= '<option value="' . $country->country_id . '">' . $country->name . '</option>';
        }

    }
    $response = ['html' => $stringHtml];
    return response()->json($response);
});

$router->post('/orderForm/city', function (Request $request) use ($router) {
    $citiesHtml = '<option value="">İl Seçiniz</option>';
    $cities     = DB::table('zone')->where('country_id', 215)->get()->toArray();
    foreach ($cities as $key => $city) {
        $citiesHtml .= '<option value="' . $city->zone_id . '">' . $city->name . '</option>';

    }
    $response = ['html' => $citiesHtml];
    return response()->json($response);
});

$router->post('/orderForm/district', function (Request $request) use ($router) {
    $citiesHtml = '<option value="">İlçe Seçiniz</option>';
    if ($request->has('city_id')) {
        $cities = DB::table('town')->where('zone_id', $request->input('city_id'))->get()->toArray();
        foreach ($cities as $key => $city) {
            $citiesHtml .= '<option value="' . $city->town_id . '">' . $city->name . '</option>';
        }
    }
    $response = ['html' => $citiesHtml];
    return response()->json($response);
});

$router->get('/jsontest', function (Request $request) use ($router) {
    // DB::connection('blog')->table('settings')->insert($requestAll);
    $data = DB::table('content_meta')
    //->where('attributes->product_group_id', 38)
        ->whereJsonContains('attributes->product_id', ["39"])
        ->get();
    return response()->json($data);
});
$router->get('/getOldDataOrders', function (Request $request) use ($router) {
    User::where('id', 1)->first()->save();
    /* $user0 =  User::where('id', 1)->first();
    $user0->username = 'superuser';
    $user0->save();*/
    // DB::connection('blog')->table('settings')->insert($requestAll);
    $data = DB::connection('test_sqlite')->table('order')
        ->limit(50)->get()->toArray();
    foreach ($data as $key => $order) {
        if (DB::connection('test_sqlite')->table('order_product')->where('order_id', $order->order_id)->get()->toArray()) {
            $data[$key]->products = DB::connection('test_sqlite')->table('order_product')->where('order_id', $order->order_id)->get()->toArray();
        } else {
            unset($data[$key]);
        }
    }

    return response()->json($data);

});
$router->get('/getOldDataCustomers', function (Request $request) use ($router) {
    // DB::connection('blog')->table('settings')->insert($requestAll);
    $data = DB::connection('test_sqlite')->table('customer')
        ->limit(3000)->get()->toArray();
    $customers = [];
    foreach ($data as $key => $order) {
        if (DB::connection('test_sqlite')->table('address')->where('customer_id', $order->customer_id)->first()) {

            $order->address = DB::connection('test_sqlite')->table('address')
                ->select(['address.*', 'country.name as country', 'zone.name as zone', 'town.name as town'])
                ->leftJoin('country', 'address.country_id', '=', 'country.country_id')
                ->leftJoin('zone', 'address.zone_id', '=', 'zone.zone_id')
                ->leftJoin('town', 'address.town_id', '=', 'town.town_id')
                ->where('customer_id', $order->customer_id)->first();
                $customers[] = $order;
        } else {
            unset($data[$key]);
        }
    }
    $customers = collect($customers)->toArray();
    $responseAs = [];
    foreach ($customers as $key => $customer) {
        $exampleOrder = '{
        "address": "zaviye mah",
        "adsource": "78",
        "country": "215",
        "city": "3369",
        "town": "664",
        "domain_name": "http://newnotgroup.test",
        "finalPrice": 10,
        "firstPrice": 10,
        "firstUrl": "0",
        "firstname": "gokhan",
        "locale": "tr",
        "payment_method": "55",
        "phone_number": "05511500212",
        "pixel": "0",
        "product_id": [
            "46"
        ],
        "redirect": false,
        "ref": false,
        "referrerUrl": false,
        "shipmentCost": 0
}';
        $exampleOrder               = json_decode($exampleOrder, 1);
        $exampleOrder['address']    = $customer->address->address;
        $exampleOrder['country'] = $customer->address->country_id;
        $exampleOrder['city']    = $customer->address->zone_id;
        $exampleOrder['town']    = $customer->address->town_id;
        $exampleOrder['phone_number']    = $customer->telephone;
        $exampleOrder['firstname']    = $customer->firstname_lastname;
        $exampleOrder['product_id']    = [[39,40,41,46,47,93,94][rand(0,6)]];
        $exampleOrder['ref']    = 'test_'.rand(100,150);
        $responseAs[]               = $exampleOrder;
        file_post_contents('http://roketads.test/addOrder', $exampleOrder, 'json');
    }

    return response()->json($responseAs);
});

/*

SET FOREIGN_KEY_CHECKS = 0;

SET FOREIGN_KEY_CHECKS = 1;

 */
