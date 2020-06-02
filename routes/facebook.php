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
        $clientAdAccountFields  = "disable_reason,account_status,id,business,account_id,is_prepay_account,name,end_advertiser,end_advertiser_name,owner";

        //$clientAdAccountFields  = "ads_volume,permitted_tasks,disable_reason,account_status,id,account_id,is_prepay_account,name,end_advertiser,end_advertiser_name,owner";
        $clientAdAdsFields      = "ads.limit(1){effective_status,name,status}";
        $clientAdInsightsFields = "insights.level(campaign).time_range({'since':'$startDate','until':'$endDate'}).time_increment(all_days)"
            . "{spend,unique_clicks,cost_per_unique_click,unique_actions,cost_per_unique_action_type}";
            $response = $fb->get($bmId . "/client_ad_accounts?limit=100&fields=campaigns.limit(1){daily_budget},$clientAdInsightsFields,$clientAdAdsFields,$clientAdAccountFields");

        //$response = $fb->get("/me/adaccounts?limit=100&fields=campaigns{daily_budget},$clientAdInsightsFields,$clientAdAdsFields,$clientAdAccountFields");
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
    /*
print_r("/me/adaccounts?limit=100&fields=campaigns{daily_budget},$clientAdInsightsFields,$clientAdAdsFields,$clientAdAccountFields");
print_r($error);
die();*/
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
                    $adaccount['business'] = [
                        'id' => $adaccount['end_advertiser'],
                        'name' => $adaccount['end_advertiser_name'],
                    ];
                    $updateArr = [
                        'account_id'                => $adaccount['account_id'],
                        'account_name'              => $adaccount['name'],
                        'parent_business_id'        => $bmId,
                        'business_id'               => $adaccount['end_advertiser'],
                        'business_name'             => $adaccount['end_advertiser_name'],
                        //'business_id'               => $adaccount['business']['id'],
                        //'business_name'             => $adaccount['business']['name'],
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
        ->selectRaw("parent_business_id, business_id, account_id, account_name, business_name, ap.product_id, content")
        ->leftJoin('adaccount_product as ap', 'ap.ad_account_id', '=', 'adaccounts.account_id')
        ->where('adaccounts.parent_business_id', $bmId)
        ->groupBy(['parent_business_id', 'business_id', 'account_id'])
        ->get()
        ->toArray();
        $response = array_map(function($account){
            $account->content = json_decode($account->content, 1);
            return $account;
        }, $response);
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

            if (isset($adaccount['insights'])) {
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

    //$cronUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'];
    $tokens = DB::connection('facebook')->table('bm_accounts')->where('auto_update', 1)->get()->toArray();
    //return response()->json($tokens);
    $ctx = stream_context_create(array('http' => array(
        'timeout' => 1200, //1200 Seconds is 20 Minutes
    ),
    ));
    $cronUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'];
    foreach ($tokens as $key => $account) {

        file_get_contents($cronUrl . '/cronAdAccounts' . "?bmId=" . $account->bm_id, false, $ctx);
        sleep(2);
    }

});


$router->get('/topluIslem', function (Request $request) use ($router) {

    if (1 == 1) {
        foreach (DB::connection('facebook')->table('adaccounts')->get()->toArray() as $ckey => $adaccountArr) {
            $adaccount = json_decode($adaccountArr->content, 1);

            $updateArr = [
                'account_id'                => $adaccount['account_id'],
                'account_name'              => $adaccount['name'],
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
                //'reportDate'                => date("Y-m-d"),
                //'updateTime'                => (int) strtotime("now"),
            ];

            if (isset($adaccount['ads']) && isset($adaccount['ads'][0])) {
                $updateArr['ads_effective_status'] = $adaccount['ads'][0]['effective_status'];
                $updateArr['ads_status']           = $adaccount['ads'][0]['status'];
            }
            if (isset($adaccount['campaigns']) && isset($adaccount['campaigns'][0]) && isset($adaccount['campaigns'][0]['daily_budget'])) {
                $updateArr['campaigns_daily_budget'] = $adaccount['campaigns'][0]['daily_budget'];
            }

            if (isset($adaccount['insights'])) {
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


         DB::connection('facebook')->table('adaccounts')->where('id', $adaccountArr->id)->update($updateArr);
                

        }


    } else {
        $response = ['message' => 'bir hata var'];
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