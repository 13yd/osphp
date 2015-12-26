<?php //
$PLUScoucc = 'coucc';
class coucc{

function __construct($servers){
	                    //                 
                      	//new Coucc(array("127.0.0.1:8091", "","", "default"));  
           $this->md= new Couchbase($servers['0'],$servers['1'],$servers['2'],$servers['3']);
}

public function s($key,$value,$time=0){ 
 
       return $this -> md -> set($key, $value,$time);
}
public function g($key){  //
       return $this -> md -> get( $key);
}

public function f($kss=''){ 
	    if($kss !='')return false;
       return $this -> md -> flush();
}
public function j( $key, $num=1){ //
       return $this -> md -> decrement( $key, $num);
}

public function ja( $key, $num=1){ //
       return $this -> md -> increment( $key, $num);
}   
public function d( $key){  //
       return $this -> md -> delete($key); //
}


}
