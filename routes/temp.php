<?php
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;







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
  $customers  = collect($customers)->toArray();
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
      $exampleOrder                 = json_decode($exampleOrder, 1);
      $exampleOrder['address']      = $customer->address->address;
      $exampleOrder['country']      = $customer->address->country_id;
      $exampleOrder['city']         = $customer->address->zone_id;
      $exampleOrder['town']         = $customer->address->town_id;
      $exampleOrder['phone_number'] = $customer->telephone;
      $exampleOrder['firstname']    = $customer->firstname_lastname;
      $exampleOrder['product_id']   = [[39, 40, 41, 46, 47, 93, 94][rand(0, 6)]];
      $exampleOrder['ref']          = 'test_' . rand(100, 150);
      $responseAs[]                 = $exampleOrder;
      file_post_contents('http://roketads.test/addOrder', $exampleOrder, 'json');
  }

  return response()->json($responseAs);
});

$router->get('/BlogList2', function (Request $request) use ($router) {
  // DB::connection('blog')->table('settings')->insert($requestAll);
  //DB::connection('facebook')->table('settings')->get()->toArray();
  return response()->json([]);

});


$router->post('/validate', function (Request $request) use ($router) {
  // DB::connection('blog')->table('settings')->insert($requestAll);
  //DB::connection('facebook')->table('settings')->get()->toArray();
  $validatedData = $this->validate($request, [
      'ref2' => 'required',
  ]);
});



$router->get('/jsontest', function (Request $request) use ($router) {
  // DB::connection('blog')->table('settings')->insert($requestAll);
  $data = DB::table('content_meta')
  //->where('attributes->product_group_id', 38)
      ->whereJsonContains('attributes->product_id', ["39"])
      ->get();
  return response()->json($data);
});



$router->get('/bak01', function (Request $request) use ($router) {
    /*

    $orders = DB::connection('test_remote')->table('orders01')->get();
    foreach ($orders as $key => $order) {

    try {
    $products = $order->product_id ? Content::where('entity_type_id', 4)
    ->where('content_id', $order->product_id)
    ->get() : collect([]);

    $order = array_merge((array) $order, [
    'fullname'     => $order->firstname,
    'lastname'     => '',
    'product_id'     => [$order->product_id],
    'hasOldOrder'  => 0,
    'client_ip'    => $request->ip(),
    'browser'      => $request->header('User-Agent'),
    'products'     => $products->toArray(),
    'firstPrice'   => $products->sum('meta.price') ?: 0,
    'finalPrice'   => $products->sum('meta.price') ?: 0,
    'shipmentCost' => 0,
    'agentStatus'  => 'processless',
    'shipmentStatus' => 0,
    'agentNote'    => '',
    'status'       => 'pending',
    'pixel'       => 0,
    'referrerUrl'       => 0,
    'firstUrl'       => 0,
    'ref'       => 0,
    ]);
    $contentAttr = [
    'entity_type_id' => 33,
    'entity_status'  => 'pending',
    'creator_id'     => 1,
    'parent_id'      => 0,
    'meta'           => $order,
    ];
    $content = Content::create($contentAttr);

    } catch (\Throwable $th) {

    }
    }
     */

// DB::table('contents')->where('entity_type_id', 33)->update(['contents.meta->cargoDetail' => 0, 'contents.meta->shipmentStatus' => 0]);

    $oreders = DB::table('contents')->select(['contents.*', 'cargotracking.meta as cargoDetail'])
        ->join('cargotracking', DB::raw("json_extract(contents.meta, '$.refOrderId')"), '=', 'cargotracking.orderId')
        ->where('contents.entity_type_id', 33)
    //->limit(20)->get()->toArray();
    //return response()->json($oreders);
        ->update([
            'contents.meta->cargoDetail' => DB::raw("JSON_EXTRACT(cargotracking.meta, '$')"),
        ]);
/*
DB::table('contents')
->join('cargotracking','cargotracking.orderId', '=', 'contents.content_id')
->where('contents.entity_type_id', 33)
->update([
'contents.meta->shipmentStatus' => DB::raw('cargotracking.shipmentStatus'),
]);*/
});
