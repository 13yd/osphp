<?php //

$PLUSsslget = 'sslget';

function sslget( $url, $cacert_url){

         $curl = curl_init( $url );
         curl_setopt( $curl , CURLOPT_HEADER, 0 );
         curl_setopt( $curl , CURLOPT_RETURNTRANSFER, 1);
         curl_setopt( $curl , CURLOPT_SSL_VERIFYPEER, true);
         curl_setopt( $curl , CURLOPT_SSL_VERIFYHOST, 2);
         curl_setopt( $curl , CURLOPT_CAINFO, $cacert_url);
         $responseText = curl_exec( $curl );
         curl_close( $curl );
         return $responseText;
}