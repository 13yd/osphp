#'******************************************************************************************
#' OSphp开发框架
#' Version:0.8
#' Author: 13yd(ai@13yd.com)
#' Copyright (C) 2012-2016 OS软件 版权所有 www.ongsoft.com
#'******************************************************************************************
#支持多库读取
#   完善的数据库操作方式
#   常用组建封装
#   无模版引擎设置
#   直接使用原声php开发模版
#  所有where 推荐使用 数组形式组合
#test.php                   测试文件
#ong/                       框架核心文件
#ong/config.php             数据库配置文件
#ong/conn.php               框架配置文件
#ong/ong.php                框架核心文件
#ong/plus/                  框架核心处理类函数  plus(array('funciton','p')); 声明需要的类
#ong/plus/temp/             存放配置类缓存  变更核心处理类函数 注意清空
#ong/plus/coucc.php         Couchbase缓存KV类
#ong/plus/db.php            数据库操作类
#ong/plus/funciton.php      用户自定义函数
#ong/plus/ip.php            获取ip地址函数
#ong/plus/isutf8.php        判断uft8函数
#ong/plus/jiami.php         DES加密解密类
#ong/plus/jianli.php        建立文件夹函数
#ong/plus/memcc.php         Memcache缓存KV类
#ong/plus/mima.php          变异md5加密函数可用变异密码
#ong/plus/p.php             P调试函数
#ong/plus/pagec.php         系统分页类
#ong/plus/pinyin.php        中文转拼音函数
#ong/plus/post.php          curl POST函数
#ong/plus/qcurl.php         curl GET函数
#ong/plus/qfopen.php        读取文本网址函数
#ong/plus/setsession.php    SESSION 声明函数 改进支持 负载均衡
#ong/plus/shanchu.php       删除文件夹和目录函数
#ong/plus/sslpost.php       curl SSLPOST函数
#ong/plus/sslget.php        curl SSLGET函数
#ong/plus/txtcc.php         文本缓存KV系统
#ong/plus/x.php             专用写入数据函数
#ong/plus/tcpcc           tcp 通信memcached              独立
#ong/plus/mongodbcc       mongodb key-value 缓存系统     独立
#ong/plus/mongodb         还未开发完成 设计是 模拟sql 语句替换mysql 
#ong/plus/vcode           验证码函数
#
#ong/temp/                  默认缓存存放位置
#ong/moudl/                 存放调用模版文件
#/tpl/                      风格等文件存放文件夹
#/tpl/home/                 前台风格存放文件夹
#/tpl/admin/                后台风格存放文件夹
#
#
#每个文件都用说明
#自己新增核心类和函数可存放在function.php 里面  
#每个文件名即是类占用名字 funciton 注意不要重复
##################################################数据库操作类######################################################
#数据库操作  配置文件 config.php  (读写分离支持  多库读取  1多库随机读取)   数据库名字ay_
#
#$D = db('center'); 
#      设置等于1 开启事务    只查询表的字段                                      读取条数          读取条数
#$D ->  setshiwu(1)      ->zhicha("id,aitme")->  order('id desc')->  where(array(''=>'查询条件'))->limit('0,1')  ->  find(); //读取条数一条数据
#													      select();//读取多条数据
#													      delete();//删除数据
#													      update(array());//修改数据
#													      insert(array()); //插入数据
#													       total();//获得总的条数
#$D->biao(); //获得 表完整名字
#
#$D  -> qurey("sql 语句" ,'返回结果参数');//返回结果参数 other 一纬数组  erwei 二纬数组   accse 成功或者失败  shiwu 执行事务;
#
#
#$wheres = $D  ->wherezuhe( array() );     //组合搜索条件where独立 处理
#$fanh = str_replace('WHERE','',$wheres);  //得到qurey where部分
#
#
#where 条件的组和详见 db.php  wherezuhe 
#
###############################################数据库操作类########################################################
#
#
#
###############################################缓存K V类###########################################################
#
#$Mem = new Coucc(array("127.0.0.1:8091", "","", "default"));  //Couchbase KV 缓存系统
#$Mem = new memcc( array("127.0.0.1:11211"));  //Memcache 内存KV
#$Mem = new mongodbcc("mongodb://localhost:27017" ,table 默认的数据库表 , fenjies = 1 key 分解数据库);   //mongodb 缓存系统
#$Mem = new tcpcc(array('127.0.0.1','11211'));  //tcpcc Memcache 连接缓存
#$Mem = new txtcc($data);  // $data 缓存的文件路径
#
#$Mem ->s($key,$val,$time);   //设置key val 值  time 过期时间 0 或者空 不过期
#$Mem ->g($key);  //获取 key的值 
#$Mem ->d($key);  //删除 key的值 
#$Mem ->ja($key,$val,$time); //key  加  val数字  time 过期时间
#$Mem ->j ($key,$val,$time); //key  减  val数字  time 过期时间
#$Mem ->f(删除目录或者清空缓存); //清空所有缓存

###############################################缓存K V类########################################################### 

#更新日志
#预计 v 0.9
# 整理所有代码 格式 规范写法
#
#v 0.8
#修正 db类 增加 事务功能
#增加 验证码类
#增加 setsession  支持自定义  可以扩展群集
#细节修复