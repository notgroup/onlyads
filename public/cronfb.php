<?php

function getCurl($url = '', $headers = [], $post = 0, $filepath = 'content.txt'){
      $curl = curl_init();
      curl_setopt($curl, CURLOPT_URL,$url);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
      if ($post) {
      curl_setopt($curl, CURLOPT_POST, $post);
      curl_setopt($curl, CURLOPT_POSTFIELDS,[]);
      }
    curl_setopt($curl, CURLOPT_USERAGENT, 'SeanPeterson');
      curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
      curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);





      $content = curl_exec ($curl);

      $err = curl_error($curl);

      curl_close($curl);

      if ($err) {
        echo "cURL Error #:" . $err;
    }



    echo "success";
    }
  //  getCurl('https://rketads.site/adAccounts');

  //file_put_contents(date('Y_m_d_H_i').'_test.json', json_encode(['test' => 'test']));
