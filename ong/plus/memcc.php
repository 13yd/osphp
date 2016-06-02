<?php //

$PLUSmemcc = 'memcc';

class memcc{

     function __construct( $servers ){

              $md = new Memcache;
              if( is_array( $servers[0] )){

                   foreach ( $servers as $server ) call_user_func_array(array( $md, 'addServer'), $server);

              } else call_user_func_array( array( $md, 'addServer'), $servers);

              $this->md = $md;
    }


    public function s( $key, $value, $time = 0){  

           return $this -> md -> set( md5( $key), $value, MEMCACHE_COMPRESSED, $time);
    }


    public function g( $key){  
           return $this -> md -> get( md5( $key));
    }


    public function d( $key){  
           return $this -> md -> delete( md5( $key)); 
    }


    public function f(){ 
           return $this -> md -> flush();
    }


    public function j( $key, $num=1,$time = 0){ 
           return $this -> md -> decrement( md5( $key), $num);
    }


    public function ja( $key, $num=1,$time = 0){
           return $this -> md -> increment( md5( $key), $num);
    }   


    public function gg( $key){  
           return $this -> md -> get( $key);
    }


}