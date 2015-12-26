<?php //
$PLUSshanchu = 'shanchu';
function shanchu($dir, $virtual = false){ 
	$ds = DIRECTORY_SEPARATOR;    
	$dir = $virtual ? realpath($dir) : $dir;    
	$dir = substr($dir, -1) == $ds ? substr($dir, 0, -1) : $dir;   
	if (is_dir($dir) && $handle = opendir($dir)) {        
		while ($file = readdir($handle))  {       
			if ($file == '.' || $file == '..') continue;
			elseif (is_dir($dir.$ds.$file))
				shanchu($dir.$ds.$file);
			else unlink($dir.$ds.$file);
               }        
	closedir($handle);       
	rmdir($dir);        
	return true; 
	} 
	return false;   
}
