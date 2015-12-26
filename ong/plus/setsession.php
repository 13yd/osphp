<?php //
$PLUSsetsession ='setsession';
function setsession($time=300){
jianli(Txpath."sessoin/",2);
session_save_path(Txpath."sessoin/"); 
session_start();
setcookie('PHPSESSID',session_id(),time()+$time);

}
