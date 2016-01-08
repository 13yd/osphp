<?php //
$PLUSmongodbcc = 'mongodbcc';
class mongodbcc{

       var $data = false ;
	   var $table = 'db.txtcc';
	   var $db = '';

public function __construct($servers,$table='db.txtcc'){
               
			   if(!$this->data){
			      
				$this->data = new MongoDB\Driver\Manager($servers);
				

			   }
            
			   $this->table = $table;
			  
      }

  public function fass($leix,$key='',$value='',$time=0){ 

	                 $ykey   = $key;
	                 $nerong = serialize($value);
                     $key    = md5($key);
					 $wode   =  strlen( $nerong);

					 if( $leix == 'add' || $leix == 'set'){
					  
					    $bulk = new MongoDB\Driver\BulkWrite;

                        $bulk->insert([ '_id' => $key , 'key' => $nerong ,'time' => time(), 'xianshi' => $time ]);

					    try {  
                             $this->data->executeBulkWrite($this->table, $bulk);
							 return true;

                        }catch (MongoDB\Driver\Exception\BulkWriteException $e){  

                              $bulk = new MongoDB\Driver\BulkWrite;

                              $bulk->update(  ['_id' => $key],
                                           ['$set' => ['key' => $nerong,'time' =>time(),'xianshi' => $time]]
                                          
                                    );
                              $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
                              $result = $this->data->executeBulkWrite($this->table, $bulk, $writeConcern);
                              return true;
                         }


						     
		          


					 }else if($leix == 'delete'){

                                  $bulk = new MongoDB\Driver\BulkWrite;
                                  $bulk->delete(['_id' => $key], ['limit' => 1]);
								  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
								  try {
 
                                       $result = $this->data -> executeBulkWrite($this->table, $bulk, $writeConcern);
									  

								  }catch (MongoDB\Driver\Exception\BulkWriteException $e){ 
								     
								  }

							     return true;
							
						
					 
					 
					  }else if( $leix == 'get'){

						 $filter = ['_id' =>  $key];
                         $options = [   'projection' => ['key'=>1,'time'=>1,'xianshi'=> 1],
                                         'limit' => 1,
	
                                   ];
                         $query = new MongoDB\Driver\Query($filter, $options);
                         $cursor = $this->data->executeQuery($this->table, $query);
						 $fanhui = $cursor->toArray();

						 if($fanhui){
							
                             
							 if( $fanhui['0']->xianshi  == 0)

							     return  unserialize($fanhui['0']->key);
							 
							 else if( $fanhui['0']->xianshi + $fanhui['0']->time >= time())
								 return  unserialize($fanhui['0']->key);
							 else{

							      $bulk = new MongoDB\Driver\BulkWrite;
                                  $bulk->delete(['_id' => $key], ['limit' => 1]);
								  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
								  try {
 
                                       $result = $this->data -> executeBulkWrite($this->table, $bulk, $writeConcern);

								  }catch (MongoDB\Driver\Exception\BulkWriteException $e){ 
								 
								  }

							     return false;
							 }


						    
						 
						 }else return false;
					
  
					
						 	
                    
						

						
						
					 
					 
					 }else if( $leix == 'flush_all'){
						 
						  
						 $filter = [];
                         $options = [   'projection' => ['key'=>1,'time'=>1,'xianshi'=> 1],
                                         'limit' => 1000,
	
                                   ];
                         $query = new MongoDB\Driver\Query($filter, $options);
                         $cursor = $this->data->executeQuery($this->table, $query);
						 $fanhui = $cursor->toArray();
                           
						 if( $fanhui){

							 $bulk = new MongoDB\Driver\BulkWrite;
                                 
								  

						 foreach($fanhui as $woqu){
						
							  $bulk->delete( ['_id'=> $woqu ->_id],['limit' => 1]);
						      
						  }

						  $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);

						  try {
 
                                   $result = $this->data -> executeBulkWrite($this->table, $bulk, $writeConcern);

							  }catch (MongoDB\Driver\Exception\BulkWriteException $e){ 
								 
							}


                            $this ->f();

						 }
						 
			

                          return true;
					 
					 
					 }else if( $leix == 'incr'){
                          
						 $bulk = new MongoDB\Driver\BulkWrite;


						 $filter = ['_id' =>  $key];
                         $options = [   'projection' => ['key'=>1,'time'=>1,'xianshi'=> 1],
                                         'limit' => 1,
	
                                   ];
                         $query = new MongoDB\Driver\Query($filter, $options);
                         $cursor = $this->data->executeQuery($this->table, $query);
						 $fanhui = $cursor->toArray();
						 if($fanhui){
						 
						      if( $fanhui['0']->xianshi  == 0)

							      $fanh =  (int)unserialize($fanhui['0'] -> key) + (int)$value;
							 
							 else if( $fanhui['0']->xianshi + $fanhui['0']->time >= time())

								  $fanh =  (int)unserialize($fanhui['0'] -> key) + (int)$value;

							 else $fanh = (int)$value;
						 
						 }else  $fanh = (int)$value;

						      $this -> fass('set',$ykey,$fanh,$time);

                           return $fanh;

                           

							
					 
					 
					 } else if( $leix == 'decr'){

						 $bulk = new MongoDB\Driver\BulkWrite;


						 $filter = ['_id' =>  $key];
                         $options = [  'projection' => ['key'=>1,'time'=>1,'xianshi'=> 1],
                                         'limit' => 1,
	
                                   ];
                         $query = new MongoDB\Driver\Query($filter, $options);
                         $cursor = $this->data->executeQuery($this->table, $query);
						 $fanhui = $cursor->toArray();
						 if($fanhui){
						 
						      if( $fanhui['0']->xianshi  == 0)

							      $fanh =  (int)unserialize($fanhui['0'] -> key) - (int)$value;
							 
							 else if( $fanhui['0']->xianshi + $fanhui['0']->time >= time())

								  $fanh =  (int)unserialize($fanhui['0'] -> key) - (int)$value;

							 else $fanh = (int)$value;
						 
						 }else    $fanh = (int)$value;

						          $this -> fass('set',$ykey,$fanh,$time);

	             

                           return $fanh;
						   
					 
					 }  
                       
					
						 

		   
		  
	}





	public function s($key,$value,$time=0){  

		       return  $this -> fass('set',$key,$value,$time);
		  
	}

	public function g($key){  

		         return  $this -> fass('get',$key);
		   
	}

	public function a( $key, $value, $time=0){

		       return  $this -> fass('set',$key,$value,$time=0);
		   
	}

	public function d( $key){  
		      

			   return  $this -> fass('delete',$key);
		   
	}
	public function f(){ 

		      return  $this -> fass('flush_all');
		   
	}   
	public function j( $key, $num=1,$time=0){ 
		    
			   return  $this -> fass('decr',$key, $num,$time);
		   
	}

	public function ja( $key, $num=1,$time=0){

		        return  $this -> fass('incr',$key, $num,$time);
		   
	}   

	public function fg($key,$time=''){
		   
		       return  $this -> fass('get',$key);
		  
	}

	public function fs($key,$value,$time=0){

		       return  $this -> fass('set',$key,$value,$time);
			
		  
	}


}
