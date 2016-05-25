<?php //
$PLUSsetsession = 'setsession';
function setsession( $time = 300 ){

	     global $CONN;

         $_POST['Expirestime'] = $time; 

		 if( isset( $CONN['session']) && $CONN['session'] == '2'){

			 ini_set('session.save_handler','user');
             ini_set('session.use_cookies', 1);
             ini_set('session.save_path','');
		     session_set_save_handler('sessionopen', 'sessionclose', 'sessionread', 'sessionwrite', 'sessiondestroy', 'sessiongc');

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
         return $Memsession -> g('session/'.$k);
}

function sessionwrite( $k, $v){

	     global $Memsession;
                $Memsession -> s( 'session/'.$k , $v , $_POST['Expirestime']);
         return true;
}

function sessiondestroy( $k){

	     global $Memsession;
         return $Memsession ->d( 'session/'.$k);
}

function sessiongc($k){

	     global $Memsession;
         return $Memsession ->d( 'session/'.$k);
}