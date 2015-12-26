<?php //
$PLUSqfopen = 'qfopen';
function qfopen($HTTP_Servr,$kai=1){
	$handle = fopen ($HTTP_Servr, "rb");
	$contents = ""; 
	do { 
	$data = fread($handle, 10240); 
	if (strlen($data) == 0) { 
	break; 
	} 
	$contents .= $data; 
} while(true); 
	fclose ($handle);
 if($kai==1) 
   $contents=iconv("gb2312","UTF-8//IGNORE", $contents);
 else 
	$contents=iconv($kai,"UTF-8//IGNORE", $contents);
return  $contents;
}

