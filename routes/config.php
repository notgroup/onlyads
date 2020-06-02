<?php

/*
$bmId = isset($_GET['bmId']) ? $_GET['bmId'] : 0;
$fb = fbApiInit();
*/
$bm_id_A9 = '3191402807537654';

$bmId = isset($_GET['bmId']) ? $_GET['bmId'] : 0;
$fb = null;

if ($bmId) {
$tokens = DB::connection('facebook')->table('bm_accounts')->get()->keyBy('bm_id');


$access_token = $tokens[$bmId]->access_token;
$app_secret = $tokens[$bmId]->app_secret;
$app_id = $tokens[$bmId]->app_id;
$fb = new \Facebook\Facebook([
  'app_id' => $app_id,
  'app_secret' => $app_secret,
  'default_graph_version' => 'v7.0',
  'default_access_token' => $access_token,
  //'persistent_data_handler' => 'session',
  //'cookie' => TRUE, // optional
]);
}


/*
print_r(get_class_methods($fb));
die();*/