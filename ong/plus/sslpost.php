<?php //

$PLUSsslpost = 'sslpost';

function sslpost( $url,  $para, $cacert_url = '', $input_charset = ''){

         if (  trim( $input_charset ) != '') $url = $url . "_input_charset=" . $input_charset;
         $curl = curl_init( $url );
         curl_setopt( $curl , CURLOPT_SSL_VERIFYPEER, true);
         curl_setopt( $curl , CURLOPT_SSL_VERIFYHOST, 2);

         if( $cacert_url != '')
         curl_setopt( $curl , CURLOPT_CAINFO , $cacert_url);
         curl_setopt( $curl , CURLOPT_HEADER, 0 ); 
         curl_setopt( $curl , CURLOPT_RETURNTRANSFER, 1);
         curl_setopt( $curl , CURLOPT_POST, true); 
         curl_setopt( $curl , CURLOPT_POSTFIELDS, $para);
         $responseText = curl_exec( $curl );
         curl_close( $curl );
         return $responseText;

}