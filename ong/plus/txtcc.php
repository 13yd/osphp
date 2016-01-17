<?php //
$PLUStxtcc = 'txtcc';
class txtcc{


    var $DB=null; 

function __construct($data=''){  
	             if($data=='') $this->DB = Txpath;
				 else $this->DB = $data;

                    
}

public function fg($key,$time=''){
      $pat = $this->DB.str_replace('../','',$key).'.php';
     
	   if(file_exists($pat)){


              if($time=='')return qfopen($pat,'utf-8');
               clearstatcache();
			   $guoqitime = filemtime($pat)+$time;
			   $dangqtime = time();
			   
          if($dangqtime > $guoqitime){
			      unlink($pat);
				return false;
		  }else   return qfopen($pat,'utf-8');


		   
	   }
		 
	   
	
    
 
}

public function fs($key,$value='',$time=''){

				 $pat = $this->DB.str_replace('../','',$key).'.php';
				 jianli( $pat);
				 file_put_contents($pat, $value);
				 return true;
 

}


public function ja($key,$num=1){ 
          $pat = $this->DB.str_replace('../','',$key).'.php';
	      jianli( $pat);
          $value = include $pat;
          $value = (int)($value*1+$num);
          x($pat,$value);
          return $value;
    
}


public function j($key,$num=1){ 
          $pat = $this->DB.str_replace('../','',$key).'.php';
	      jianli( $pat);
          $value = include $pat;
          $value = (int)($value*1-$num);
          x($pat,$value);
          return $value;
      
}

public function g($key){ 
       $pat = $this->DB.str_replace('../','',$key).'.php';
	   
  
       if(file_exists($pat)){

       $kkk = include $pat;


	   if($kkk!=''){
		   
		   if(isset($time)){
			   
		       clearstatcache();
			   $guoqitime = filemtime($pat)+$time; 
			   $dangqtime = time();
			   
                if($dangqtime > $guoqitime){
			     unlink($pat);
				return false;
				}else return  $kkk;
		   
		    }else
		   return $kkk;

	   }
		  else return true;
       
	   
	   }else return false;

}
public function d($key){ 

       $pat = $this->DB.str_replace('../','',$key).'.php';
       if(file_exists($pat)){
         unlink($pat);
         return true;
        }else return false;
}

public function f($key =''){
	           if($key == '')  $key = $this->DB;
      
             return shanchu($key);
 }


public function q($key){
       $zzz = $this->DB;
       $mydir = dir($zzz);
       while($file = $mydir -> read()){ 
		if(($file!=".") and ($file!="..") and  strstr($file,"$key") ){
                $files=$zzz.$file;
		 unlink($files);

		} 
	} 
       $mydir->close();
       return true;
 }





public function s($key, $value, $time=''){ 
       $pat = $this->DB.str_replace('../','',$key).'.php';
	   jianli( $pat);
	   if(!$value)$value='0';
	   if($value!=''){
            if(!is_array($value))$value="'". zifuzhuan($value)."'";
         }

       x($pat,$value,$time);
       return $value;
}




}