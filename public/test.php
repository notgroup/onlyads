<?php
/*$date=date_create(date("d/m/Y"));
echo date_format($date,"d/m/Y");*/

function get_web_page_header( $url ) {
    $res = array();
    $options = array(
        CURLOPT_RETURNTRANSFER => true,     // return web page
        CURLOPT_HEADER         => false,    // do not return headers
        CURLOPT_FOLLOWLOCATION => true,     // follow redirects
        CURLOPT_USERAGENT      => "spider", // who am i
        CURLOPT_AUTOREFERER    => true,     // set referer on redirect
        CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
        CURLOPT_TIMEOUT        => 120,      // timeout on response
        CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
    );
    $ch      = curl_init( $url );
    curl_setopt_array( $ch, $options );
    $content = curl_exec( $ch );
    $err     = curl_errno( $ch );
    $errmsg  = curl_error( $ch );
    $header  = curl_getinfo( $ch );
    curl_close( $ch );

    //$res['content'] = $content;
    $res['url'] = $header['url'];
    $res['redirect_count'] = $header['redirect_count'];
    $res['errmsg'] = $errmsg;
    $res['err'] = $err;
    return $res;
}

function parseHeaders( $headers )
{
    $head = array();
    foreach( $headers as $k=>$v )
    {
        $t = explode( ':', $v, 2 );
        if( isset( $t[1] ) )
            $head[ trim($t[0]) ] = trim( $t[1] );
        else
        {
            $head[] = $v;
            if( preg_match( "#HTTP/[0-9\.]+\s+([0-9]+)#",$v, $out ) )
                $head['reponse_code'] = intval($out[1]);
        }
    }
    return $head;
}
/*file_get_contents('http://kargotakip.deposerileti.com:90/sorgu.asp?MUS_KOD=7700000423&MUS_sif=123DEF123&tip=3&har_kod=E839E4E4', false);
echo parseHeaders($http_response_header)['Location'];*/
/*$res = get_web_page_header('http://kargotakip.deposerileti.com:90/sorgu.asp?MUS_KOD=7700000423&MUS_sif=123DEF123&tip=3&har_kod=E839E4E4');
print_r($res);*/
/*
$exampleItem = array_fill_keys(array_values(["mok","urun","ad","adres","ilce","sehir","tel","irsaliyeno","ilkodu","ilcekodu","varis","serino","desi","tahsilat", "tutarı","ödeme", "tipi"]), 1);
print_r($exampleItem);*/

$test01 = strpos('shipped:deposer', ':');
$test02 = explode(':', 'shipped:deposer');
print_r($test02);