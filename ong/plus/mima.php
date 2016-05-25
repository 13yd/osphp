<?php //
$PLUSmima = 'mima';
function mima( $var = 'ONGSOFT' ){
        
		 if(! $var ) $var = time().'b891037e3d772605f56f8e9877d8593c';
         $varstr = strlen( $var );
		 if( $varstr < 1 ) $varstr = 32;
         $hash = md5(('#@ www. $^%&^*&(anyou. org#'.md5(base64_encode( $var.'13yd www . @#!$#@%#ong soft .com'.md5( $var).''. $var.'][{)(*&^%ong soft .org#@!~ 13yd').'@ongsof ~!~$^%&^*&(t'. $varstr). $varstr));

         return substr( $hash ,1 , $varstr * 3 );
}