<?php
/* ongsoft phpFrame Application
 * ******************************************
 * home: www.ongsoft.com   mail: ai@13yd.com
 * Copyright  ongsoft
 * Trademark  ONG
 * ******************************************
 */
ob_start(); 
if( !defined( 'ONGHEAD') || ONGHEAD =='') header("Content-Type:text/html;charset=utf-8"); 
else header(ONGHEAD); 


if( !defined( 'ONGPHP')) exit( 'Error ONGSOFT'); 


function request_uri(){
if (isset($_SERVER['REQUEST_URI'])) $uri = $_SERVER['REQUEST_URI'];

else{
  if (isset($_SERVER['argv'])) $uri = $_SERVER['PHP_SELF'].( empty($_SERVER['argv'])?'':('?'. $_SERVER['argv'][0]));
  else $uri = $_SERVER['PHP_SELF'].(empty($_SERVER['QUERY_STRING'])?'':('?'. $_SERVER['QUERY_STRING']));
}
   $_SERVER['REQUEST_URI'] = $uri;
}

request_uri();



$URI = ltrim(strtolower( urldecode( trim($_SERVER["REQUEST_URI"]))),'/'); 


$ZHURU = array( '<', '>', '..', '\'', '(', ')' );




foreach( $ZHURU  as $anyou){

		  if( strpos( $URI , $anyou) !== false){

			  header( 'HTTP/1.1 404 Not Found');
              exit( '<script>alert("error");window.location.href="/";</script>"');
		  
		  }


}




if( defined( 'ONGCON') && ONGCON !='') $CONLJI =  ONGPHP.ONGCON.".php";

                                  else $CONLJI =  ONGPHP."conn.php";

                      $CONN = include  $CONLJI;


if( defined( 'ONGDB') && ONGDB !='')  $DBLJI =  ONGPHP.ONGDB.".php";
 
                                 else $DBLJI =  ONGPHP."config.php";

                     $DBCO = include  $DBLJI;

error_reporting(!E_ALL);
function zifuzhuan($data){

      if(!get_magic_quotes_gpc()) return addslashes(str_replace(array('0xbf27','0xbf5c27'),"'",$data));else return $data;
}

define('WEBFENG',$CONN['fenge']);

function plus( $plus){   
             
	         global $CONN;
		    
             if( is_array( $plus)){
 
                      $pluss = array_flip( array_flip( $plus));
                      $hcs =   md5(implode('@',$pluss));
					
                      global  ${'PLUS'. $hcs};

                      if( ${'PLUS'. $hcs})  return false;
					  
					
                      $lujin = ONGPHP.'plus/temp/'. $hcs.'.php';

                      
                      if($CONN['hchs']=='1'){  
                            
							if(file_exists($lujin)){
                                   
							          include $lujin; 
							   
							          return true;
							} 
						
						
						}


						$das = '';
			
					    foreach( $pluss as $anyou){

                          global  ${'PLUS'. $anyou};

					              
                               if( ! ${'PLUS'. $anyou}){
								   
								   include ONGPHP.'plus/'. $anyou.'.php';
                                   
                                   if( $CONN['hchs'] == '1')$das[] = file_get_contents(ONGPHP.'plus/'. $anyou.'.php');

							      }


					           
     
					     }
                   
        
                  if( $CONN['hchs'] == '1'){

					  if(! ${'PLUS'. $hcs}){

						   ${'PLUS'. $hcs} =12;

                             $sssx = '<?php '.'$PLUS'. $hcs.'=2;';

						     $sssx .= str_replace('<?php //' , '' , implode(' ',$das) );
                            
                              file_put_contents($lujin,$sssx);
							  
                          }
					   
				 }

  
                         

					  

               }else{

			      global ${'PLUS'.$plus};  
          
			      if( ! ${'PLUS'. $plus}) include ONGPHP.'plus/'.$plus.'.php';
               }
		  
         
	  

}




function wlx($mingzi,$shuchu=1){

		if( file_exists( ONGPHP.'Ong.php')){
		   if( $shuchu!=1)
				 return iconv( "UTF-8", "GBK//IGNORE", $mingzi);
			else
				 return iconv( "GBK", "UTF-8//IGNORE", $mingzi);
		}else return $mingzi;


}

if( defined( 'ONGQHTPL') && ONGQHTPL !='') $CONN['htpl'] =ONGQHTPL;

if( defined( 'ONGQQTPL') && ONGQQTPL !='') $CONN['qtpl'] =ONGQQTPL;

define( 'ONGLANG',$CONN['lang']);

define( 'ONGCMSNAME','OSphp');

define( 'ONGCMSHTTP', 'http://www.ongsoft.com');


define( 'ONGCMSVER', '0.5');


define( 'WZHOST', 'http://'.$_SERVER ['HTTP_HOST'].$CONN['dir']);


define( 'QTPL', ONGPHP.'../tpl/home/'.wlx($CONN['qtpl']).'/');


define( 'HTPL', ONGPHP.'../tpl/admin/'.wlx($CONN['htpl']).'/');


define( 'TPL', $CONN['dir'].'tpl/');


define( 'DQTPL', $CONN['dir'].'tpl/home/'.$CONN['qtpl'].'/');


define( 'DHTPL', $CONN['dir'].'tpl/admin/'.$CONN['htpl'].'/');


if( defined( 'ONGTEMP')) define('Txpath',ONGPHP.ONGTEMP.'/'); else define('Txpath',ONGPHP.'temp/');

if( defined( 'ONGNAME')) include ONGPHP.'moudl/'.ONGNAME.".php";