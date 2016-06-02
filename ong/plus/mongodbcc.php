<?php //

$PLUSmongodbcc = 'mongodbcc';

class mongodbcc{

       var $data = false ;
       var $table = 'db.txtcc';
       var $db = '';
       var $fenjies = 1;

/* $servers 连接信息 table 默认的数据库表 , fenjies = 1 key 分解数据库 */
    public function __construct($servers,$table='db.txtcc',$fenjies = 1){
           
           if( ini_get( 'mongodb.debug' ) === false ) return false;
           if( ! $this -> data) $this -> data = new MongoDB\Driver\Manager( $servers);
           $this -> fenjies = $fenjies;
           if($table) $this -> table = $table;
           else       $this -> table = 'db.txtcc';
    }

    public function fenjie($table,$ykey){

           if( $this -> fenjies == 1 && strpos( $ykey , '/') !== false ){

               $hash = explode('/',$ykey);
               $this -> table =  'O'. implode( '.' , $hash). 'S';
                         
           }

           return  $this->table;
    }


    public function fass( $leix, $key = '', $value = '', $time = 0){ 

                    $ykey   = $key;
                    $nerong = serialize( $value);
                    $key    = md5( $key);
                    $wode   =  strlen( $nerong);

                    if( $leix == 'add' || $leix == 'set'){
                      
                        $bulk = new MongoDB\Driver\BulkWrite;

                        $bulk -> insert ( array( '_id' => $key , 'key' => $nerong ,'time' => time(), 'xianshi' => $time ));

                        try {  

                             $this -> data -> executeBulkWrite( $this-> fenjie ( $this -> table, $ykey), $bulk);

                             return true;

                        }catch ( MongoDB\Driver\Exception\BulkWriteException  $e){  

                             $bulk = new MongoDB\Driver\BulkWrite;

                             $bulk->update(  array( '_id' => $key ),
                                             array('$set' => array( 'key' => $nerong,'time' =>time(),'xianshi' => $time ))
                                          
                             );

                             $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
                             $result = $this-> data -> executeBulkWrite ( $this -> fenjie( $this -> table, $ykey), $bulk, $writeConcern);
                             return true;
                         }

                    }else if( $leix == 'delete'){

                             $bulk = new MongoDB\Driver\BulkWrite;
                             $bulk-> delete(array( '_id' => $key), array( 'limit' => 1));
                             $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
                             try {

                                   $result = $this-> data -> executeBulkWrite( $this-> fenjie( $this -> table, $ykey), $bulk, $writeConcern);

                              }catch ( MongoDB\Driver\Exception\BulkWriteException $e){ 
                                 
                              }

                             return true;

                    }else if($leix == 'get'){

                             $filter  = array ( '_id' =>  $key );
                             $options = array ( 'projection' => array ('key'=>1,'time'=>1,'xianshi'=> 1),
                                                'limit' => 1,
                                        );
                             $query = new MongoDB\Driver\Query( $filter, $options);
                             $cursor = $this -> data -> executeQuery ( $this-> fenjie( $this->table, $ykey), $query);
                             $fanhui = $cursor -> toArray();

                             if( $fanhui ){
                                
                                 if( $fanhui['0'] -> xianshi  == 0)

                                      return  unserialize( $fanhui['0'] -> key);
                                 else if( $fanhui['0'] -> xianshi + $fanhui['0']-> time >= time())
                                      return  unserialize( $fanhui['0'] -> key);
                                 else{

                                      $bulk = new MongoDB\Driver\BulkWrite;
                                      $bulk -> delete( array( '_id' => $key ), array( 'limit' => 1) );
                                      $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
                                      try {
     
                                           $result = $this-> data -> executeBulkWrite( $this->fenjie ( $this->table , $ykey), $bulk, $writeConcern);

                                      }catch ( MongoDB\Driver\Exception\BulkWriteException $e){ 
                                     
                                      }

                                      return false;
                                 }
                             
                             }else return false;
                     
                    }else if($leix == 'flush_all'){
                         
                             $filter = array();
                             $options = array( 'projection' => array( 'key'=>1,'time'=>1,'xianshi'=> 1 ),
                                             'limit' => 1000,
                                        );
                             $query = new MongoDB\Driver\Query( $filter, $options);
                             $cursor = $this -> data -> executeQuery( $this -> fenjie( $this->table, $ykey), $query);
                             $fanhui = $cursor -> toArray();
                               
                             if( $fanhui ){

                                 $bulk = new MongoDB\Driver\BulkWrite;

                                 foreach( $fanhui as $woqu)  $bulk->delete( array( '_id'=> $woqu -> _id ), array( 'limit' => 1 ));
                                 
                                 $writeConcern = new MongoDB\Driver\WriteConcern( MongoDB\Driver\WriteConcern::MAJORITY, 1000);

                                 try {
     
                                       $result = $this -> data -> executeBulkWrite( $this -> fenjie ( $this->table, $ykey), $bulk, $writeConcern);

                                 }catch (MongoDB\Driver\Exception\BulkWriteException $e){ 
                                     
                                 }

                                 $this ->f();
                             }
                              return true;

                    }else if($leix == 'incr'){
                          
                             $bulk = new MongoDB\Driver\BulkWrite;


                             $filter = array( '_id' =>  $key );
                             $options = array( 'projection' => array( 'key'=>1,'time'=>1,'xianshi'=> 1 ),
                                             'limit' => 1,
                                       );

                             $query = new MongoDB\Driver\Query( $filter, $options);
                             $cursor = $this -> data -> executeQuery( $this -> fenjie( $this->table, $ykey), $query);
                             $fanhui = $cursor -> toArray();
                             if($fanhui){

                                if( $fanhui['0'] -> xianshi  == 0)

                                    $fanh = (float) unserialize( $fanhui['0'] -> key) + (float)$value;
                                 
                                else if( $fanhui['0'] ->xianshi + $fanhui['0'] -> time >= time())

                                     $fanh =  (float) unserialize( $fanhui['0'] -> key) + (float) $value;

                                else $fanh = (float) $value;
                             
                             }else   $fanh = (float) $value;

                                $this -> fass('set',$ykey,$fanh,$time);

                                return $fanh;

                    }else if($leix == 'decr'){

                             $bulk = new MongoDB\Driver\BulkWrite;


                             $filter = array( '_id' =>  $key );
                             $options = array( 'projection' => array( 'key'=>1,'time'=>1,'xianshi'=> 1 ),
                                             'limit' => 1,
                                       );
                             $query = new MongoDB\Driver\Query( $filter, $options);
                             $cursor = $this -> data -> executeQuery( $this -> fenjie( $this -> table, $ykey), $query);
                             $fanhui = $cursor -> toArray();
                             if($fanhui){
                             
                                  if( $fanhui['0'] -> xianshi  == 0)

                                      $fanh =  (float)unserialize($fanhui['0'] -> key) - (float)$value;
                                 
                                 else if( $fanhui['0'] -> xianshi + $fanhui['0'] -> time >= time())

                                      $fanh =  (float) unserialize( $fanhui['0'] -> key) - (float)$value;

                                 else $fanh = (float)$value;
                             
                             }else    $fanh = (float)$value;

                                      $this -> fass('set', $ykey, $fanh, $time);

                               return $fanh;
                     }  
    }


    public function s( $key, $value, $time=0){  

           return  $this -> fass( 'set', $key, $value, $time);
    }


    public function g($key){  

           return  $this -> fass( 'get', $key);
    }


    public function a( $key, $value, $time=0){

           return  $this -> fass('set', $key, $value, $time=0);
    }


    public function d( $key){  

           return  $this -> fass( 'delete', $key);
    }


    public function f(){ 

           return  $this -> fass( 'flush_all');
    }   


    public function j( $key, $num=1,$time=0){ 
            
           return  $this -> fass( 'decr', $key , $num , $time);
    }

    public function ja( $key, $num=1,$time=0){

           return  $this -> fass( 'incr', $key , $num , $time);
    }   


    public function fg($key,$time=''){
           
            return  $this -> fass( 'get', $key);
    }


    public function fs($key,$value,$time=0){

           return  $this -> fass( 'set', $key , $value , $time);
    }


}