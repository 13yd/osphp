<?php //

$PLUSpost = 'post';

function post( $curlPost , $url , $urls = 'www.ongsoft.org'){

         $ch = curl_init(); 
         curl_setopt( $ch , CURLOPT_URL, $url);

         if( strstr( $url , 'https' )){
             curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0);
             curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0);
         }

         curl_setopt( $ch, CURLOPT_HEADER, false);
         curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
         curl_setopt( $ch, CURLOPT_REFERER, $urls);
         curl_setopt( $ch, CURLOPT_POST, 1);
         curl_setopt( $ch, CURLOPT_POSTFIELDS, $curlPost);
         $data = curl_exec( $ch);
         curl_close( $ch ); 
         return $data;
}