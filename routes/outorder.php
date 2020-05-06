
<?php
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

$router->post('/addOrder', 'ContentController@addOrder');
$router->get('/getOrder/{orderId}', function (Request $request, int $orderId) use ($router) {
    $order      = Content::find($orderId);
    $likeObject = $order->meta['phone_number'];
    $logHistory = DB::table('log_history')->where('object_id', $orderId)->get()->toArray();

    $oldOrders = Content::where('entity_type_id', 33)
        ->where('meta->phone_number', $order->meta['phone_number'])
        ->get();

    $response = [
        "order"     => $order,
        "oldOrders" => $oldOrders,
    ];
    return response()->json($response);

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