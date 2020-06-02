<?php
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

require_once 'config.php';

function getFacebookData($fb, $startDate, $endDate, $bmId)
{
    $response = false;
    $error    = false;
    try {
        $clientAdAccountFields  = "permitted_tasks,disable_reason,account_status,id,business,account_id,is_prepay_account,name";
        $clientAdAdsFields      = "ads.limit(1){effective_status,name,status}";
        $clientAdInsightsFields = "insights.level(campaign).time_range({'since':'$startDate','until':'$endDate'}).time_increment(all_days)"
            . "{spend,unique_clicks,cost_per_unique_click,unique_actions,cost_per_unique_action_type}";
        $response = $fb->get($bmId . "/client_ad_accounts?limit=100&fields=campaigns.limit(1){daily_budget},$clientAdInsightsFields,$clientAdAdsFields,$clientAdAccountFields");
        // $response = $response->getDecodedBody();

        if ($response->getDecodedBody()['data']) {
            $responseArr = [];

            $responseArr = (array) $response->getGraphEdge()->asArray();
            if (isset($response->getDecodedBody()['paging']) && isset($response->getDecodedBody()['paging']['next'])) {
                //$nextUrl = str_replace('https://graph.facebook.com/v7.0/', '', $response->getDecodedBody()['paging']['next']);
                do {
                    //print_r(count($response->getDecodedBody()['data']));
                    $nextUrl     = str_replace('https://graph.facebook.com/v7.0/', '', $response->getDecodedBody()['paging']['next']);
                    $response    = $fb->get($nextUrl);
                    $responseArr = array_merge($responseArr, $response->getGraphEdge()->asArray());
                    sleep(1);

                } while ((isset($response->getDecodedBody()['paging']) && isset($response->getDecodedBody()['paging']['next'])));

            }

        }
    } catch (FacebookResponseException $e) {
        // When Graph returns an error
        $error = 'Graph returned an error: ' . $e->getMessage();

    } catch (FacebookSDKException $e) {
        // When validation fails or other local issues
        $error = 'Facebook SDK returned an error: ' . $e->getMessage();

    }

    return count($responseArr) ? $responseArr : false;
}

function getAccountDetail($fb, $accountId)
{
    $response = false;
    try {
        $response = $fb->get("act_" . $accountId . "?fields=permitted_tasks,account_id,id,is_prepay_account,name,business_name,business,disable_reason,account_status,ads{effective_status,status,configured_status,ad_review_feedback,recommendations,issues_info},activities{actor_name,application_name,date_time_in_timezone,event_time,event_type,extra_data,object_id,object_name,object_type,translated_event_type}");
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

$router->get('/adAccounts', function (Request $request) use ($router, $fb, $bmId) {

    $startDate = $request->has('startDate') ? $request->get('startDate') : date("Y-m-d");
    $endDate   = $request->has('endDate') ? $request->get('endDate') : date("Y-m-d");

    $cacheKey = $bmId . 'adAccounts' . $startDate . $endDate;
    //Cache::forget($cacheKey);
   // Cache::flush();

    if (Cache::has($cacheKey)) {
        $response = Cache::get($cacheKey);
        $response = array_merge([], $response);
    } else {

        if (
            //1 == 1 ||
            $startDate == date("Y-m-d") && $endDate == date("Y-m-d")) {
                $contents = DB::connection('facebook')->table('adaccounts')
                ->where('parent_business_id', $bmId)
                ->whereDate('reportDate', '>=', $startDate)
                ->whereDate('reportDate', '<=', $endDate)
                ->pluck('content')->toArray();
            $response = array_map(function ($account) {

                return json_decode($account, 1);
            }, $contents);
            Cache::put($cacheKey, $response, 300);
        } else {
            $fbData = getFacebookData($fb, $startDate, $endDate, $bmId);

            if ($fbData) {



                $response = array_merge([], $fbData);
                foreach ($response as $ckey => $adaccount) {

                    $updateArr = [
                        'account_id'                => $adaccount['account_id'],
                        'account_name'              => $adaccount['name'],
                        'parent_business_id'        => $bmId,
                        'business_id'               => $adaccount['business']['id'],
                        'business_name'             => $adaccount['business']['name'],
                        'is_prepay_account'         => $adaccount['is_prepay_account'] ? 1 : 0,
                        'insights_spend'            => 0,
                        'unique_clicks'             => 0,
                        'cost_per_unique_click'     => 0,
                        'disable_reason'            => $adaccount['disable_reason'],
                        'account_status'            => $adaccount['account_status'],
                        'ads_effective_status'      => null,
                        'ads_status'                => null,
                        'campaigns_daily_budget'    => 0,
                        'unique_omni_purchase'      => 0,
                        'unique_cost_omni_purchase' => 0,
                        'content'                   => json_encode($adaccount),
                        'reportDate'                => date("Y-m-d"),
                        'updateTime'                => (int) strtotime("now"),
                    ];

                    if (isset($adaccount['ads']) && isset($adaccount['ads'][0])) {
                        $updateArr['ads_effective_status'] = $adaccount['ads'][0]['effective_status'];
                        $updateArr['ads_status']           = $adaccount['ads'][0]['status'];
                    }
                    if (isset($adaccount['campaigns']) && isset($adaccount['campaigns'][0]) && isset($adaccount['campaigns'][0]['daily_budget'])) {
                        $updateArr['campaigns_daily_budget'] = $adaccount['campaigns'][0]['daily_budget'];
                    }

                    if (isset($adaccount['insights']) && isset($insights)) {
                        $insights = $adaccount['insights'][0];

                        if (isset($insights['spend'])) {
                            $updateArr['insights_spend'] = $insights['spend'];
                        }

                        if (isset($insights['unique_clicks'])) {

                            $updateArr['unique_clicks'] = $insights['unique_clicks'];
                        }
                        if (isset($insights['cost_per_unique_click'])) {

                            $updateArr['cost_per_unique_click'] = $insights['cost_per_unique_click'];
                        }

                        if (isset($insights['unique_actions'])) {
                            $uniqueActions    = array_combine(array_column($insights['unique_actions'], 'action_type'), $insights['unique_actions']);
                            $uniquePerActions = array_combine(array_column($insights['cost_per_unique_action_type'], 'action_type'), $insights['cost_per_unique_action_type']);
                            if (isset($uniqueActions['omni_purchase'])) {
                                $updateArr['unique_omni_purchase']      = $uniqueActions['omni_purchase']['value'];
                                $updateArr['unique_cost_omni_purchase'] = $uniquePerActions['omni_purchase']['value'];
                            }
                        }
                    }
                    $response[$ckey] = $updateArr;
                }



                $response = array_map(function ($account) {
                    return json_decode($account, 1);
                }, array_column($response, 'content'));


                Cache::put($cacheKey, $response, 600);




            } else {
                $response = ['message' => 'bir hata var'];
            }
        }
    }

    return response()->json($response);

});

$router->get('/getAddAccounts/{bmId}', function (Request $request, $bmId) {

    $response = DB::connection('facebook')
        ->table('adaccounts')
        ->selectRaw("parent_business_id, business_id, account_id, account_name, business_name, ap.product_id")
        ->leftJoin('adaccount_product as ap', 'ap.ad_account_id', '=', 'adaccounts.account_id')
        ->where('adaccounts.parent_business_id', $bmId)
        ->groupBy(['parent_business_id', 'business_id', 'account_id'])
        ->get()
        ->toArray();
    return response()->json($response);

});
$router->post('/setChangeProductAds/{productId}', function (Request $request, $productId) {

    foreach ($request->get('selecteds') as $key => $adAccountId) {

        DB::connection('facebook')
            ->table('adaccount_product')
            ->updateOrInsert(['ad_account_id' => $adAccountId], ['ad_account_id' => $adAccountId, 'product_id' => $productId]);
    }
    return response()->json([]);

});

$router->get('/cronAdAccounts', function (Request $request) use ($router, $fb, $bmId) {

    $startDate = date("Y-m-d");
    $endDate   = date("Y-m-d");

    $fbData = getFacebookData($fb, $startDate, $endDate, $bmId);

    if ($fbData) {

        $response = array_merge([], $fbData);
        foreach ($response as $ckey => $adaccount) {

            $updateArr = [
                'account_id'                => $adaccount['account_id'],
                'account_name'              => $adaccount['name'],
                'parent_business_id'        => $bmId,
                'business_id'               => $adaccount['business']['id'],
                'business_name'             => $adaccount['business']['name'],
                'is_prepay_account'         => $adaccount['is_prepay_account'] ? 1 : 0,
                'insights_spend'            => 0,
                'unique_clicks'             => 0,
                'cost_per_unique_click'     => 0,
                'disable_reason'            => $adaccount['disable_reason'],
                'account_status'            => $adaccount['account_status'],
                'ads_effective_status'      => null,
                'ads_status'                => null,
                'campaigns_daily_budget'    => 0,
                'unique_omni_purchase'      => 0,
                'unique_cost_omni_purchase' => 0,
                'content'                   => json_encode($adaccount),
                'reportDate'                => date("Y-m-d"),
                'updateTime'                => (int) strtotime("now"),
            ];

            if (isset($adaccount['ads']) && isset($adaccount['ads'][0])) {
                $updateArr['ads_effective_status'] = $adaccount['ads'][0]['effective_status'];
                $updateArr['ads_status']           = $adaccount['ads'][0]['status'];
            }
            if (isset($adaccount['campaigns']) && isset($adaccount['campaigns'][0]) && isset($adaccount['campaigns'][0]['daily_budget'])) {
                $updateArr['campaigns_daily_budget'] = $adaccount['campaigns'][0]['daily_budget'];
            }

            if (isset($adaccount['insights']) && isset($insights)) {
                $insights = $adaccount['insights'][0];

                if (isset($insights['spend'])) {
                    $updateArr['insights_spend'] = $insights['spend'];
                }

                if (isset($insights['unique_clicks'])) {

                    $updateArr['unique_clicks'] = $insights['unique_clicks'];
                }
                if (isset($insights['cost_per_unique_click'])) {

                    $updateArr['cost_per_unique_click'] = $insights['cost_per_unique_click'];
                }

                if (isset($insights['unique_actions'])) {
                    $uniqueActions    = array_combine(array_column($insights['unique_actions'], 'action_type'), $insights['unique_actions']);
                    $uniquePerActions = array_combine(array_column($insights['cost_per_unique_action_type'], 'action_type'), $insights['cost_per_unique_action_type']);
                    if (isset($uniqueActions['omni_purchase'])) {
                        $updateArr['unique_omni_purchase']      = $uniqueActions['omni_purchase']['value'];
                        $updateArr['unique_cost_omni_purchase'] = $uniquePerActions['omni_purchase']['value'];
                    }

                }

            }

            DB::connection('facebook')->table('adaccounts')->updateOrInsert(
                [
                    'account_id' => $adaccount['account_id'],
                    'reportDate' => date("Y-m-d"),
                ], $updateArr);

        }

    } else {
        $response = ['message' => 'bir hata var'];
    }
    // return response()->json($response);
});

$router->get('/cronWhile', function (Request $request) use ($router) {

    $tokens = DB::connection('facebook')->table('bm_accounts')->where('auto_update', 1)->get()->toArray();
    //return response()->json($tokens);
    $ctx = stream_context_create(array('http' => array(
        'timeout' => 1200, //1200 Seconds is 20 Minutes
    ),
    ));
    foreach ($tokens as $key => $account) {

        file_get_contents('https://rketads.site/cronAdAccounts' . "?bmId=" . $account->bm_id, false, $ctx);
        // file_get_contents('http://roketads.test/cronAdAccounts' . "?bmId=".$account->bm_id, false, $ctx);
        sleep(2);
    }

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
    if (in_array($request->user()->role, ['root', 'manager', 'admin'])) {
        $response = DB::connection('facebook')->table('bm_accounts')->get()->toArray();
    } else {
        $response = DB::connection('facebook')->table('bm_accounts')->where('creator_id', $request->user()->id)->get()->toArray();
    }

    return response()->json($response);

});
$router->get('/getBmAcoount/{bmId}', function (Request $request, $bmId) use ($router) {
    $BmAccount                 = DB::connection('facebook')->table('bm_accounts')->where('bm_id', $bmId)->first();
    $BmAccount->hiddenAccounts = $BmAccount->hiddenAccounts ? json_decode($BmAccount->hiddenAccounts, 1) : [];
    return response()->json($BmAccount);

});

$router->post('/addBm', function (Request $request) use ($router) {
    $requestAll = $request->all();
    DB::connection('facebook')->table('bm_accounts')->updateOrInsert(['bm_id' => $request->bm_id, 'creator_id' => $request->creator_id ?: $request->user()->id], $requestAll);
    if (in_array($request->user()->role, ['root', 'manager', 'admin'])) {
        $response = DB::connection('facebook')->table('bm_accounts')->get()->toArray();
    } else {
        $response = DB::connection('facebook')->table('bm_accounts')->where('creator_id', $request->user()->id)->get()->toArray();
    }


    return response()->json($response);

});
$router->post('/addNote', function (Request $request) use ($router) {
    $requestAll               = $request->all();
    $requestAll['updateTime'] = \Carbon\Carbon::now();
    DB::connection('facebook')->table('notes')->insert($requestAll);
    return response()->json(DB::connection('facebook')->table('notes')->where('objectId', $request->get('objectId'))->get()->toArray());

});
$router->get('/hideAdAccount/{bmId}/{accountId}', function (Request $request, $bmId, $accountId) use ($router) {
    $requestAll               = $request->all();
    $requestAll['updateTime'] = \Carbon\Carbon::now();
    $BmAccount                = DB::connection('facebook')->table('bm_accounts')->where('bm_id', $bmId)->first();
    $hiddenAccounts           = is_array(json_decode($BmAccount->hiddenAccounts, 1)) ? json_decode($BmAccount->hiddenAccounts, 1) : [];
    $hiddenAccounts[]         = $accountId;
    DB::connection('facebook')->table('bm_accounts')->where('bm_id', $BmAccount->bm_id)->update(['hiddenAccounts' => json_encode(array_unique($hiddenAccounts))]);
    $BmAccount->hiddenAccounts = $hiddenAccounts;

    return response()->json($BmAccount);

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


$router->get('/addBmTest', function () use ($router) {




$postDataCreateAccountUrl = "https://graph.facebook.com/v7.0/2467766019936348/adaccount";
$postDataCreateAccount = [
    "name" => "CRMAdAccount",
    "currency" => "TRY",
    "timezone_id" => "1",
    "end_advertiser" => "146256339797968",
    "media_agency" => "146256339797968",
    "partner" => "146256339797968",
    "access_token" => "EAADWuzThkAcBAKuFWZA2p5RmjfnJHUVCbnsKtBq904zOjkg0BYrcTPiZCWI0FAdJ1CZCoCrJLtsLKi10cDiWEHi3mRWgatqnC7ZB8cKan12acqyjZBsOYqPwR6kPZB3atmDpE76cKVBZBM3LHNLFuhjj5jejqwmB5sMe4U0f20yToQ3TNiEDZCCP",

];

   $curlData =  getCurl($postDataCreateAccountUrl, [], $postDataCreateAccount);
    return response()->json($curlData);

});



$router->get('/addCampaignTest', function ()  use ($router, $fb) {


    try {
        // Returns a `Facebook\FacebookResponse` object
        $response = $fb->post('/act_241006230622084/campaigns',
        json_decode('{
            "name": "CRM TEST 29.05.20-1",
            "objective": "PAGE_LIKES",
            "status": "PAUSED",
            "special_ad_categories": ["NONE"],
            "spend_cap": 20000,
            "daily_budget": 1000,
            "bid_strategy": "LOWEST_COST_WITHOUT_CAP"
        }', true));
      } catch(Facebook\Exceptions\FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
      } catch(Facebook\Exceptions\FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
      }

      $graphNode = $response->getGraphNode();

    return response()->json($graphNode->asArray());

});

$router->get('/addAdSetTest', function ()  use ($router, $fb) {


    $postFields = json_decode('{
        "name": "CRM TEST 29.05.20-2 AdSet",
        "start_time": "2020-06-05T01:53:06-0700",
        "end_time": "2020-06-12T01:53:06-0700",
        "billing_event": "IMPRESSIONS",
        "campaign_spec": {
          "name": "CRM TEST 29.05.20-2",
          "objective": "PAGE_LIKES",
          "status": "PAUSED",
          "special_ad_categories": [],
          "buying_type": "AUCTION",
          "spend_cap": 20000,
          "daily_budget": 1000,
          "bid_strategy": "LOWEST_COST_WITHOUT_CAP"
        },
        "optimization_goal": "PAGE_LIKES",
        "promoted_object": {
          "page_id": "109456643901300"
        },
        "targeting": {
          "age_max": 65,
          "age_min": 27,
          "genders": [
            1
          ],
          "geo_locations": {
            "countries": [
              "TR"
            ],
            "location_types": [
              "home",
              "recent"
            ]
          },
          "brand_safety_content_filter_levels": [
            "FACEBOOK_STANDARD",
            "AN_STANDARD"
          ],
          "publisher_platforms": [
            "facebook",
            "audience_network",
            "messenger"
          ],
          "facebook_positions": [
            "feed",
            "video_feeds",
            "instant_article",
            "instream_video",
            "marketplace",
            "story",
            "search"
          ],
          "instagram_positions": [
            "stream",
            "story",
            "explore"
          ],
          "device_platforms": [
            "mobile"
          ],
          "messenger_positions": [
            "messenger_home",
            "story"
          ],
          "audience_network_positions": [
            "classic",
            "instream_video",
            "rewarded_video"
          ]
        },
        "status": "PAUSED"
      }', true);


    try {
        // Returns a `Facebook\FacebookResponse` object
        $response = $fb->post(
            '/act_241006230622084/adsets', $postFields

        );
      } catch(Facebook\Exceptions\FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
      } catch(Facebook\Exceptions\FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
      }
      $graphNode = $response->getGraphNode();

    return response()->json($graphNode->asArray());

});


$router->get('/addAdTest', function ()  use ($router, $fb) {


    return response()->json($graphNode->asArray());

});
$router->get('/addAdPixelTest', function ()  use ($router, $fb) {


    try {
        // Returns a `Facebook\FacebookResponse` object
        $response = $fb->post('/act_255908718825367/campaigns',
        json_decode('{
            "name": "CRM TEST 28.05.20-3",
            "objective": "PAGE_LIKES",
            "status": "PAUSED",
            "special_ad_categories": ["NONE"],
            "spend_cap": 20000,
            "daily_budget": 1000,
            "bid_strategy": "LOWEST_COST_WITHOUT_CAP"
        }', true));
      } catch(Facebook\Exceptions\FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
      } catch(Facebook\Exceptions\FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
      }

      $graphNode = $response->getGraphNode();

    return response()->json($graphNode->asArray());

});
$router->get('/addAdCreativeTest', function ()  use ($router, $fb) {


    try {
        // Returns a `Facebook\FacebookResponse` object
        $response = $fb->post('/act_255908718825367/campaigns',
        json_decode('{
            "name": "CRM TEST 28.05.20-3",
            "objective": "PAGE_LIKES",
            "status": "PAUSED",
            "special_ad_categories": ["NONE"],
            "spend_cap": 20000,
            "daily_budget": 1000,
            "bid_strategy": "LOWEST_COST_WITHOUT_CAP"
        }', true));
      } catch(Facebook\Exceptions\FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
      } catch(Facebook\Exceptions\FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
      }

      $graphNode = $response->getGraphNode();

    return response()->json($graphNode->asArray());

});


$router->get('/addAdImageTest', function (Request $request)  use ($router, $fb) {
//act_241006230622084/adimages
//http://roketads.test/addAdImageTest?bmId=146256339797968&imageUrl=https://i.ytimg.com/vi/gONtelFXlRY/maxresdefault.jpg
$filename = 'adUploadTest.jpg';
    try {
        // Returns a `Facebook\FacebookResponse` object
        $response = $fb->post('/act_241006230622084/adimages',
        array(
            "title" => "video crm 001 image test",
            "description" => "video crm 001 image test açıklama",
            "source" => $fb->fileToUpload($filename)
            //"bytes" => base64_encode(file_get_contents($request->get('imageUrl')))
        ));
      } catch(Facebook\Exceptions\FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
      } catch(Facebook\Exceptions\FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
      }

      $graphNode = $response->getGraphNode();

    return response()->json($graphNode->asArray());

});


$router->get('/addAdVideoUploadTest', function (Request $request)  use ($router, $fb) {
//act_241006230622084/advideos
//http://roketads.test/addAdVideoUploadTest?bmId=146256339797968
$filename = 'sample03.mp4';
    try {
        // Returns a `Facebook\FacebookResponse` object
        $response = $fb->post('/act_241006230622084/advideos',
        array(
            "title" => "video crm 001",
            "description" => "video crm 001 açıklama",
            "source" => $fb->videoToUpload($filename)
        ));
      } catch(Facebook\Exceptions\FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
      } catch(Facebook\Exceptions\FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
      }

      $graphNode = $response->getGraphNode();

    return response()->json($graphNode->asArray());

});





$router->get('/topluIslem', function (Request $request) use ($router, $fb, $bmId) {

    //$startDate = date("Y-m-d");
    $startDate = "2020-05-10";
    $endDate   = date("Y-m-d");

    //$fbData = getFacebookData($fb, $startDate, $endDate, $bmId);

    //if ($fbData) {
    if (1 == 1) {

        //$response = array_merge([], $fbData);
        foreach (DB::connection('facebook')->table('adaccounts')->get()->toArray() as $ckey => $adaccountArr) {
            $adaccount = json_decode($adaccountArr->content, 1);

            $updateArr = [
                'account_id'         => $adaccount['account_id'],
                'account_name'       => $adaccount['name'],
                'parent_business_id' => $bmId,
                'business_id'        => $adaccount['business']['id'],
                'business_name'      => $adaccount['business']['name'],
                'is_prepay_account'      => $adaccount['is_prepay_account'] ? 1 : 0,
                'insights_spend'      => 0,
                'unique_clicks'      => 0,
                'cost_per_unique_click'      => 0,
                'disable_reason'      => $adaccount['disable_reason'],
                'account_status'      => $adaccount['account_status'],
                'ads_effective_status'      => null,
                'ads_status'      => null,
                'campaigns_daily_budget'      => 0,
                'unique_omni_purchase'      => 0,
                'unique_cost_omni_purchase'      => 0,
                'content'            => json_encode($adaccount),
               // 'reportDate'         => date("Y-m-d"),
                'updateTime'         => (int) strtotime("now"),
            ];


            if (isset($adaccount['insights']) && isset($adaccount['insights'][0]) && isset($adaccount['insights'][0]['spend'])) {
                $updateArr['insights_spend'] = $adaccount['insights'][0]['spend'];
            }

            if (isset($adaccount['insights']) && isset($adaccount['insights'][0]) && isset($adaccount['insights'][0]['unique_clicks'])) {

                $updateArr['unique_clicks'] = $adaccount['insights'][0]['unique_clicks'];
            }
            if (isset($adaccount['insights']) && isset($adaccount['insights'][0]) && isset($adaccount['insights'][0]['cost_per_unique_click'])) {
 
                $updateArr['cost_per_unique_click'] = $adaccount['insights'][0]['cost_per_unique_click'];
            }

            if (isset($adaccount['ads']) && isset($adaccount['ads'][0])) {
                $updateArr['ads_effective_status'] = $adaccount['ads'][0]['effective_status'];
                $updateArr['ads_status'] = $adaccount['ads'][0]['status'];
            }
            if (isset($adaccount['campaigns']) && isset($adaccount['campaigns'][0]) && isset($adaccount['campaigns'][0]['daily_budget'])) {
                $updateArr['campaigns_daily_budget'] = $adaccount['campaigns'][0]['daily_budget'];
            }
    



            if (isset($adaccount['insights']) && isset($adaccount['insights'][0]) && isset($adaccount['insights'][0]['unique_actions'])) {
                $uniqueActions = array_combine(array_column($adaccount['insights'][0]['unique_actions'], 'action_type'),$adaccount['insights'][0]['unique_actions']);
                $uniquePerActions = array_combine(array_column($adaccount['insights'][0]['cost_per_unique_action_type'], 'action_type'),$adaccount['insights'][0]['cost_per_unique_action_type']);
                if(isset($uniqueActions['omni_purchase'])){
                    $updateArr['unique_omni_purchase'] = $uniqueActions['omni_purchase']['value'];
                    $updateArr['unique_cost_omni_purchase'] = $uniquePerActions['omni_purchase']['value'];
                }

                

            }

            /*  echo "<pre>";
                print_r($updateArr);
                print_r($adaccount);
                die();
*/


         DB::connection('facebook')->table('adaccounts')->where('id', $adaccountArr->id)->update($updateArr);
                

        }


    } else {
        $response = ['message' => 'bir hata var'];
    }
    // return response()->json($response);
});

