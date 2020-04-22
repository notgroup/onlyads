<?php
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

require_once('config.php');

function getFacebookData($fb, $startDate, $endDate){
  $response = false;
  try {
    $response = $fb->get("156479078851727?fields=client_ad_accounts.limit(100){amount_spent,business_name,balance,name,adspixels{name,id},insights.level(account).default_summary(0).time_range({'since':'$startDate','until':'$endDate'}).time_increment(all_days){account_id,date_start,date_stop,spend,unique_clicks,cost_per_unique_click,unique_actions,cost_per_unique_action_type,account_currency},ads{id,creative,account_id,campaign_id,adset_id,configured_status,effective_status,name,recommendations,status,updated_time,issues_info,ad_review_feedback},disable_reason,account_status,created_time,id,currency,business,account_id,is_prepay_account,is_personal},owned_ad_accounts.limit(100){amount_spent,business_name,balance,name,adspixels{name,id},insights.level(account).default_summary(0).time_range({'since':'$startDate','until':'$endDate'}).time_increment(all_days){account_id,date_start,date_stop,spend,unique_clicks,cost_per_unique_click,unique_actions,cost_per_unique_action_type,account_currency},ads{id,creative,account_id,campaign_id,adset_id,configured_status,effective_status,name,recommendations,status,updated_time,issues_info,ad_review_feedback},disable_reason,account_status,created_time,id,currency,business,account_id,is_prepay_account,is_personal}");
    $response = $response->getGraphNode()->asArray();
  //$response = $fb->get('me?fields=businesses{id,name,client_ad_accounts{business,id,balance,name}}');
  } catch(FacebookResponseException $e) {
  // When Graph returns an error
    $error =  'Graph returned an error: ' . $e->getMessage();

  } catch(FacebookSDKException $e) {
  // When validation fails or other local issues
    $error =  'Facebook SDK returned an error: ' . $e->getMessage();

  }


  return $response;
}


$router->get('/adAccounts', function (Request $request) use ($router, $fb) {

  $startDate = $request->has('startDate') ? $request->get('startDate') : date("Y-m-d");
  $endDate = $request->has('endDate') ? $request->get('endDate') : date("Y-m-d");


  $cacheKey = 'adAccounts'. $startDate.$endDate;
  Cache::forget($cacheKey);
//Cache::flush();
  if (Cache::has($cacheKey)) {
    $response =  Cache::get($cacheKey);
    $response =  array_merge([], $response['client_ad_accounts'], $response['owned_ad_accounts']);
  } else {
    $fbData = getFacebookData($fb, $startDate, $endDate);
    if ($fbData) {

      Cache::put($cacheKey, $fbData, 600);
      $response =  Cache::get($cacheKey);
      $response =  array_merge([], $response['client_ad_accounts'], $response['owned_ad_accounts']);
      file_put_contents('graphLogs/fbgraphql_'.date('Y_m_d_H_i').'.json', json_encode($response));

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


$router->post('/addNote', function (Request $request) use ($router) {
  $requestAll = $request->all();
  $requestAll['updateTime'] = \Carbon\Carbon::now();
  DB::connection('facebook')->table('notes')->insert($requestAll);
  return response()->json(DB::connection('facebook')->table('notes')->where('objectId', $request->get('objectId'))->get()->toArray());

});

$router->get('/getNotes/{objectId}', function ($objectId) use ($router) {

  return response()->json(DB::connection('facebook')->table('notes')->where('objectId', $objectId)->get()->toArray());

});
$router->get('/deleteNote/{notId}', function ($notId) use ($router) {
  $not = DB::connection('facebook')->table('notes')->where('id', $notId)->get()->toArray();
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
