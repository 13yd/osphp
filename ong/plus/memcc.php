<?php //
$PLUSmemcc = 'memcc';
class memcc{

function __construct($servers){
            $md = new Memcache;
  if( is_array( $servers[0] )){
               foreach ( $servers as $server ) call_user_func_array(array($md, 'addServer'), $server);
	} else call_user_func_array(array($md, 'addServer'), $servers);
    $this->md=$md;
}

public function s($key,$value,$time=0){  
       return $this -> md -> set( $key, $value, MEMCACHE_COMPRESSED, $time);
}
public function g($key){  
       return $this -> md -> get( $key);
}
public function a( $key, $value, $time=0){
       return $this -> md -> add( $key, $value, MEMCACHE_COMPRESSED, $time);
}
public function d( $key){  
       return $this -> md -> delete($key); 
}
public function f(){ 
       return $this -> md -> flush();
}
public function j( $key, $num=1){ 
       return $this -> md -> decrement( $key, $num);
}

public function ja( $key, $num=1){
       return $this -> md -> increment( $key, $num);
}   

public function fg($key,$time=''){
	 return $this -> md -> get( $key);  
	  
}

public function fs($key,$value,$time=0){
	    
       return $this -> md -> set( $key, $value, MEMCACHE_COMPRESSED,$time);
}


}

