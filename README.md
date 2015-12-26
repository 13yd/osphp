#OSphp
#'******************************************************************************************
#' OSphp开发框架
#' Version:0.1
#' Author: 13yd(ai@13yd.com)
#' Copyright (C) 2012-2015 OS软件 版权所有 www.ongsoft.com
#'******************************************************************************************
#支持多库读取
#   完善的数据库操作方式
#   常用组建封装
#   无模版引擎设置
#   直接使用原声php开发模版
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
#ong/plus/setsession.php    SESSION 声明函数
#ong/plus/shanchu.php       删除文件夹和目录函数
#ong/plus/sslpost.php       curl SSLPOST函数
#ong/plus/sslget.php        curl SSLGET函数
#ong/plus/txtcc.php         文本缓存KV系统
#ong/plus/x.php             专用写入数据函数
#ong/temp/                  默认缓存存放位置
#ong/moudl/                 存放调用模版文件
#/tpl/                      风格等文件存放文件夹
#/tpl/home/                 前台风格存放文件夹
#/tpl/admin/                后台风格存放文件夹


#每个文件都用说明
#自己新增核心类和函数可存放在function.php 里面  
#每个文件名即是类占用名字 funciton 注意不要重复