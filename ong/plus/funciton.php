<?php //
$PLUSfunciton = 'funciton';

function msgbox ($mess='quite ok',$location='yes'){ 
          if($location=='yes') 
			 $locations = "window.history.back();";
		  else 
			 $locations = "window.location='".$location."';";

	      echo  '<script>alert("'.$mess.'");'. $locations.'</script>';
        die;
}

function listmit($page_size,$page){  
     $page=(int)($page)<=0?'1':$page;
     $page_size = (int)($page_size)<=0?'1':$page_size;
      return $pages = ($page-1)* $page_size.",".$page_size;
}

function qsubstr($str, $start=0, $length=1, $charset="utf-8", $suffix=false)
       {

if($length==0)return $str;

               if(function_exists("mb_substr"))
               {
                       if(mb_strlen($str, $charset) <= $length) return $str;
                       $slice = mb_substr($str, $start, $length, $charset);
               }
               else
               {
                       $re['utf-8']   = "/[/x01-/x7f]|[/xc2-/xdf][/x80-/xbf]|[/xe0-/xef][/x80-/xbf]{2}|[/xf0-/xff][/x80-/xbf]{3}/";
                       $re['gb2312'] = "/[/x01-/x7f]|[/xb0-/xf7][/xa0-/xfe]/";
                       $re['gbk']          = "/[/x01-/x7f]|[/x81-/xfe][/x40-/xfe]/";
                       $re['big5']          = "/[/x01-/x7f]|[/x81-/xfe]([/x40-/x7e]|/xa1-/xfe])/";
                       preg_match_all($re[$charset], $str, $match);
                       if(count($match[0]) <= $length) return $str;
                       $slice = join("",array_slice($match[0], $start, $length));
               }
               if($suffix) return $slice."";
               return $slice;
}


function ywselect($data,$zhi='',$biaoshi='',$kid=''){ 

              $x='';
			
			  foreach($data as $k=>$v){
                    if($biaoshi =='')$z= $v;
					else $z=$v[$biaoshi];
          
          

					if($kid !='')$k=$v[$kid];
			  if($zhi == $k && $zhi !='')
			     $x.='<option value="'.$k.'" selected="selected">'.$z.'</option>';
			  else 
				  $x.='<option value="'.$k.'">'.$z.'</option>';
              }
			  return $x;


}

function ycheckbox($nvam,$data,$zhi='',$biaoshi=''){  

                $kxz = (explode(',',$zhi));
				$kxz =array_flip($kxz);
				

              $x='';
			
			  foreach($data as $k=>$v){
                    if($biaoshi =='')$z= $v;
					else $z=$v[$biaoshi];
          
          

					
			  if(isset($kxz[$k]))
			     $x.='<input name="'.$nvam.'" type="checkbox" value="'.$k.'" checked="checked" /> '.$z;
			  else 
				  $x.='<input name="'.$nvam.'" type="checkbox" value="'.$k.'"  /> '.$z;
              }
			  return $x;


}

function createLinkstring($para) {
	$arg  = "";
	while (list ($key, $val) = each ($para)) {
		$arg.=$key."=".$val."&";
	}
	
	$arg = substr($arg,0,count($arg)-2);
	

	if(get_magic_quotes_gpc()){$arg = stripslashes($arg);}
	
	return $arg;
}

function alert($msg) {

	header('Content-type: text/html; charset=UTF-8');
	
	echo json_encode(array('error' => 1, 'message' => $msg));
	exit;
}


function update(){  //上传

         $php_path = dirname(__FILE__) . '/';
$php_url = dirname($_SERVER['PHP_SELF']) . '/';

//文件保存目录路径
$hgggg = $php_path . '../temp/';
$save_path = $php_path . '../temp/';
//文件保存目录URL
if (!file_exists($hgggg)) {
     mkdir($hgggg);
  
}
if (!file_exists($save_path)) {
		mkdir($save_path);
}


$save_url = './ong/temp/';



//定义允许上传的文件扩展名
$ext_arr = array(
	'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),
	'flash' => array('swf', 'flv'),
	'media' => array('swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),
	'file' => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2'),
);
//最大文件大小
$max_size = 1000000;

$save_path = realpath($save_path) . '/';

//PHP上传失败
if (!empty($_FILES['imgFile']['error'])) {
	switch($_FILES['imgFile']['error']){
		case '1':
			$error = '超过php.ini允许的大小。';
			break;
		case '2':
			$error = '超过表单允许的大小。';
			break;
		case '3':
			$error = '图片只有部分被上传。';
			break;
		case '4':
			$error = '请选择图片。';
			break;
		case '6':
			$error = '找不到临时目录。';
			break;
		case '7':
			$error = '写文件到硬盘出错。';
			break;
		case '8':
			$error = 'File upload stopped by extension。';
			break;
		case '999':
		default:
			$error = '未知错误。';
	}
	alert($error);
}
 
//有上传文件时
if (empty($_FILES) === false) {
	//原文件名
	$file_name = $_FILES['imgFile']['name'];
	//服务器上临时文件名
	$tmp_name = $_FILES['imgFile']['tmp_name'];
	//文件大小
	$file_size = $_FILES['imgFile']['size'];
	//检查文件名
	if (!$file_name) {
		alert("请选择文件。");
	}
	//检查目录
	if (@is_dir($save_path) === false) {
		alert("上传目录不存在。");
	}
	//检查目录写权限
	if (@is_writable($save_path) === false) {
		alert("上传目录没有写权限。");
	}
	//检查是否已上传
	if (@is_uploaded_file($tmp_name) === false) {
		alert("上传失败。");
	}
	//检查文件大小
	if ($file_size > $max_size) {
		alert("上传文件大小超过限制。");
	}
	//检查目录名
	$dir_name = empty($_GET['dir']) ? 'image' : trim($_GET['dir']);
	if (empty($ext_arr[$dir_name])) {
		alert("目录名不正确。");
	}
	//获得文件扩展名
	$temp_arr = explode(".", $file_name);
	$file_ext = array_pop($temp_arr);
	$file_ext = trim($file_ext);
	$file_ext = strtolower($file_ext);
	//检查扩展名
	if (in_array($file_ext, $ext_arr[$dir_name]) === false) {
		alert("上传文件扩展名是不允许的扩展名。\n只允许" . implode(",", $ext_arr[$dir_name]) . "格式。");
	}
	//创建文件夹
	if ($dir_name !== '') {
		$save_path .= $dir_name . "/";
		$save_url .= $dir_name . "/";
		if (!file_exists($save_path)) {
			mkdir($save_path);
		}
	}
	$ymd = date("Ymd");
	$save_path .= $ymd . "/";
	$save_url .= $ymd . "/";
	if (!file_exists($save_path)) {
		mkdir($save_path);
	}
	//新文件名
	$new_file_name = date("YmdHis") . '_' . rand(10000, 99999) . '.' . $file_ext;
	//移动文件
	$file_path = $save_path . $new_file_name;
	if (move_uploaded_file($tmp_name, $file_path) === false) {
		alert("上传文件失败。");
	}
	@chmod($file_path, 0644);
	$file_url = $save_url . $new_file_name;
     header('Content-type: text/html; charset=UTF-8');

	echo json_encode(array('error' => 0, 'url' => $file_url));
    exit;
	}
}


