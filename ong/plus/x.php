<?php //
$PLUSx ='x';
function x($filename, $arr='',$time=''){  

		 if(is_array($arr))                     
				 $con = var_export($arr,true);  
		 else $con = $arr;                       

         if($con!=''){  
			if($time!='') $con = "<?php \$time= '$time'; return $con;";  
			else          $con = "<?php return $con;";                  
         }     
	     file_put_contents($filename, $con); 
		 return true;
}
