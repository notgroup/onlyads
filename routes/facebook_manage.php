<?php
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;






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


  /*
  https://developers.facebook.com/docs/marketing-api/guides/videoads
https://developers.facebook.com/docs/marketing-api/reference/ad-account/ads/#Creating

*/

$adPostJson = '{
  "name": "New Ad Crm10",
  "creative": {
    "name": "creative testcrm 10",
    "object_story_spec": {
      "link_data": {
        "image_hash": "782b43f59309bf711ae9413bf4a01751",
        "link": "https://www.facebook.com/facebook",
        "message": "try it out"
      },
      "page_id": "109456643901300"
    }
  },
  "status": "PAUSED",
  "adset_spec": {
    "name": "CRM TEST 29.05.20-10 AdSet",
    "start_time": "2020-06-05T01:53:06-0700",
    "end_time": "2020-06-12T01:53:06-0700",
    "billing_event": "IMPRESSIONS",
    "campaign_spec": {
      "name": "CRM TEST 29.05.20-10",
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
  }
}';


  try {
    // Returns a `Facebook\FacebookResponse` object
    $response = $fb->post(
    '/act_255908718825367/ads',
    array (
      'name' => 'My Ad',
      'adset_id' => '<AD_SET_ID>',
      'creative' => '{"creative_id":"<CREATIVE_ID>"}',
      'status' => 'PAUSED',
    )
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

$router->get('/addAdCreativeTest', function ()  use ($router, $fb) {

/*
{
  "name":"Sample Creative"',
          "object_story_spec": {
            "video_data": {
              "image_url":"https://scontent.fada1-7.fna.fbcdn.net/v/t45.1600-4/100764735_23844919242550475_7440626430494375936_n.jpg?_nc_cat=102&_nc_sid=2aac32&_nc_ohc=3Vg1DQE2PtkAX9Qplnu&_nc_ht=scontent.fada1-7.fna&oh=c4fbb060d0c7492f36d7344baf0b5cec&oe=5EF9CE62",
              "video_id":"715518595677784"
            } ,
            "page_id": "109456643901300"
          }
}


{
  "name": "creative testcrm video creative 0065",
  "object_story_spec": {
    "video_data": {
      "video_id": "715518595677784",
      "title": "Detaylar",
      "call_to_action": {
        "type": "LEARN_MORE",
        "value": {
          "link": "https://notgroup.s3.eu-west-3.amazonaws.com/meshur-kilis-bali-macunu/index.html?ref=gs03&pixel=2479036262408984",
          "link_format": "VIDEO_LPP"
        }
      },
      "image_hash": "e97e5ac009532b1aa5350fa5ae530f1a"
    },
    "page_id": "109456643901300"
  }
}


{
  "name": "72 creative testcrm video creative name",
  "object_story_spec": {
    "video_data": {
      "video_id": "715518595677784",
      "link_description": "72 link açıklaması",
      "title": "72 creative testcrm video creative title",
      "message": "72 video_data mesajı",
      "call_to_action": {
        "type": "LEARN_MORE",
        "value": {
          "link_caption": "www.liberyen.com",
          "link": "https://notgroup.s3.eu-west-3.amazonaws.com/meshur-kilis-bali-macunu/index.html?ref=gs03&pixel=2479036262408984",
          "link_format": "VIDEO_LPP"
        }
      },
      "image_hash": "e97e5ac009532b1aa5350fa5ae530f1a"
    },
    "page_id": "109456643901300"
  }
}

https://developers.facebook.com/docs/marketing-api/reference/ad-creative-link-data/
{
  "name": "0090 link creative name",
  "object_story_spec": {
    "link_data": {
      "call_to_action": {
        "type": "LEARN_MORE",
        "value": {
          "link": "https://notgroup.s3.eu-west-3.amazonaws.com/meshur-kilis-bali-macunu/index.html?ref=gs03&pixel=2479036262408984",
          "link_caption": "www.liberyen.com"
        }
      },
      "image_hash": "e97e5ac009532b1aa5350fa5ae530f1a",
      "message": "0090 link  mesajı",
      "name": "0090 link  name",
      "description": "0090 link  description mesajı",
      "caption": "www.liberyen.com",
      "link": "https://notgroup.s3.eu-west-3.amazonaws.com/meshur-kilis-bali-macunu/index.html?ref=gs03&pixel=2479036262408984"
    },
    "page_id": "109456643901300"
  }
}
{
  "name":"Sample Creative"',
"object_story_spec" : { 
    "link_data": { 
      "call_to_action": {"type":"SIGN_UP","value":{"link":"<URL>"}}, 
      "link": "<URL>", 
      "message": "try it out" 
    }, 
    "page_id": "<PAGE_ID>" 
  }
}
{
  "name":"Sample Creative"',
"object_story_spec" : { 
    "page_id": "<PAGE_ID>", 
    "photo_data": { 
      "branded_content_sponsor_page_id": "<SPONSOR_PAGE_ID>", 
      "image_hash": "<IMAGE_HASH>" 
    } 
  }
}

  { 
      "title": "My Test Creative", 
      "body": "My Test Ad Creative Body",
      "object_type":"PHOTO",
      "object_url":"https://www.facebook.com/facebook",
      "link_url": "https://www.facebook.com/facebook", 
      "image_hash": "782b43f59309bf711ae9413bf4a01751" 
   }




BURADA CREATİVE ÖRNEKLERİ: https://developers.facebook.com/docs/marketing-api/reference/ad-creative
BURADA CREATİVE OBJECT STORY ÖRNEKLERİ: https://developers.facebook.com/docs/marketing-api/reference/ad-creative-object-story-spec/
BURADA CREATİVE OLUŞTURMA ÖRNEKLERİ: https://developers.facebook.com/docs/marketing-api/reference/ad-creative#Creating



https://developers.facebook.com/docs/marketing-api/guides/videoads#create-ad-creative
https://developers.facebook.com/docs/marketing-api/guides/videoads    
https://developers.facebook.com/docs/marketing-api/reference/ad-creative#example
https://developers.facebook.com/docs/marketing-api/reference/ad-creative/
https://developers.facebook.com/docs/marketing-api/reference/ad-creative/previews/
https://developers.facebook.com/docs/marketing-api/reference/ad-creative-photo-data/
https://developers.facebook.com/docs/marketing-api/reference/ad-creative-text-data/
https://developers.facebook.com/docs/marketing-api/reference/ad-campaign/adcreatives/
https://developers.facebook.com/docs/marketing-api/reference/ad-creative-link-data/
https://developers.facebook.com/docs/marketing-api/creative/
https://developers.facebook.com/docs/marketing-api/reference/adgroup/adcreatives/
https://developers.facebook.com/docs/marketing-api/reference/ad-account/adcreatives/
https://developers.facebook.com/docs/marketing-api/reference/ad-account/adcreatives/#Creating
https://developers.facebook.com/docs/marketing-api/guides/videoads#create-ad-creative
https://developers.facebook.com/docs/marketing-api/reference/ad-account/ads/#example-2
https://developers.facebook.com/docs/marketing-api/reference/ad-creative
https://developers.facebook.com/docs/marketing-api/guides/videoads
https://developers.facebook.com/docs/marketing-api/advideo/v7.0
https://developers.facebook.com/docs/marketing-api/reference/ad-account/advideos#Creating

*/
    try {
        // Returns a `Facebook\FacebookResponse` object
        $response = $fb->post('/act_241006230622084/adcreatives',
        json_decode('{
          "name": "72 creative testcrm video creative name",
          "object_story_spec": {
            "video_data": {
              "video_id": "715518595677784",
              "link_description": "72 link açıklaması",
              "title": "72 creative testcrm video creative title",
              "message":"72 video_data mesajı",
              "call_to_action": {
                "type": "LEARN_MORE",
                "value": {
                  "link_caption": "www.liberyen.com",
                  "link": "https://notgroup.s3.eu-west-3.amazonaws.com/meshur-kilis-bali-macunu/index.html?ref=gs03&pixel=2479036262408984",
                  "link_format": "VIDEO_LPP"
                }
              },
              "image_hash": "e97e5ac009532b1aa5350fa5ae530f1a"
            },
            "page_id": "109456643901300"
          }
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



$router->get('/addAdPixelTest', function ()  use ($router, $fb) {


/*
https://developers.facebook.com/docs/marketing-api/reference/ad-account/adspixels/

*/


  try {
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

/*
https://developers.facebook.com/docs/marketing-api/reference/business#Creating


*/