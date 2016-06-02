<?php if( !defined( 'ONGPHP')) exit( 'Error ONGSOFT');
/*
关联性 插件
plus 插件列表
db              数据库    jianli  mima shanchu x   qfopen txtcc  db 组合  ( $CONN['qudong'] 驱动的选择  $DB  数据库组合 $CONN['duob']  多库读取 专用写入库) 首先 必须设置缓存类
txtcc           文本缓存  jianli  shanchu x   qfopen                组合
ip              ip                             独立
isutf8          判断 utf-8                     独立
jianli          建立目录                       独立
memcc           内存缓存                       独立
mima            md5变异算法                    独立
p               调试输出用                     独立
pinyin          转换为拼音                     独立
post            发送post数据 curl              独立
qcurl           curl抓取                       独立
qfopen          文件抓取                       独立
shanchu         删除目录                       独立
sslget          ssl get 方法curl               独立
sslpost         ssl post 方法curl              独立
x               写入文件                       独立
funciton        函数控制库 自定义函数          独立
tcpcc           tcp 通信memcached              独立
mongodbcc       mongodb key-value 缓存系统     独立
mongodb         还未开发完成 设计是 模拟sql 语句替换mysql 
*/

plus(array('p','jiami','jianli','mima','shanchu','qcurl','qfopen','x','memcc','txtcc','db','isutf8','setsession','pagec','pinyin','ip','post','funciton','tcpcc','mongodbcc'));

$Mem  =  new txtcc;

p($Mem);