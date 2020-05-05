<?php
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

require_once 'config.php';

function getFacebookData($fb, $startDate, $endDate, $bmId)
{

    $response = false;
    $error = false;
    try {

        $clientAdAccountFields  = "disable_reason,account_status,id,business,account_id,is_prepay_account,name";
        $clientAdAdsFields      = "ads.limit(1){effective_status,name,status}";
        $clientAdInsightsFields = "insights.level(campaign).time_range({'since':'$startDate','until':'$endDate'}).time_increment(all_days)"
            . "{spend,unique_clicks,cost_per_unique_click,unique_actions,cost_per_unique_action_type}";
        $response = $fb->get($bmId."?fields=client_ad_accounts.limit(400){campaigns.limit(1){daily_budget},$clientAdInsightsFields,$clientAdAdsFields,$clientAdAccountFields}");
        $response = $response->getGraphNode()->asArray();
    } catch (FacebookResponseException $e) {
        // When Graph returns an error
        $error = 'Graph returned an error: ' . $e->getMessage();

    } catch (FacebookSDKException $e) {
        // When validation fails or other local issues
        $error = 'Facebook SDK returned an error: ' . $e->getMessage();

    }
/*print_r($error);
die();*/
    return $response;
}
/*
function adAccountsActivities($fb, $startDate, $endDate)
{
    $response = false;
    try {
        $response = $fb->get("156479078851727?fields=client_ad_accounts.limit(250){account_id,activities.limit(5){event_type,translated_event_type,object_type,event_time,actor_name,extra_data}}");
        $response = $response->getGraphNode()->asArray();
        //$response = $fb->get('me?fields=businesses{id,name,client_ad_accounts{business,id,balance,name}}');
    } catch (FacebookResponseException $e) {
        // When Graph returns an error
        $error = 'Graph returned an error: ' . $e->getMessage();

    } catch (FacebookSDKException $e) {
        // When validation fails or other local issues
        $error = 'Facebook SDK returned an error: ' . $e->getMessage();

    }

    return $response;
}
*/
function getAccountDetail($fb, $accountId)
{
    $response = false;
    try {
        $response = $fb->get("act_" . $accountId . "?fields=account_id,id,is_prepay_account,name,business_name,business,disable_reason,account_status,ads{effective_status,status,configured_status,ad_review_feedback,recommendations,issues_info},activities{actor_name,application_name,date_time_in_timezone,event_time,event_type,extra_data,object_id,object_name,object_type,translated_event_type}");
        $response = $response->getGraphNode()->asArray();
        //$response = $fb->get('me?fields=businesses{id,name,client_ad_accounts{business,id,balance,name}}');
    } catch (FacebookResponseException $e) {
        // When Graph returns an error
        $error = 'Graph returned an error: ' . $e->getMessage();

    } catch (FacebookSDKException $e) {
        // When validation fails or other local issues
        $error = 'Facebook SDK returned an error: ' . $e->getMessage();

    }

    return $response;
}
/*
$router->get('/adAccountsActivities', function (Request $request) use ($router, $fb) {

    $startDate = $request->has('startDate') ? $request->get('startDate') : date("Y-m-d");
    $endDate   = $request->has('endDate') ? $request->get('endDate') : date("Y-m-d");

    $cacheKey = 'adAccountsActivities' . $startDate . $endDate;
    //Cache::forget($cacheKey);
    //Cache::flush();
    if (Cache::has($cacheKey)) {
        $response = Cache::get($cacheKey);
        $response = array_merge([], $response['client_ad_accounts']);
    } else {
        $fbData = adAccountsActivities($fb, $startDate, $endDate);
        if ($fbData) {

            Cache::put($cacheKey, $fbData, 900);
            $response = Cache::get($cacheKey);
            $response = array_merge([], $response['client_ad_accounts']);
            file_put_contents('logs/fbgraphqlact_' . date('Y_m_d_H_i') . '.json', json_encode($response));

        } else {
            $response = ['message' => 'bir hata var'];
        }
    }



    return response()->json($response);

});*/
$router->get('/adAccounts', function (Request $request) use ($router, $fb, $bmId) {

    $startDate = $request->has('startDate') ? $request->get('startDate') : date("Y-m-d");
    $endDate   = $request->has('endDate') ? $request->get('endDate') : date("Y-m-d");

    $cacheKey = $bmId . 'adAccounts' . $startDate . $endDate;
    //Cache::forget($cacheKey);
    //Cache::flush();
    if (Cache::has($cacheKey)) {
        $response = Cache::get($cacheKey);
        $response = array_merge([], $response['client_ad_accounts']);
    } else {
        $fbData = getFacebookData($fb, $startDate, $endDate, $bmId);

        if ($fbData) {

            Cache::put($cacheKey, $fbData, 600);
            $response = Cache::get($cacheKey);
            $response = array_merge([], $response['client_ad_accounts']);
            file_put_contents('logs/fbgraphql_' . date('Y_m_d_H_i').$bmId . '.json', json_encode($response));

        } else {
            $response = ['message' => 'bir hata var'];
        }
    }

    /*
    foreach (array_merge([], ...array_column($response,'campaigns')) as $ckey => $campaign) {
    $insert = [];
    $insert['campaign_id'] = $campaign['id'];
    $insert['account_id'] = $campaign['account_id'];
    $insert['data'] = json_encode($campaign);
    if ($campaign['id']) {
    $where['campaign_id'] = $campaign['id'];
    } else {
    $where['campaign_id'] = $campaign['id'];

    }
    DB::connection('facebook')->table('campaigns')->updateOrInsert($where, $insert);
    }

    foreach (array_merge([], ...array_column($response,'adsets')) as $askey => $adset) {
    $insert = [];
    $insert['campaign_id'] = $adset['campaign_id'];
    $insert['account_id'] = $adset['account_id'];
    $insert['adset_id'] = $adset['id'];
    $insert['data'] = json_encode($adset);
    if ($adset['id']) {
    $where['adset_id'] = $adset['id'];
    } else {
    $where['adset_id'] = $adset['id'];

    }
    DB::connection('facebook')->table('adsets')->updateOrInsert($where, $insert);
    }
     */

    return response()->json($response);

});

$router->get('/adAccountDetail/{accountId}', function (Request $request, $accountId) use ($router, $fb) {
    $startDate = date("Y-m-d");
    $endDate   = date("Y-m-d");
    $cacheKey  = 'adAccounts' . $startDate . $endDate;
    $response  = [];
    /*if (Cache::has($cacheKey)) {
    $response =  Cache::get($cacheKey);
    }*/

    $response = getAccountDetail($fb, $accountId) ?: [];
    return response()->json($response);

});

$router->get('/bm_accounts', function (Request $request) use ($router) {

    $response = DB::connection('facebook')->table('bm_accounts')->get()->toArray();
    return response()->json($response);

});

$router->post('/addBm', function (Request $request) use ($router) {
    $requestAll               = $request->all();
    DB::connection('facebook')->table('bm_accounts')->updateOrInsert(['bm_id' => $request->bm_id], $requestAll);
    return response()->json(DB::connection('facebook')->table('bm_accounts')->get()->toArray());

});
$router->post('/addNote', function (Request $request) use ($router) {
    $requestAll               = $request->all();
    $requestAll['updateTime'] = \Carbon\Carbon::now();
    DB::connection('facebook')->table('notes')->insert($requestAll);
    return response()->json(DB::connection('facebook')->table('notes')->where('objectId', $request->get('objectId'))->get()->toArray());

});

$router->get('/getNotes/{objectId}', function ($objectId) use ($router) {

    return response()->json(DB::connection('facebook')->table('notes')->where('objectId', $objectId)->get()->toArray());

});

$router->get('/deleteNote/{notId}', function ($notId) use ($router) {
    $not  = DB::connection('facebook')->table('notes')->where('id', $notId)->get()->toArray();
    $nots = $not ? DB::connection('facebook')->table('notes')->where('id', '!=', $notId)->where('objectId', $not[0]->objectId)->get()->toArray() : [];

    DB::connection('facebook')->table('notes')->where('id', $notId)->delete();
    return response()->json($nots);

});

$router->get('/getAllNotes', function () use ($router) {
    $notes = DB::connection('facebook')->table('notes')->select(DB::raw('*, max(id) as id'))
        ->orderBy('id', 'desc')
        ->groupBy('objectId')
        ->get();
    return response()->json($notes->toArray());

});
