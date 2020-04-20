<?php
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use Illuminate\Support\Facades\Cache;

require_once('config.php');



function getFacebookData($fb){
  $response = false;
  try {
    $response = $fb->get('156479078851727?fields=client_ad_accounts.limit(100){amount_spent,balance,name,adspixels{name,id},insights{account_id,clicks,action_values,conversion_rate_ranking,conversion_values,conversions,cost_per_conversion,cost_per_inline_link_click,cost_per_inline_post_engagement,cost_per_outbound_click,cost_per_thruplay,cost_per_unique_click,cost_per_unique_inline_link_click,cpc,cpm,cpp,ctr,date_start,date_stop,frequency,spend,unique_clicks,unique_ctr,unique_actions,cost_per_unique_action_type,cost_per_action_type,cost_per_unique_outbound_click,outbound_clicks,outbound_clicks_ctr,unique_outbound_clicks,unique_outbound_clicks_ctr,unique_link_clicks_ctr,website_ctr,website_purchase_roas,account_currency},campaigns.limit(10){id,name,objective,status,account_id,issues_info,effective_status,configured_status,updated_time,recommendations},adcreatives.limit(100){id,account_id,object_story_spec,object_type,object_url,name,status,image_url,thumbnail_url,title,video_id,body,recommender_settings,destination_set_id,link_url,object_id,place_page_set_id},adsets{account_id,campaign_id,configured_status,destination_type,effective_status,id,name,recommendations,review_feedback,start_time,status,updated_time,issues_info},ads{id,creative,account_id,campaign_id,adset_id,ad_review_feedback,configured_status,effective_status,issues_info,name,recommendations,status,updated_time,bid_amount},disable_reason,account_status,created_time,id,currency,business,account_id},owned_ad_accounts.limit(100){amount_spent,balance,name,adspixels{name,id},insights{account_id,clicks,action_values,conversion_rate_ranking,conversion_values,conversions,cost_per_conversion,cost_per_inline_link_click,cost_per_inline_post_engagement,cost_per_outbound_click,cost_per_thruplay,cost_per_unique_click,cost_per_unique_inline_link_click,cpc,cpm,cpp,ctr,date_start,date_stop,frequency,spend,unique_clicks,unique_ctr,unique_actions,cost_per_unique_action_type,cost_per_action_type,cost_per_unique_outbound_click,outbound_clicks,outbound_clicks_ctr,unique_outbound_clicks,unique_outbound_clicks_ctr,unique_link_clicks_ctr,website_ctr,website_purchase_roas,account_currency},campaigns.limit(10){id,name,objective,status,account_id,issues_info,effective_status,configured_status,updated_time,recommendations},adcreatives.limit(100){id,account_id,object_story_spec,object_type,object_url,name,status,image_url,thumbnail_url,title,video_id,body,recommender_settings,destination_set_id,link_url,object_id,place_page_set_id},adsets{account_id,campaign_id,configured_status,destination_type,effective_status,id,name,recommendations,review_feedback,start_time,status,updated_time,issues_info},ads{id,creative,account_id,campaign_id,adset_id,ad_review_feedback,configured_status,effective_status,issues_info,name,recommendations,status,updated_time,bid_amount},disable_reason,account_status,created_time,id,currency,business,account_id}');
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


$router->get('/adAccounts', function () use ($router, $fb) {

  if (Cache::has('adAccounts')) {
    $response =  Cache::get('adAccounts');
    $response =  array_merge([], $response['client_ad_accounts'], $response['owned_ad_accounts']);
  } else {
    $fbData = getFacebookData($fb);
    if ($fbData) {

      Cache::put('adAccounts', $fbData, \Carbon\Carbon::now()->addMinutes(7200222));
      $response =  Cache::get('adAccounts');
      $response =  array_merge([], $response['client_ad_accounts'], $response['owned_ad_accounts']);


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


$router->post('/addNote', function () use ($router) {
  $requestAll = request()->all();
  $requestAll['updateTime'] = \Carbon\Carbon::now();
  DB::connection('facebook')->table('notes')->insert($requestAll);
  return response()->json(DB::connection('facebook')->table('notes')->where('objectId', request()->get('objectId'))->get()->toArray());

});

$router->get('/getNotes/{objectId}', function ($objectId) use ($router) {

  return response()->json(DB::connection('facebook')->table('notes')->where('objectId', $objectId)->get()->toArray());

});
