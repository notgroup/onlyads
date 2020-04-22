<?php

$access_token = 'EAACJK9kkvmYBAEBEszq1SWoDCb9nGiZCPuC8fZAVP5ck6cl5uxtzyiWj3oI8dOACLaGcmDW5O4p1mXB0cvZA7s4QJltNib1bwxxIytZAAwgN8sQ7dAZAu9NREaUoCbB2iPoCQK8AauLRdTEZCBUwykE89rdSX6YgprjQTcgBxSVgZDZD';
$access_tokenBm01 = 'EAACJK9kkvmYBAEJUPq81yaFGWJfOD1mkiU5UVN4c6Y2kUPRvsOarBbguDktfGtUw9IZBYymlpbSdnkwFazbSkXKJdxPxThrmCEujMpZCwjmvvtgRP9wMZBZCLFjNXW2S6wZBcelxsAimlb4ZAHvrtux4YOMU5unubMjUkaYXJpNYwEO84QtBef';
$ad_account_id = 'act_866786040461786';
$app_secret = '61dc8d2dbe452894981432eb7ec02ac6';
$app_id = '150821419662950';
$fb = new \Facebook\Facebook([
  'app_id' => $app_id,
  'app_secret' => $app_secret,
  'default_graph_version' => 'v6.0',
  'default_access_token' => $access_token, // optional
]);


/*
https://developers.facebook.com/docs/facebook-login/access-tokens/refreshing

https://graph.facebook.com/v6.0/oauth/access_token?grant_type=fb_exchange_token&client_id=150821419662950&client_secret=61dc8d2dbe452894981432eb7ec02ac6&fb_exchange_token=EAACJK9kkvmYBAI57kqRyXjFcIuG2Jmom0QzYs1VMYlKWs64dT4Kt2vwOu5ZAWRV8cZBjMPbBmDOQBZBLwaV78Mjn4cGEZCAyj73fpVsJWJcurLmDkMBZBhULHLSetVqavoLKMmbk8Hx50sBTtlE0Jhpc9Y6KZBZAGc55qMUikC7uZABYy9YAc019cf6JgIjZCdC8ZD
*/


/*
date_area

156479078851727?time_increment=1&breakdowns=DAY&action_report_time=conversion&fields=client_ad_accounts.limit(100){amount_spent,balance,name,adspixels{name,id},insights.time_range({'since':'2020-04-17','until':'2020-04-17'}).date_preset(last_3d).time_increment(1){clicks,action_values,conversion_rate_ranking,conversion_values,conversions,cost_per_conversion,cost_per_inline_link_click,cost_per_inline_post_engagement,cost_per_outbound_click,cost_per_thruplay,cost_per_unique_click,cost_per_unique_inline_link_click,cpc,cpm,cpp,ctr,date_start,date_stop,frequency,spend,unique_clicks,unique_ctr,unique_actions,cost_per_unique_action_type,cost_per_action_type,cost_per_unique_outbound_click,outbound_clicks,outbound_clicks_ctr,unique_outbound_clicks,unique_outbound_clicks_ctr,unique_link_clicks_ctr,website_ctr,website_purchase_roas,account_currency,purchase_roas,account_id},campaigns.limit(10){id,name,objective,status,account_id,issues_info,effective_status,configured_status,updated_time,recommendations,spend_cap,buying_type},adcreatives.limit(100){id,account_id,object_story_spec,object_type,object_url,name,status,image_url,thumbnail_url,title,video_id,body,recommender_settings,destination_set_id,link_url,object_id,place_page_set_id},adsets{account_id,campaign_id,configured_status,destination_type,effective_status,id,name,recommendations,review_feedback,start_time,status,updated_time,issues_info},ads{id,creative,account_id,campaign_id,adset_id,ad_review_feedback,configured_status,effective_status,issues_info,name,recommendations,status,updated_time},disable_reason,account_status,created_time,id,currency,business,account_id,end_advertiser,end_advertiser_name,permitted_tasks}&summary=total_count&date_preset=today&level=campaign




level, summary

156479078851727?fields=client_ad_accounts.limit(100){amount_spent,balance,name,adspixels{name,id},insights.level(account).default_summary(0).summary(conversions,unique_ctr).time_range({'since':'2020-04-14','until':'2020-04-19'}).date_preset(last_14d).time_increment(1){clicks,conversion_rate_ranking,conversion_values,conversions,cost_per_conversion,cost_per_inline_link_click,cost_per_inline_post_engagement,cost_per_unique_click,cost_per_unique_inline_link_click,cpc,cpm,cpp,ctr,date_start,date_stop,frequency,spend,unique_clicks,unique_ctr,unique_link_clicks_ctr,account_currency,account_id},campaigns.limit(10){id,name,objective,status,account_id,issues_info,effective_status,configured_status,updated_time,recommendations,spend_cap,buying_type},adcreatives.limit(100){id,account_id,object_story_spec,object_type,object_url,name,status,image_url,thumbnail_url,title,video_id,body,recommender_settings,destination_set_id,link_url,object_id,place_page_set_id},adsets{account_id,campaign_id,configured_status,destination_type,effective_status,id,name,recommendations,review_feedback,start_time,status,updated_time,issues_info},ads{id,creative,account_id,campaign_id,adset_id,ad_review_feedback,configured_status,effective_status,issues_info,name,recommendations,status,updated_time},disable_reason,account_status,created_time,id,currency,business,account_id,end_advertiser,end_advertiser_name,permitted_tasks}


insights_prefix_variants=
insights.level(account).default_summary(0).summary(conversions,unique_ctr).time_range({'since':'2020-04-14','until':'2020-04-19'}).date_preset(last_14d).time_increment(1)
insights.level(account).default_summary(1).time_range({'since':'2020-04-14','until':'2020-04-19'}).date_preset(last_14d).time_increment(all_days)
insights.level(account).default_summary(0).time_range({'since':'2020-04-14','until':'2020-04-19'}).time_increment(all_days)



 */

/*
156479078851727?fields=client_ad_accounts.limit(100){amount_spent,balance,name,adspixels{name,id},insights.level(account).default_summary(0).time_range({'since':'2020-04-14','until':'2020-04-19'}).time_increment(all_days){account_id,date_start,date_stop,spend,unique_clicks,unique_ctr,unique_actions,cost_per_unique_action_type,account_currency},ads{id,creative,account_id,campaign_id,adset_id,configured_status,effective_status,name,recommendations,status,updated_time,issues_info,ad_review_feedback},disable_reason,account_status,created_time,id,currency,business,account_id,is_prepay_account,is_personal},owned_ad_accounts.limit(100){amount_spent,balance,name,adspixels{name,id},insights.level(account).default_summary(0).time_range({'since':'2020-04-14','until':'2020-04-19'}).time_increment(all_days){account_id,date_start,date_stop,spend,unique_clicks,unique_ctr,unique_actions,cost_per_unique_action_type,account_currency},ads{id,creative,account_id,campaign_id,adset_id,configured_status,effective_status,name,recommendations,status,updated_time,issues_info,ad_review_feedback},disable_reason,account_status,created_time,id,currency,business,account_id,is_prepay_account,is_personal}
*/
