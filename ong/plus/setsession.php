<?php //

$PLUSsetsession = 'setsession';
function setsession( $time = 300 ){

	     global $CONN;

         ini_set('session.use_trans_sid',0); 
         ini_set('session.hash_function', 'sha512');
         ini_set('session.hash_bits_per_character', 4);

		 if( isset( $CONN['session']) && $CONN['session'] == '2'){

			 ini_set('session.save_handler','user');
             ini_set('session.use_cookies', 1);
             ini_set('session.save_path','');
		     session_set_save_handler( 'sessionopen' , 'sessionclose' , 'sessionread' , 'sessionwrite' , 'sessiondestroy' , 'sessiongc' );

		 }else if( isset( $CONN['session']) && $CONN['session'] == '1'){

		     ini_set('session.save_handler','files');
		     jianli( Txpath . "session/");
             session_save_path( Txpath . "session/");
		 }
 
		     session_start();
             setcookie('PHPSESSID',session_id(),time()+$time);
}


function sessionopen($wo,$ko){

	     global $Memsession;
         if( $Memsession ) return true;
	     else return false;
}


function sessionclose(){

         return true;
}


function sessionread( $k){

	     global $Memsession;
         return stripcslashes( $Memsession -> g( 'session/'.$k)) ;
}


function sessionwrite( $k, $v){
             
	     global $Memsession,$CONN;
                $Memsession -> s( 'session/'.$k , $v , $CONN['sessiontime']);
         return true;
}


function sessiondestroy( $k){

	     global $Memsession;

         return $Memsession -> d ( 'session/'.$k);
}


function sessiongc($k){
        
	     global $Memsession;
         return $Memsession ->d( 'session/'.$k);
}