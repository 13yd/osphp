<?php //
$PLUStcpcc = 'tcpcc';
class tcpcc{

    var $data = false ;

    function __construct($servers){
          
            if(!$this->data){

               if (! (  $this->data = socket_create( AF_INET,  SOCK_STREAM , SOL_TCP))){
            
                   return false;
           
                }else socket_connect($this->data, $servers['0'], $servers['1']);
           }
    }


     /* add  set  replace prepend append  cas  incr gets  decr  delete  touch   stats  flush_all  version  quit  shutdown  slabs
     reassign   automove  lru_crawler  crawl  tocrawl   sleep   enable  disable  verbosity*/
    public function fass( $leix , $key = '', $value = '', $time = 0){ 

                    $ykey = $key;
                    $nerong = serialize( $value);
                    $key = md5( $key);
                    $wode =  strlen( $nerong);

                    if( $leix == 'add' || $leix == 'set'){

                        $wodz = intval( $key, 10);

                        $wodz = $wodz % 30;
                          
                        $array = "set $key $wodz $time $wode\r\n";
                        $length = strlen($array);

                        $sent = socket_write( $this -> data , $array , $length);

                        $nerong .= "\r\n";

                        $nron = strlen( $nerong);

                        $accept = socket_write( $this -> data, $nerong , $nron);
            
                        $accept = socket_read( $this -> data , 80);
                        
                        if( trim( $accept) == 'STORED' && $nron < 1025) return true;
                        else return false;

                     }else if( $leix == 'delete'){

                        $array = "delete $key\r\n";
                        $length = strlen( $array);
                        $sent = socket_write( $this -> data ,$array ,$length);
                        $accept = socket_read($this -> data , 100);

                        if(trim( $accept) == 'END') return false;
                        else if(trim($accept) == 'NOT_FOUND') return false;
                        else if(trim($accept) == 'DELETED') return true;
                        else return false;

                     }else if( $leix == 'get'){

                        $array = "get $key\r\n";
                        $length = strlen( $array);
                        $sent = socket_write( $this -> data,$array,$length);

                        $accept = socket_read($this -> data, 9000);
                          
                        if( trim( $accept) == 'END')return false;
                        else if( trim( $accept) == 'NOT_FOUND')return false;
                        else{
                        
                            $fan =  explode( chr(13), str_replace( array( "\r\n" , "\n", "\r"),chr(13),$accept));
                            $zif = explode(' ', $fan['0']);
   
                            if( (float)( $zif['3'] ) == strlen( $fan['1'] )){
                                 return  unserialize( $fan['1']);
                            }else return false;

                        
                            
                        }

                    }else if( $leix == 'flush_all'){
                           
                        $array = "flush_all\r\n";
                        $length = strlen($array);
                        $sent = socket_write( $this -> data,$array,$length);
                        $accept = socket_read( $this -> data , 100);
                        if( trim( $accept) == 'END')return false;
                        else if( trim( $accept) == 'NOT_FOUND')return false;
                        else if( trim( $accept) == 'OK')return true;
                        else return false;

                    }else if( $leix == 'incr'){

                        $value = (float)$value;
                           
                        $array = "incr $key $value\r\n";
                        $length = strlen($array);
                        $sent = socket_write( $this->data , $array , $length);
                        $accept = socket_read( $this->data , 5000);
                        
                        if( trim( $accept) == 'END')return false;
                        else if( trim( $accept) == 'NOT_FOUND'){

                                $fanh = $this -> fass('set',$ykey,$value);
                                    
                                if($fanh)return $value;
                                return false;

                        }else return (float) $accept;

                    }else if( $leix == 'decr'){

                        $value = (float) $value;
                        $array = "decr $key $value\r\n";
                        $length = strlen( $array);
                        $sent = socket_write( $this -> data, $array ,$length);
                        $accept = socket_read( $this -> data, 5000);
                        if(trim($accept) == 'END')return false;
                        else if(trim($accept) == 'NOT_FOUND'){

                             $fanh = $this -> fass('set',$ykey,$value);
                             if($fanh)return 0;
                             return false;

                        }else return (float) $accept;
                    }  

    }


    public function s( $key , $value , $time = 0){  

           return  $this -> fass('set', $key , $value , $time );
    }


    public function g( $key ){  

           return  $this -> fass( 'get', $key);
    }


    public function a( $key , $value, $time = 0 ){

           return  $this -> fass( 'set' , $key , $value , $time );
    }


    public function d( $key ){  
           
           return  $this -> fass( 'delete', $key);
    }


    public function f(){ 

           return  $this -> fass( 'flush_all' );
    }
    

    public function j( $key, $num = 1, $time = 0){ 
            
            return  $this -> fass('decr', $key , $num);
    }


    public function ja( $key, $num = 1 ,$time = 0){

           return  $this -> fass( 'incr' , $key , $num );
    }


    public function fg( $key , $time = ''){
           
           return  $this -> fass( 'get' ,$key);
    }


    public function fs( $key , $value , $time = 0 ){

           return  $this -> fass( 'set' , $key , $value , $time );
    }


}
