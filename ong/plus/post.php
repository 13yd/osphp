<?php //
$PLUSpost = 'post';
function post($curlPost,$url,$urls='www.ongsoft.com'){
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, $url); 
curl_setopt($ch, CURLOPT_HEADER, false);  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_REFERER, $urls); 
curl_setopt($ch, CURLOPT_POST, 1); 
curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost); 
$data = curl_exec($ch);
curl_close($ch); 
return $data;
}



