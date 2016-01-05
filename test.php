<?php
/* ongsoft phpFrame  Application
 * ******************************************
 * home: www.ongsoft.com   mail: ai@13yd.com
 * Copyright  ongsoft
 * Trademark  ONG
 * ******************************************
 */


define('ONGHEAD','');  //强制输出头部
define('ONGPHP', dirname(__FILE__).'/ong/');
define("ONGTEMP", 'temp');   //缓存存放目录
define("ONGCON", '');        //系统配置
define("ONGDB", '');         //数据库配置
define('ONGNAME', 'test');  //调用model里面控制器
define('ONGQHTPL', '');      //强行后台模版
define('ONGQQTPL', '');      //强行前台模版
require ONGPHP.'ong.php';