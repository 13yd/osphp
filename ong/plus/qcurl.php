<?php //
$PLUSqcurl = 'qcurl';
function _rand() {       
    $length=26;       
    $chars = "0123456789abcdefghijklmnopqrstuvwxyz";       
    $max = strlen($chars) - 1;       
    mt_srand((double)microtime() * 1000000);       
    $string = '';       
    for($i = 0; $i < $length; $i++) {       
        $string .= $chars[mt_rand(0, $max)];       
    }       
    return $string;       
}  

function qcurl($HTTP_Servr,$kai=1){
$HTTP_SESSION=_rand();            
$HTTP_Server=$HTTP_Servr;         
$ch = curl_init();       
curl_setopt ($ch,CURLOPT_URL,$HTTP_Server);       
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);       
curl_setopt($ch,CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);       
curl_setopt($ch,CURLOPT_COOKIE,$HTTP_SESSION);       
$contents = curl_exec($ch);       
curl_close ($ch);
if($kai==1){
$contents=iconv("gb2312","UTF-8//IGNORE", $contents);
}else{
$contents=iconv($kai,"UTF-8//IGNORE", $contents);
}
return  $contents;
}


