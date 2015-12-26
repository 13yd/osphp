<?php //
$PLUSjiami ='jiami';
class jiami{   

private $crypt_key;


public function __construct($crypt_key) {
   $this -> crypt_key = $crypt_key;
}

public function en($txt) {
   srand((double)microtime() * 9999999);
   $encrypt_key = mima('ong'.mima(rand(0,320000000).time()).'soft');

   $ctr = 0;
   $tmp = '';
   for($i = 0;$i<strlen($txt);$i++) {
    $ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr;
    $tmp .= $encrypt_key[$ctr].($txt[$i]^$encrypt_key[$ctr++]);
   }
   return str_replace("+",".",str_replace("=",",",base64_encode(self::__key($tmp,$this -> crypt_key))));
}

public function dn($txt) {
   $txt = self::__key(base64_decode(str_replace(".","+",str_replace(",","=",$txt))),$this -> crypt_key);
  
   $tmp = '';
   for($i = 0;$i < strlen($txt); $i++) {
    $md5 = $txt[$i];
    $tmp .= $txt[++$i] ^ $md5;
   }
   return $tmp;
}

private function __key($txt,$encrypt_key) {
   $encrypt_key = mima($encrypt_key);
   $ctr = 0;
   $tmp = '';
   for($i = 0; $i < strlen($txt); $i++) {
    $ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr;
    $tmp .= $txt[$i] ^ $encrypt_key[$ctr++];
   }

  
   return $tmp;
}

public function __destruct() {
   $this -> crypt_key = null;
}
}
