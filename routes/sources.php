<?php

/*


Array
(
    [0] => __construct
    [1] => getApp
    [2] => getClient
    [3] => getOAuth2Client
    [4] => getLastResponse
    [5] => getUrlDetectionHandler
    [6] => getDefaultAccessToken
    [7] => setDefaultAccessToken
    [8] => getDefaultGraphVersion
    [9] => getRedirectLoginHelper
    [10] => getJavaScriptHelper
    [11] => getCanvasHelper
    [12] => getPageTabHelper
    [13] => get
    [14] => post
    [15] => delete
    [16] => next
    [17] => previous
    [18] => getPaginationResults
    [19] => sendRequest
    [20] => sendBatchRequest
    [21] => newBatchRequest
    [22] => request
    [23] => fileToUpload
    [24] => videoToUpload
    [25] => uploadVideo
)
https://developers.facebook.com/docs/marketing-api/sdks/
https://benmarshall.me/facebook-php-sdk/2/#step-1
https://www.devils-heaven.com/facebook-php-sdk-5-tutorial/
https://developers.facebook.com/docs/marketing-api/reference/ad-account/adsets/#Creating
https://developers.facebook.com/docs/marketing-api/reference/ad-account/ads/#Creating
https://developers.facebook.com/docs/marketing-api/reference/ad-account/adcreatives/
https://developers.facebook.com/docs/marketing-api/reference/ad-account/advideos/#Creating
https://developers.facebook.com/docs/graph-api/video-uploads/#start
https://developers.facebook.com/docs/marketing-api/reference/ad-creative#Creating

$router->post('/addAdVideoTest', function (Request $request)  use ($router, $fb) {
/*
https://developers.facebook.com/docs/marketing-api/reference/ad-account/advideos#Creating
https://developers.facebook.com/docs/marketing-api/guides/videoads

*/
/*
print_r(filesize($filename));
die();*/
$filename = 'sample01.mp4';
  /*  try {
        // Returns a `Facebook\FacebookResponse` object
        $response = $fb->post('/act_241006230622084/advideos',
        array(
            "upload_phase" => "start",
            "file_size"  =>  $_FILES['file']['size']     
        ));
      } catch(Facebook\Exceptions\FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
      } catch(Facebook\Exceptions\FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
      }

      $graphNode = $response->getGraphNode();

      $postDataCreateAccount = [
        "upload_phase"=>"transfer",
        "start_offset"=>0,
        "upload_session_id"=>$graphNode->asArray()["upload_session_id"],
        "video_file_chunk"=>'@'.$_FILES['file']['tmp_name'],
        "access_token" => "EAADWuzThkAcBAKuFWZA2p5RmjfnJHUVCbnsKtBq904zOjkg0BYrcTPiZCWI0FAdJ1CZCoCrJLtsLKi10cDiWEHi3mRWgatqnC7ZB8cKan12acqyjZBsOYqPwR6kPZB3atmDpE76cKVBZBM3LHNLFuhjj5jejqwmB5sMe4U0f20yToQ3TNiEDZCCP",
      ];
*/
$postSession = [
    "upload_phase" => "start","file_size"  =>  $_FILES['file']['size'],
    "access_token" => "EAADWuzThkAcBAKuFWZA2p5RmjfnJHUVCbnsKtBq904zOjkg0BYrcTPiZCWI0FAdJ1CZCoCrJLtsLKi10cDiWEHi3mRWgatqnC7ZB8cKan12acqyjZBsOYqPwR6kPZB3atmDpE76cKVBZBM3LHNLFuhjj5jejqwmB5sMe4U0f20yToQ3TNiEDZCCP",
  ];

      $session =  getCurl("https://graph-video.facebook.com/v7.0/act_241006230622084/advideos", [], $postSession);
    //  return response()->json(json_decode($session, 1));

      $session =  json_decode($session, 1);

      $postDataCreateAccount = [
        "upload_phase"=>"transfer",
        "start_offset"=>0,
        "upload_session_id"=>$session["upload_session_id"],
        "video_file_chunk"=>'@'.$_FILES['file']['tmp_name'],
        "access_token" => "EAADWuzThkAcBAKuFWZA2p5RmjfnJHUVCbnsKtBq904zOjkg0BYrcTPiZCWI0FAdJ1CZCoCrJLtsLKi10cDiWEHi3mRWgatqnC7ZB8cKan12acqyjZBsOYqPwR6kPZB3atmDpE76cKVBZBM3LHNLFuhjj5jejqwmB5sMe4U0f20yToQ3TNiEDZCCP",
      ];



      $curlData =  getCurl("https://graph-video.facebook.com/v7.0/act_241006230622084/advideos", [], $postDataCreateAccount);
    return response()->json(json_decode($curlData, 1));

});


$router->post('/addAdVideoTest2', function (Request $request)  use ($router, $fb) {
/*
https://developers.facebook.com/docs/marketing-api/reference/ad-account/advideos#Creating
https://developers.facebook.com/docs/marketing-api/guides/videoads





*/
    /*try {
        // Returns a `Facebook\FacebookResponse` object
        $response = $fb->post('/act_241006230622084/advideos',
        array(
            "upload_phase" => "start",
            "file_size"  =>  152043520     
        ));
      } catch(Facebook\Exceptions\FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
      } catch(Facebook\Exceptions\FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
      }

      $graphNode = $response->getGraphNode();

    return response()->json($graphNode->asArray());*/

});

$tokens = [
  "530512111162643" => [
    "app_secret" => "215697765b7968953ab39de3af7c4d5b",
    "app_id" => "2601891003400553",
    "access_token" => "EAAkZBZAZCUAgWkBAEbrldKId3b2Y9Qyd6LjfWoaTm9qsTlovfzwXpeyudKXroV3IwidEG5TPeIsDtofmdSFpHAW57aWNX6ZCrW8Nv9uqZAiHKhUc8ZAG1MMrgtqPPqKfC9CTRrAH96uo5pxMTr7N7YXr1wpqEZAXQvwEhy4scQ5W1WXf5uS0pyc"
  ],
  "3191402807537654" => [
    "app_secret" => "fb45edc174cc3c4aed65f6a6b3d4d9e5",
    "app_id" => "230894151343130",
    "access_token" => "EAADRZCzvfHBoBAG70fSUL6xcJXAPrtZAXYo3Nf18HGFJ5uPIyZB8AAJZB2A3YgsJJLclVwR8dkbh9lHNw7fjxJhfxOOI9mUpNnnI8HIBr9qVPUoKa9pUZBbfZC8fWGr6RMcJmCJenQFZCKzZBvtHhl7yuPd3SyuTffaXWVYtvsusfgZDZD"
  ]
];

print_r($tokens[$bmId]['app_secret']);
die();
$fb = new \Facebook\Facebook([
  'app_id' => $tokens[$bmId]['app_secret'],
  'app_secret' => $tokens[$bmId]['app_id'],
  'default_graph_version' => 'v6.0',
  'default_access_token' => $tokens[$bmId]['access_token'], // optional
]);
*/
/*
$tokens = [
    "530512111162643" => [
    "app_secret" => "215697765b7968953ab39de3af7c4d5b",
    "app_id" => "2601891003400553",
    "access_token" => "EAAkZBZAZCUAgWkBAEbrldKId3b2Y9Qyd6LjfWoaTm9qsTlovfzwXpeyudKXroV3IwidEG5TPeIsDtofmdSFpHAW57aWNX6ZCrW8Nv9uqZAiHKhUc8ZAG1MMrgtqPPqKfC9CTRrAH96uo5pxMTr7N7YXr1wpqEZAXQvwEhy4scQ5W1WXf5uS0pyc"
  ],
  "156479078851727" => [
    "app_secret" => "61dc8d2dbe452894981432eb7ec02ac6",
    "app_id" => "150821419662950",
    "access_token" => "EAACJK9kkvmYBAEBEszq1SWoDCb9nGiZCPuC8fZAVP5ck6cl5uxtzyiWj3oI8dOACLaGcmDW5O4p1mXB0cvZA7s4QJltNib1bwxxIytZAAwgN8sQ7dAZAu9NREaUoCbB2iPoCQK8AauLRdTEZCBUwykE89rdSX6YgprjQTcgBxSVgZDZD"
  ],
  "3191402807537654" => [
    "app_secret" => "fb45edc174cc3c4aed65f6a6b3d4d9e5",
    "app_id" => "230894151343130",
    "access_token" => "EAADRZCzvfHBoBAG70fSUL6xcJXAPrtZAXYo3Nf18HGFJ5uPIyZB8AAJZB2A3YgsJJLclVwR8dkbh9lHNw7fjxJhfxOOI9mUpNnnI8HIBr9qVPUoKa9pUZBbfZC8fWGr6RMcJmCJenQFZCKzZBvtHhl7yuPd3SyuTffaXWVYtvsusfgZDZD"
  ]
];*/



/*


LONG LİVE TOKEN

if (isset($accessToken)) {
  // Logged in!
  $oAuth2Client = $fb->getOAuth2Client();
  $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
  $_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
} elseif ($helper->getError()) {
  // The user denied the request
}





http://www.tulane.edu/~howard/CompCultES/facebook.html
https://developers.facebook.com/docs/php/howto/example_pagination_basic/
https://developers.facebook.com/docs/facebook-login/access-tokens/refreshing
https://developers.facebook.com/docs/marketing-api/2tier-bm-solution
https://graph.facebook.com/v6.0/oauth/access_token?grant_type=fb_exchange_token&client_id=150821419662950&client_secret=61dc8d2dbe452894981432eb7ec02ac6&fb_exchange_token=EAACJK9kkvmYBAI57kqRyXjFcIuG2Jmom0QzYs1VMYlKWs64dT4Kt2vwOu5ZAWRV8cZBjMPbBmDOQBZBLwaV78Mjn4cGEZCAyj73fpVsJWJcurLmDkMBZBhULHLSetVqavoLKMmbk8Hx50sBTtlE0Jhpc9Y6KZBZAGc55qMUikC7uZABYy9YAc019cf6JgIjZCdC8ZD
https://developers.facebook.com/docs/marketing-api/business-creative-asset-management/get-started
https://developers.facebook.com/docs/marketing-api/business-creative-asset-management/reference
https://developers.facebook.com/docs/marketing-api/reference/business/managed_businesses/#Updating
https://developers.facebook.com/docs/marketing-api/business-asset-management/guides/business-to-business
https://developers.facebook.com/docs/marketing-api/audiences-api/pixel
https://developers.facebook.com/docs/business-manager-api

YETKİ ALMA: https://developers.facebook.com/docs/marketing-api/business-asset-management/guides/ad-accounts#adaccounts-add-people

date_area

156479078851727?time_increment=1&breakdowns=DAY&action_report_time=conversion&fields=client_ad_accounts.limit(100){amount_spent,balance,name,adspixels{name,id},insights.time_range({'since':'2020-04-17','until':'2020-04-17'}).date_preset(last_3d).time_increment(1){clicks,action_values,conversion_rate_ranking,conversion_values,conversions,cost_per_conversion,cost_per_inline_link_click,cost_per_inline_post_engagement,cost_per_outbound_click,cost_per_thruplay,cost_per_unique_click,cost_per_unique_inline_link_click,cpc,cpm,cpp,ctr,date_start,date_stop,frequency,spend,unique_clicks,unique_ctr,unique_actions,cost_per_unique_action_type,cost_per_action_type,cost_per_unique_outbound_click,outbound_clicks,outbound_clicks_ctr,unique_outbound_clicks,unique_outbound_clicks_ctr,unique_link_clicks_ctr,website_ctr,website_purchase_roas,account_currency,purchase_roas,account_id},campaigns.limit(10){id,name,objective,status,account_id,issues_info,effective_status,configured_status,updated_time,recommendations,spend_cap,buying_type},adcreatives.limit(100){id,account_id,object_story_spec,object_type,object_url,name,status,image_url,thumbnail_url,title,video_id,body,recommender_settings,destination_set_id,link_url,object_id,place_page_set_id},adsets{account_id,campaign_id,configured_status,destination_type,effective_status,id,name,recommendations,review_feedback,start_time,status,updated_time,issues_info},ads{id,creative,account_id,campaign_id,adset_id,ad_review_feedback,configured_status,effective_status,issues_info,name,recommendations,status,updated_time},disable_reason,account_status,created_time,id,currency,business,account_id,end_advertiser,end_advertiser_name,permitted_tasks}&summary=total_count&date_preset=today&level=campaign


############

{
  "adaccount_id": "act_157350392333612",
  "permitted_tasks": ["MANAGE", "ADVERTISE", "ANALYZE","CREATIVE", "DRAFT"]
}



{
  "name": "CRM TEST04",
  "objective": "LINK_CLICKS",
  "status": "PAUSED",
  "special_ad_categories": ["NONE"],
  "spend_cap": 20000,
  "daily_budget": 10000
}

POST/UPDATE
/act_1135244020162282
/act_1135244020162282/campaigns
{
  "name": "CRM TEST02",
  "objective": "LINK_CLICKS",
  "status": "PAUSED",
  "special_ad_categories": ["NONE"],
  "spend_cap": 40,
  "bid_strategy"
}



curl \
-F "user=APP_SCOPED_SYSTEM_USER_ID" \
-F "tasks=['ADVERTISE', 'ANALYZE']" \
-F "access_token=ACCESS_TOKEN" \
"https://graph.facebook.com/VERSION>/PAGE_ID/assigned_users"


### media_agency_id, partner_id, end_advertiser_id sorunsalına çözüm olabilir

act_359786148306782?fields=agencies{id,name,access_status,link,permitted_tasks,verification_status,vertical,system_users{id,name,role,ip_permission,finance_permission,assigned_ad_accounts{id,name}}},media_agency,id,name,business

##### BURAYA BAK MUTLAKA
https://developers.facebook.com/docs/marketing-api/business-asset-management/guides/business-to-business
https://developers.facebook.com/docs/marketing-api/system-users/guides/permissions
https://stackoverflow.com/questions/49368744/facebook-api-request-business-manager-partnership/49375420#49375420
https://developers.facebook.com/search/?referer=dev_header&q=system%20users
https://developers.facebook.com/docs/marketing-api/reference/ad-account/assigned_users/
https://developers.facebook.com/docs/marketing-api/guides/smb/payments-loc#creating-an-ad-account
https://developers.facebook.com/docs/marketing-api/bidding/overview/billing-events/

###### reklam hesaplarının hiç banlanmaması için:
https://developers.facebook.com/docs/marketing-api/business-manager/get-started/#business

POST /act_<client_ad_account_id>/agencies

add campaign
https://developers.facebook.com/docs/marketing-api/advideo/v7.0#chunked


me/assigned_ad_accounts
https://developers.facebook.com/docs/marketing-api/business-asset-management/overview
https://stackoverflow.com/questions/61567140/adimages-upload-is-not-doing-anything
https://stackoverflow.com/questions/56338825/facebook-marketing-api-ad-creatives
https://developers.facebook.com/docs/marketing-api/reference/ad-account#Creating
https://developers.facebook.com/docs/marketing-api/reference/ad-account/adcreatives/
https://developers.facebook.com/docs/marketing-api/reference/ad-account/ads/#Creating
https://developers.facebook.com/docs/marketing-api/reference/ad-account/adsets/#Creating
https://developers.facebook.com/docs/marketing-api/reference/v7.0
https://developers.facebook.com/docs/marketing-api/reference/ad-account#example-2
POST=act_247619836445339/campaigns?name=Gokhan+Test&objective=LINK_CLICKS&status=PAUSED&special_ad_categories=%5B%5D
act_1135244020162282/campaigns?name=CRM01+Test01&objective=LINK_CLICKS&status=PAUSED&special_ad_categories=%5B%5D

102788801411456/clients?fields=application_permissions,adaccount_permissions
102788801411456/client_ad_accounts?fields=name,account_id,id,permitted_tasks
############

########### level, summary

156479078851727?fields=client_ad_accounts.limit(100){amount_spent,balance,name,adspixels{name,id},insights.level(account).default_summary(0).summary(conversions,unique_ctr).time_range({'since':'2020-04-14','until':'2020-04-19'}).date_preset(last_14d).time_increment(1){clicks,conversion_rate_ranking,conversion_values,conversions,cost_per_conversion,cost_per_inline_link_click,cost_per_inline_post_engagement,cost_per_unique_click,cost_per_unique_inline_link_click,cpc,cpm,cpp,ctr,date_start,date_stop,frequency,spend,unique_clicks,unique_ctr,unique_link_clicks_ctr,account_currency,account_id},campaigns.limit(10){id,name,objective,status,account_id,issues_info,effective_status,configured_status,updated_time,recommendations,spend_cap,buying_type},adcreatives.limit(100){id,account_id,object_story_spec,object_type,object_url,name,status,image_url,thumbnail_url,title,video_id,body,recommender_settings,destination_set_id,link_url,object_id,place_page_set_id},adsets{account_id,campaign_id,configured_status,destination_type,effective_status,id,name,recommendations,review_feedback,start_time,status,updated_time,issues_info},ads{id,creative,account_id,campaign_id,adset_id,ad_review_feedback,configured_status,effective_status,issues_info,name,recommendations,status,updated_time},disable_reason,account_status,created_time,id,currency,business,account_id,end_advertiser,end_advertiser_name,permitted_tasks}


insights_prefix_variants=
insights.level(account).default_summary(0).summary(conversions,unique_ctr).time_range({'since':'2020-04-14','until':'2020-04-19'}).date_preset(last_14d).time_increment(1)
insights.level(account).default_summary(1).time_range({'since':'2020-04-14','until':'2020-04-19'}).date_preset(last_14d).time_increment(all_days)
insights.level(account).default_summary(0).time_range({'since':'2020-04-14','until':'2020-04-19'}).time_increment(all_days)




156479078851727?fields=client_ad_accounts.limit(100){amount_spent,balance,name,adspixels{name,id},insights.level(account).default_summary(0).time_range({'since':'2020-04-14','until':'2020-04-19'}).time_increment(all_days){account_id,date_start,date_stop,spend,unique_clicks,unique_ctr,unique_actions,cost_per_unique_action_type,account_currency},ads{id,creative,account_id,campaign_id,adset_id,configured_status,effective_status,name,recommendations,status,updated_time,issues_info,ad_review_feedback},disable_reason,account_status,created_time,id,currency,business,account_id,is_prepay_account,is_personal},owned_ad_accounts.limit(100){amount_spent,balance,name,adspixels{name,id},insights.level(account).default_summary(0).time_range({'since':'2020-04-14','until':'2020-04-19'}).time_increment(all_days){account_id,date_start,date_stop,spend,unique_clicks,unique_ctr,unique_actions,cost_per_unique_action_type,account_currency},ads{id,creative,account_id,campaign_id,adset_id,configured_status,effective_status,name,recommendations,status,updated_time,issues_info,ad_review_feedback},disable_reason,account_status,created_time,id,currency,business,account_id,is_prepay_account,is_personal}


#####after url

156479078851727/client_ad_accounts?pretty=0&fields=name%2Cfunding_source_details%2Cend_advertiser_name&limit=25&after=QVFIUmRkX3BWOHQ0OWhaUmtSSnBCSDBQUk9GNnBQd0ZAzUnJtZA243cU5HTVhmZAFQ4aExNVlJEbGUwUGtaYUhfQzFNS21aNjVwRTU3blcxMDRsUEpXR3hQcUFn

    /*
    print_r(count($responseArr));
    die();
     */

    //$response = $response->getGraphNode();
    // $response = $response->getGraphEdge();
    //getGraphEdge()->asArray()

    //    print_r(get_class_methods($response->getGraphNode()));
    //   print_r($response->getDecodedBody());
    // print_r(get_class_methods($response->getGraphNode()->getField('client_ad_accounts')));
    // print_r($response->getGraphNode()->getField('client_ad_accounts')->getNextPageRequest());
    // print_r($response->getGraphNode()->getField('client_ad_accounts')->getPaginationUrl('next'));
    //print_r(get_class_methods($response->getGraphNode()->getField('client_ad_accounts')->getNextPageRequest()));
    // print_r($response->getGraphNode()->getField('client_ad_accounts')->getMetaData());
    // print_r($response->getGraphNode()->getField('client_ad_accounts')->getNextPageRequest()->getUrl());
    // print_r($response->getGraphNode()->getField('client_ad_accounts'));
    //  print_r($response->getGraphNode()->asArray());
    //  print_r($response->getDecodedBody());
    //print_r($response);
    //print_r($error);
    //die();

/*
print_r(count($responseArr));
die();

$responseArr[] = $response->getGraphNode()->asArray();

do {
$response = $fb->get($response->getGraphNode()->getField('client_ad_accounts')->getPaginationUrl('next'));
$responseArr[] = $response->getGraphNode()->asArray();
print_r(get_class_methods($response->getGraphNode()));

foreach ($response->asArray() as $item){
//do something with it
}

} while(isset($response->getDecodedBody()['client_ad_accounts']) && isset($response->getDecodedBody()['client_ad_accounts']['paging']) && isset($response->getDecodedBody()['client_ad_accounts']['paging']['next']));

print_r($responseArr);
die();
 */

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




    /*
$postDataAddCampaignUrl = "https://graph.facebook.com/v7.0/act_255908718825367/campaigns";
$postDataAddCampaign = json_decode('{
    "name": "CRM TEST",
    "objective": "BRAND_AWARENESS",
    "status": "PAUSED",
    "special_ad_categories": ["NONE"],
    "spend_cap": 20000,
    "daily_budget": 10000,
    "bid_strategy": "LOWEST_COST_WITHOUT_CAP",
    "access_token" => "EAADWuzThkAcBAKuFWZA2p5RmjfnJHUVCbnsKtBq904zOjkg0BYrcTPiZCWI0FAdJ1CZCoCrJLtsLKi10cDiWEHi3mRWgatqnC7ZB8cKan12acqyjZBsOYqPwR6kPZB3atmDpE76cKVBZBM3LHNLFuhjj5jejqwmB5sMe4U0f20yToQ3TNiEDZCCP"
  }', true);
*/

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