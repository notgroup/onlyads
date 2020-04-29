<?php
use App\Models\Content;
use App\User;
use App\Models\ContentMeta;
use Illuminate\Http\Request;
$router->post('/addContent/{contentTypeId}', 'ContentController@addContent');
$router->post('/addOrder', function (Request $request) use ($router) {

    $request->merge([
        'title'     => $request->get('firstname') . ' ' . $request->get('lastname') . date('Y_m_d_H_i'),
        'redirect'  => $request->get('success_url'),
        'client_ip' => $request->ip(),
        'browser'   => $request->header('User-Agent'),
        'source_id'   => 0,
        'country'   => 1,
    ]);
    $contentAttr = [
        'entity_type_id' => 33,
        'entity_status'  => 1,
        'creator_id'     => 1,
        'parent_id'      => 0,
    ];
    $entityContentId = Content::insertGetId($contentAttr);
    $entityContent   = ContentMeta::create(['content_id' => $entityContentId, 'attributes' => $request->all()]);
    $content         = Content::find($entityContentId);

    return response()->json($content);

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
    ->limit(50)->get()->toArray();
                foreach ($data as $key => $order) {
                    if(DB::connection('test_sqlite')->table('address')->where('customer_id', $order->customer_id)->first()) {

                        $data[$key]->adress = DB::connection('test_sqlite')->table('address')
                        ->select(['address.*','country.name as country', 'zone.name as zone', 'town.name as town'])
                        ->leftJoin('country', 'address.country_id', '=', 'country.country_id')
                        ->leftJoin('zone', 'address.zone_id', '=', 'zone.zone_id')
                        ->leftJoin('town', 'address.town_id', '=', 'town.town_id')
                        ->where('customer_id', $order->customer_id)->first();
                    } else {
                        unset($data[$key]);
                    }
                }
                return response()->json($data);
});


/*

SET FOREIGN_KEY_CHECKS = 0;

SET FOREIGN_KEY_CHECKS = 1;

*/
