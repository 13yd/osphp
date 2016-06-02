<?php //

$PLUSdb = 'db';

if( ! isset( $CONN['duob'])) $CONN['duob'] = 0;

if( ! isset( $CONN['qxx']))  $CONN['qxx'] = 0;

function db($table=null){
  
         global $CONN,$DBCO;
         $qudong = "D".$CONN['qudong'];
         $AYDBs = new $qudong( $DBCO);
         return $AYDBs ->  shezhi( $table); 
}

class AYDB{

        var $DB=null; 
        var $mysql=null; 
        var $where=null; 
        var $paixu =null;
        var $lismt =null;
        var $sql=null; 
        var $table=null; 
        var $tablejg=null; 
        var $update= null;
        var $charu=null;
        var $bqdoq = null;
        var $SHIWU = 0;
        var $dqqz = null;
    

public function __construct($data=''){

                $this->DB = $data;       
                return $this;
                
}

function limit($data=''){  
    
         if($data!='')
         $this->lismt=' LIMIT '.$this->zifuzhuan($data);
         return $this;

}

function wherezuhe($data=''){  
         $x='';
         if(is_array($data)){
               $zhsss = count($data);
               if($zhsss < 1)return;
               foreach($data as $k=>$v){
                    
                     $k=$this->zifuzhuan($k);
                     if(!is_array($v))
                     $v=$this->zifuzhuan($v);
                      if(strstr($k,'>=')){
                      $k= trim(str_replace('>=','',$k));
                      $x.=" and `$k` >= '$v'";
                     }else if(strstr($k,'>')){
                      $k= trim(str_replace('>','',$k));
                      $x.=" and `$k` > '$v'";
                     }else if(strstr($k,'<=')){
                      $k= trim(str_replace('<=','',$k));
                      $x.=" and `$k` <= '$v'";
                     }else if(strstr($k,'<')){
                      $k= trim(str_replace('<','',$k));
                      $x.=" and `$k` < '$v'";
                     }else if(strstr($k,'!=')){
                      $k= trim(str_replace('!=','',$k));
                      $x.=" and `$k` != '$v'";
                     }else if(strstr($k,'OLK')){
                      $k= trim(str_replace('OLK','',$k));
                      $x.=" OR `$k` LIKE '$v'";
                     }else if(strstr($k,'LIKE')){
                      $k= trim(str_replace('LIKE','',$k));
                      $x.=" and `$k` LIKE '$v'";
                     }else if(strstr($k,'OR')){
                      $k= trim(str_replace('OR','',$k));
                      $x.=" OR `$k` = '$v'";
                     }else if(strstr($k,'IN')){
                      $k= trim(str_replace('IN','',$k));
                       if(is_array($v))
                          $x.=" and `$k` IN(". implode(',',$v).")";
                       else
                          $x.=" and `$k` IN($v)";
                      }else if(strstr($k,'DAYD')){
                        $k= trim(str_replace('DAYD','',$k));
                        $x.=" and $k >= $v";
                      }else if(strstr($k,'DAY')){
                        $k= trim(str_replace('DAY','',$k));
                        $x.=" and $k > $v";
                      }else if(strstr($k,'XIYD')){
                        $k= trim(str_replace('XIYD','',$k));
                        $x.=" and $k <= $v";
                      }else if(strstr($k,'XIY')){
                        $k= trim(str_replace('XIY','',$k));
                        $x.=" and $k < $v";
                      }else if(strstr($k,'DEY')){
                        $k= trim(str_replace('DEY','',$k));
                        $x.=" and $k = $v";
                      }else
                      $x.=" and `$k`='$v'";
                }
                 $x=(ltrim(trim($x),'OR'));

           }else $x.=$data;
          
        return 'WHERE '.(ltrim(trim($x),'and'));

 }

public function zuheset($data=''){ 

                if(!is_array($data))return $data;
                   $chaxun = $this->tablejg[1];
                   $x=array();
                    foreach($chaxun as $k=>$v){

                        if(isset($data[$k])&& $v !='auto_increment')
                           $x[]="`$k` = '{$this->zifuzhuan($data[$k])}'";  
                        else if(isset($data[$k.' +']))
                           $x[]="`$k` = $k + '{$this->zifuzhuan($data[$k.' +'])}'"; 
                        else if(isset($data[$k.' -']))
                           $x[]="`$k` = $k - '{$this->zifuzhuan($data[$k.' -'])}'"; 
                    }

                return implode(',',$x);
}

public function charuset($data=''){ 

                  if( !is_array( $data))return null;

                  $chaxun = $this->tablejg[1];
                  $xv = array();

                  foreach($chaxun as $k=>$v){

                     if(isset($data[$k])&& $data[$k] !='' &&$v !='auto_increment')
                          $xv[]="'{$this->zifuzhuan($data[$k])}'";
                     else{
                          if($v =='auto_increment');
                          else $xv[] = "'".str_replace($k.'_','',$v)."'";
                     }
                   }

                  $ndd=array();

                  foreach($this->tablejg[1] as $ttm=>$vvv){

                          if($vvv !='auto_increment')$ndd[]=$ttm;
                  }
        
                  return '('.implode(',',$ndd).')VALUES ('.implode(',',$xv).')';
  
}


function pqsql($DATA){

          if(!is_array( $DATA))return null;
          $qian = "INSERT INTO   `{$this->table}` ({$this->tablejg[0]})VALUES";
          $sql=$qian;
          $i=1;
          foreach($DATA as $anyou){

                if( $i% 30 == 0){
                       $sql=rtrim($sql,',');
                       $sql.=';'.$qian.$anyou.',';
                 }else $sql.=$anyou.',';
                      $i++;
         }

       $sql = rtrim( $sql , ',' );
      
       $this-> qurey( $sql , 'other');
       return true;  
        
}
function psql($data=''){
       
        if(!is_array($data))return null;

        $chaxun = $this->tablejg[1];
        $xv =array();

        foreach($chaxun as $k=>$v){

            if(isset($data[$k])&& $data[$k] !='' &&$v !='auto_increment'){

                $xv[]="'{$this->zifuzhuan($data[$k])}'";

             }else{

                if($v =='auto_increment')$xv[] ='NULL';
                else $xv[] = "'".str_replace($k.'_','',$v)."'";

             }
        }

        return '('.implode(',',$xv).')';
  
}

function order($data=''){

         if($data !='') $this->paixu = ' ORDER BY '.$data;
         return $this;
}

function where($data=''){

         if($data !='') $this->where = $this->wherezuhe($data);
         return $this;
}

function find($data=''){

         if($data !=''){
              if(is_array($data))
                 $this->where = $this->wherezuhe($data); 
              else{
                 $chaxun = $this->tablejg[1];
               
                 foreach($chaxun as $k =>$v){

                     if($v == 'auto_increment'){

                      $dataf[$k.' IN']=$data;break;

                     }
                 } 
               
                $this->where = $this->wherezuhe($dataf); 
             }
            
         }

        return  $this->zhixing('find');
}

function setshiwu($wo = 0){

           $this->SHIWU = $wo;
           return $this;


}

function zhicha($datasl){

          if($datasl!='')$this->tablejg['0'] =$datasl;
          return $this;
}

function total($data=''){
          if($data !='')
          $this->where = $this->wherezuhe($data);
          return  $this->zhixing('zongshu');
}

function select($data=''){ 
          if($data !='')
          $this->where = $this->wherezuhe($data);
          return  $this->zhixing('select');
}
function qurey($data='',$moth='other'){ 
         $this->sql=$data;
         return  $this->zhixing($moth);
} 
function query($data='',$moth='other'){ 
         $this->sql=$data;
         return  $this->zhixing($moth);
}
function update($data=''){
       
         if($data=='')return false;
         $this->update = $this->zuheset($data);
         return  $this->zhixing('xiugai');
}

function delete($data=''){

         if($data !=''){
              if(is_array($data))
                 $this->where = $this->wherezuhe($data); 
              else{
                $chaxun = $this->tablejg[1];
                foreach($chaxun as $k =>$v){
                   if($v=='auto_increment'){
                      $dataf[$k.' IN']=$data;break;
                    }
                }
              $this->where = $this->wherezuhe($dataf); 
             }
         }

         return  $this->zhixing('shanchu');
}
function biao(){
        return $this->table;
}
function insert($data=''){
         $this->charu =$this->charuset($data);
         return  $this->zhixing('charu');
}


function setbiao( $data = '' ){

         global $CONN,$Mem;  

         $suiji =  $this -> dqqz;
         
         $qianzui = $this->DB[$suiji]['qian'];

         if($data != ''){ 

            $this->table = $this->zifuzhuan( $qianzui.$data );
         
            $HASH = 'db/'.mima($this->DB[$suiji]['name'].$this->table);
            $huanc = $Mem -> g( $HASH );
            if( $huanc && $CONN['qxx'] == 1) $this -> tablejg = $huanc;
            else{

                $qq = $this -> zhixing('scjg');
                $gege['0'] = $chaxun = implode(',',array_flip( $qq ));
                $gege['1'] = $qq; 
                $this->tablejg = $gege;            
                $Mem->s( $HASH , $gege );              
            }
         }
    
        return $this;
}


function shezhi($data=''){

         global $CONN;  
         if($CONN['modb'] == '')
                  $this->bqdoq = 'write';
         else $this->bqdoq = $CONN['modb']; 

         if($CONN['duob']=='1')
         $suiji =array_rand($this->DB, 1);     
         else $suiji = $this->bqdoq;
         

         $this->dqqz = $suiji;
   
         $this->lianjie($this->DB[$suiji]);   
       
         if($data!=''){
         $qianzui = $this->DB[$suiji]['qian']; 
        
         $this->table = $qianzui.$data;
         
         $HASH = 'db/'.mima($this->DB[$suiji]['name'].$this->table);           
         global $Mem;
         $huanc = $Mem->g($HASH);              
         if($huanc && $CONN['qxx'] == 1) 
            $this->tablejg =$huanc;             
           else{

              $qq= $this->zhixing('scjg');        
              $gege['0'] = $chaxun = implode(',',array_flip($qq));
              $gege['1'] = $qq; 
              $this->tablejg =$gege;            
              $Mem->s($HASH,$gege);              
            }
        }
    
       return $this;
}

public function zifuzhuan($data){

      if(!get_magic_quotes_gpc()) return addslashes(str_replace(array('0xbf27','0xbf5c27'),"'",$data));else return $data;
}



}

class Dmspdo extends  AYDB{ 

public function lianjie($data){ 
    
                    try {  
             
                      $pdo = new PDO("odbc:Driver={SQL Server};Server={$data['host']},{$data['port']};Database={$data['name']};",$data['user'],$data['pass']);
    
                    }catch (PDOException $e) {
                     return('db_error:' .$data['h'].$e);
                    } 
                
                  $this->mysql = $pdo; 
                
                  return $pdo;
}


public  function zhixing($moth='',$sql=''){ 
                 
                  $DATA = array();
                  global $CONN;  
              
                  if($moth=='scjg'){  
        
                          $sql = "sp_columns '{$this->table}'";
                          $qq = $this->mysql->prepare($sql);
                          $qq ->execute();
                
                          while($row=$qq->fetch(PDO::FETCH_ASSOC)){
                  
                             $DATA["{$row['COLUMN_NAME']}"]=$row['TYPE_NAME']!='int identity'?$row['COLUMN_NAME'].'_'.($row['COLUMN_DEF']==''?$row['NULLABLE']:$row['COLUMN_DEF']):'auto_increment';
                           }
                           
                           return  $DATA;

                  }else if($moth=='find'){  
                      
                            $chaxun = $this->tablejg[0]; 

                            $sql = "SELECT TOP 1 $chaxun FROM  {$this->table} {$this->where} {$this->paixu} "; 
                            $sql = str_replace('`' , '' , $sql);
                            $this->where = $this->paixu = null;
                            $qq = $this->mysql->prepare($sql);
                            $qq ->execute();
                            $row=$qq->fetch(PDO::FETCH_ASSOC);
                            if(!$row)return false;
                            else return $row; 
                            
                  }else if($moth=='select'){ 
                      
                           $chaxun = $this->tablejg[0]; 
                
                           if($this->lismt){


                              if( strpos( $this->lismt , ',') !== false){
                     
                                       $this->lismt  = str_replace(array('LIMIT ','LIMIT') , '' ,$this->lismt );

                                       $feny = explode(',',$this->lismt);
                            
                                       if(!$this->paixu){

                                            $xx = explode(',',$chaxun);
                                            $this->paixu =  "ORDER BY ".$xx['0']." asc";
                                        }

                                      if($this->where){
                              
                                           $sql ="SELECT $chaxun  from (  select ROW_NUMBER() over ({$this->paixu}) rownum,  $chaxun  from [{$this->table}] ) as yourselect {$this->where} and rownum between {$feny['0']} and {$feny['1']}  {$this->paixu} ";
                                      }else  
                                           $sql ="SELECT $chaxun  from (  select ROW_NUMBER() over ({$this->paixu}) rownum,  $chaxun  from [{$this->table}] ) as yourselect where rownum between {$feny['0']} and {$feny['1']}  {$this->paixu} ";

                              }else{
                                $this->lismt  = str_replace(array('LIMIT ','LIMIT') , '' ,$this->lismt );
                                $sql = "SELECT TOP {$this->lismt} $chaxun FROM  {$this->table} {$this->where} {$this->paixu} "; 

                              }
                        } else $sql = "SELECT $chaxun FROM  {$this->table} {$this->where} {$this->paixu} {$this->lismt}";

                          $sql = str_replace('`' , '' , $sql);
                          $this->where = $this->paixu = $this->lismt = null;
                          $qq = $this->mysql->prepare($sql);
                          $qq ->execute();
                          $row = $qq->fetchAll(PDO::FETCH_ASSOC);
                          if(!$row)return false; 
                          else return $row; 
                          
              }else if($moth=='charu'){ 

                        $sql = "INSERT INTO   `{$this->table}` {$this->charu} ";
                        $sql = str_replace(array('`',"'(",")'") , array('','(',')') , $sql);
                        $this->charu = null;
                        if( $this->SHIWU == 1)return $sql.';@;';

                        if( $CONN['duob'] == '1' && $this->bqdoq !=  $this->dqqz) 
                        $this->lianjie($this->DB[$this->bqdoq]); 

                        $qq = $this->mysql->prepare($sql);
                        $mm = $qq ->execute();
                        return $mm;
                 
              }else if($moth=='shanchu'){
              
                        $sql = "DELETE FROM  `{$this->table}` {$this->where}  ";
                        $sql = str_replace('`' , '' , $sql);

                        $this->where = $this->lismt = null;

                        if( $this->SHIWU == 1)return $sql.';@;';

                        if( $CONN['duob'] == '1' && $this->bqdoq !=  $this->dqqz)
                        $this->lianjie($this->DB[$this->bqdoq]); 

                        $qq = $this->mysql->prepare($sql);
                        $qq ->execute();
                        if($qq ->rowCount())return true; 
                        else return false;
                
         
               }else if($moth=='xiugai'){ 
                 
                        $sql = "UPDATE   `{$this->table}` SET {$this->update}  {$this->where}  {$this->lismt}";
                        $sql = str_replace('`' , '' , $sql);

                        $this->where = $this->update = $this->lismt = null;

                        if( $this->SHIWU == 1)return $sql.';@;';

                        if( $CONN['duob'] == '1' && $this->bqdoq !=  $this->dqqz) 
                        $this->lianjie($this->DB[$this->bqdoq]); 
                        
                        $qq = $this->mysql->prepare($sql);
                        $qq ->execute();
                        if($qq ->rowCount())return true; 
                        else return false;
                  

                }else if($moth=='zongshu'){

                        $chaxun = $this->tablejg[0]; 

                        $sql = "SELECT count(*) as count FROM  `{$this->table}` {$this->where} ";//sql

                        $sql = str_replace('`' , '' , $sql);

                        $this->where = $this->paixu = $this->lismt = null;
                        $qq = $this->mysql->prepare($sql);
                        $qq ->execute();
                        $row=$qq->fetch(PDO::FETCH_ASSOC);

                        return $row['count'];
         
                }else if($moth=='other'){ 

                        if( $CONN['duob'] == '1' && $this->bqdoq !=  $this->dqqz) 
                        $this->lianjie($this->DB[$this->bqdoq]);
                        
                        $qq = $this->mysql->prepare($this->sql);
                        $qq ->execute();

                        $row=$qq->fetch(PDO::FETCH_ASSOC);
                        if(!$row)return false; 
                        else return $row;
                  
                }else if($moth=='erwei'){

                        if( $CONN['duob'] == '1' && $this->bqdoq !=  $this->dqqz) 
                        $this->lianjie($this->DB[$this->bqdoq]);  

                        $qq = $this->mysql->prepare($this->sql);
                        $qq ->execute();
                        $row=$qq->fetchAll(PDO::FETCH_ASSOC);
                        if(!$row)return false; 
                        else return $row; 
                  
                }else if($moth=='accse'){
             
                        if( $CONN['duob'] == '1' && $this->bqdoq !=  $this->dqqz) 
                        $this->lianjie($this->DB[$this->bqdoq]);  

                        $qq = $this->mysql->prepare($this->sql);
                        $row= $qq ->execute();

                        if(!$row)return false; 
                        else return true;

               }else if($moth=='shiwu'){
                       
                        if( $CONN['duob'] == '1' && $this->bqdoq !=  $this->dqqz) 
                        $this->lianjie($this->DB[$this->bqdoq]); 
                        
                        

                        try{
                             $this-> mysql -> beginTransaction();

                              $zhiss =  explode(';@;',$this->sql);

                              foreach($zhiss as $tsss){

                                      if( $tsss == '')continue ;
                                      $woud = $this-> mysql ->exec($tsss.';');
                                      if(!$woud){
                                          $wodw = new txtcc;
                                          $wodw ->s('sqlerror/'.time().'_'.rand(1,9999999),$tsss.' @@@@@ '.$this->sql);
                                          $this-> mysql -> rollback(); 
                                          $this->sql = NULL;

                                          return false;
                                       }
                              }

                           return  $this->mysql->commit();

                        }catch( PDOExecption $e ) { 

                             $wodw = new txtcc;
                             $wodw ->s('sqlerror/'.time().'_'.rand(1,9999999), $this->sql);
                             $this-> mysql -> rollback(); 
                             return false;

                        }

               }
    }






}
class Dpdo extends  AYDB{ 


public function lianjie($data){ 
    
                 try {
            
           
                      $pdo = new PDO("mysql:host={$data['host']};port={$data['port']};dbname={$data['name']}", $data['user'], $data['pass'], array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES {$data['char']}") );
             
                  } catch (PDOException $e) {
                      return ('db_error:' .$data['h']);
                  }
                    
                 $this->mysql = $pdo; 
                
                 return $pdo;
}

public  function zhixing($moth='',$sql=''){ 

                 global $CONN;
                 
                $DATA = array();
              
        if($moth=='scjg'){
            
                 $sql = "desc `{$this->table}`";
                 $qq = $this->mysql->prepare($sql);
                 $qq ->execute();
                 while($row=$qq->fetch(PDO::FETCH_ASSOC)){
                     
                     $DATA["{$row['Field']}"]=$row['Extra']==''?$row['Field'].'_'.$row['Default']:$row['Extra'];
                  }
                  return  $DATA;

        }else if($moth=='find'){ 

                 $chaxun = $this->tablejg[0]; 
                 $sql = "SELECT $chaxun FROM  `{$this->table}` {$this->where} {$this->paixu} LIMIT 0 , 1"; 
              
                 $this->where = $this->paixu = null;

                 $qq = $this->mysql->prepare($sql);
                  $qq ->execute();
                 $row=$qq->fetch(PDO::FETCH_ASSOC);
                 if(!$row)return false;
                 else return $row; 
                 
        }else if($moth=='select'){

                 $chaxun = $this->tablejg[0]; 
                 $sql = "SELECT $chaxun FROM  `{$this->table}` {$this->where} {$this->paixu} {$this->lismt}";
                 
                 $this->where = $this->paixu = $this->lismt = null;

                 $qq = $this->mysql->prepare($sql);
                 $qq ->execute();
                 $row=$qq->fetchAll(PDO::FETCH_ASSOC);
                 if(!$row)return false; 
                 else return $row;  

        }else if($moth=='charu'){ 

                  $sql = "INSERT INTO   `{$this->table}` {$this->charu}";
                  $this->charu = null;
                  if( $this->SHIWU == 1)return $sql.';@;';
                  if( $CONN['duob'] == '1' && $this->bqdoq !=  $this->dqqz) 
                  $this->lianjie($this->DB[$this->bqdoq]); 
                  $qq = $this->mysql->prepare($sql);

                  $qq ->execute();
                  $id = $this->mysql->lastInsertId();
                  if($id)return $id ; 
                  else return false;
             

        }else if($moth=='shanchu'){
              
                $sql = "DELETE FROM  `{$this->table}` {$this->where}  {$this->lismt}";
                
                 $this->where = $this->lismt = null;
                 if( $this->SHIWU == 1)return $sql.';@;';
                       if( $CONN['duob'] == '1' && $this->bqdoq !=  $this->dqqz) 
                       $this->lianjie($this->DB[$this->bqdoq]);  
                      $qq = $this->mysql->prepare($sql);
                      $qq ->execute();
                       if($qq ->rowCount())return true; 
                       else return false;
                
         
         }else if($moth=='xiugai'){ 
                 
                 $sql = "UPDATE   `{$this->table}` SET {$this->update}  {$this->where}  {$this->lismt}";
                
                 $this->where = $this->update = $this->lismt = null;
                 if( $this->SHIWU == 1)return $sql.';@;';
                          if( $CONN['duob'] == '1' && $this->bqdoq !=  $this->dqqz) 
                          $this->lianjie($this->DB[$this->bqdoq]);   
                           $qq = $this->mysql->prepare($sql);
                          $qq ->execute();
                         if($qq ->rowCount())return true; 
                         else return false;
                  

         }else if($moth=='zongshu'){
                          $chaxun = $this->tablejg[0]; 

                          $sql = "SELECT count(*) as count FROM  `{$this->table}` {$this->where} {$this->paixu} {$this->lismt}";//sql 
                           $this->where = $this->paixu = $this->lismt = null;
                          $qq = $this->mysql->prepare($sql);
                          $qq ->execute();
                          $row=$qq->fetch(PDO::FETCH_ASSOC);
                        
                          return $row['count'];
         
         }else if($moth=='other'){ 

                 if( $CONN['duob'] == '1' && $this->bqdoq !=  $this->dqqz) 
                $this->lianjie($this->DB[$this->bqdoq]);  
                $qq = $this->mysql->prepare($this->sql);
            
                $qq ->execute();
                
                $row=$qq->fetch(PDO::FETCH_ASSOC);
                if(!$row)return false; 
                else return $row;
                  
        }else if($moth=='erwei'){

                  if( $CONN['duob'] == '1' && $this->bqdoq !=  $this->dqqz) 
                  $this->lianjie($this->DB[$this->bqdoq]);  
                
                 $qq = $this->mysql->prepare($this->sql);
                  $qq ->execute();
                 $row=$qq->fetchAll(PDO::FETCH_ASSOC);
                  if(!$row)return false; 
                  else return $row;  
        }else if($moth=='accse'){
                
                if( $CONN['duob'] == '1' && $this->bqdoq !=  $this->dqqz) 
                $this->lianjie($this->DB[$this->bqdoq]);  
                
                 $qq = $this->mysql->prepare($this->sql);
                  $row= $qq ->execute();
                   
                
                  if(!$row)return false; 
                  else return true; 
        
        
        
        }else if($moth=='shiwu'){
                       
                        if( $CONN['duob'] == '1' && $this->bqdoq !=  $this->dqqz) 
                        $this->lianjie($this->DB[$this->bqdoq]);  
                        $this->mysql->setAttribute(PDO::ATTR_AUTOCOMMIT, 0);

                        try{

                              $this->mysql->beginTransaction();
                              $zhiss =  explode(';@;',$this->sql);

                              foreach($zhiss as $tsss){

                                      if( $tsss == '')continue ;
                                      $woud = $this-> mysql ->exec($tsss.';');
                                      if(!$woud){
                                          $wodw = new txtcc;
                                          $wodw ->s('sqlerror/'.time().'_'.rand(1,9999999),$tsss.' @@@@@ '.$this->sql);
                                          $this-> mysql -> rollback(); 
                                          $this->sql = NULL;

                                          return false;
                                       }
                              }

                           return  $this->mysql->commit();

                        }catch( PDOExecption $e ) { 

                             $wodw = new txtcc;
                             $wodw ->s('sqlerror/'.time().'_'.rand(1,9999999), $this->sql);
                             $this-> mysql -> rollback(); 
                             return false;

                        }

               }
    }




}


class Dmysqli extends  AYDB{

public function lianjie($data){ 
        $mysqli = new mysqli($data['host'], $data['user'], $data['pass'],$data['name'],$data['port']);
        if (!$mysqli) return('db_error:' .$data['h']);
        $mysqli->query("SET NAMES '".$data['char']."'");
        $this->mysql = $mysqli; 
        return $mysqli;
}

public  function zhixing($moth='',$sql=''){ 

                  
                  global $CONN;
                 
                  $DATA = array();
         
        if($moth=='scjg'){ 
                 $sql = "desc `{$this->table}`";
                 $qq =$this->mysql->query($sql);
                 while ($row = $qq->fetch_array()) {
                    $DATA["$row[0]"]=$row[5]==''?$row[0].'_'.$row[4]:$row[5];
                  }
                  return  $DATA;
        }else if($moth=='find'){ 
                 $chaxun = $this->tablejg[0]; 
                 $sql = "SELECT $chaxun FROM  `{$this->table}` {$this->where} {$this->paixu} LIMIT 0 , 1"; 
                
                  $this->where =  $this->paixu = null;
                 $result = $this->mysql->query($sql);
                 if($result->num_rows==0)return false; 
                 else return $result->fetch_array(true);        
        }else if($moth=='select'){ 
                 $chaxun = $this->tablejg[0];
                 $sql = "SELECT $chaxun FROM  `{$this->table}` {$this->where} {$this->paixu} {$this->lismt}";
                 $this->lismt = $this->where =  $this->paixu = null;
                 $result = $this->mysql->query($sql);
                 if($result->num_rows==0)return false;   else return $result->fetch_all(true);
               
        }else if($moth=='charu'){ 

                 $sql = "INSERT INTO   `{$this->table}` {$this->charu}";
                 $this->charu = null;

                 if( $this->SHIWU == 1)return $sql.';@;';
                  
                  if( $CONN['duob'] == '1' && $this->bqdoq !=  $this->dqqz) 
                  $this->lianjie($this->DB[$this->bqdoq]);   
            
                  $this->mysql->query($sql);
                  $id = $this->mysql->insert_id;
                  if($id)return $id ; 
                  else return false;
             

        }else if($moth=='shanchu'){

            
             $sql = "DELETE FROM  `{$this->table}` {$this->where}  {$this->lismt}";
             $this->where = $this->lismt = null;

             if( $this->SHIWU == 1)return $sql.';@;';
                       if( $CONN['duob'] == '1' && $this->bqdoq !=  $this->dqqz) 
                       $this->lianjie($this->DB[$this->bqdoq]);    
                      
                       $this->mysql->query($sql);
                       if($this->mysql->affected_rows)return true; 
                       else return false;
                
         
         }else if($moth=='xiugai'){ 
                $sql = "UPDATE   `{$this->table}` SET {$this->update}  {$this->where}  {$this->lismt}";
                $this->where = $this->lismt =$this->update = null;


                if( $this->SHIWU == 1)return $sql.';@;';
                           
                          if( $CONN['duob'] == '1' && $this->bqdoq !=  $this->dqqz) 
                          $this->lianjie($this->DB[$this->bqdoq]);    
                          $this->mysql->query($sql);
                          if($this->mysql->affected_rows)return true; 
                          else return false;
                 
         }else if($moth=='zongshu'){
                          $chaxun = $this->tablejg[0];  
                          $sql = "SELECT count(*) as count FROM  `{$this->table}` {$this->where} {$this->paixu} {$this->lismt}";//
                        
                           $this->where = $this->lismt =$this->paixu = null;
                          $result =$this->mysql->query($sql);
                          $data =  $result->fetch_array(true);
                          return $data['count'];
         
         }else if($moth=='other'){
                     
                     if( $CONN['duob'] == '1' && $this->bqdoq !=  $this->dqqz) 
                     $this->lianjie($this->DB[$this->bqdoq]);  
            
                     $result = $this->mysql->query($this->sql);
                     if($result->num_rows==0)return false; 
                     else return $result->fetch_array(true);        
                  
        }else if($moth=='erwei'){ 

                 if( $CONN['duob'] == '1' && $this->bqdoq !=  $this->dqqz) 
                 $this->lianjie($this->DB[$this->bqdoq]);  
            
                  $result = $this->mysql->query($this->sql);
              
                 if($result->num_rows==0)return false;  else return $result->fetch_all(true); 
               
        }else if($moth=='accse'){
                     
                     if( $CONN['duob'] == '1' && $this->bqdoq !=  $this->dqqz) 
                     $this->lianjie($this->DB[$this->bqdoq]);  
            
                     $result = $this->mysql->query($this->sql);
                     if($result->num_rows==0)return false; 
                     else return true;
        
        
        
        }else if($moth=='shiwu'){
                    
                    if( $CONN['duob'] == '1' && $this->bqdoq !=  $this->dqqz) 
                    $this->lianjie($this->DB[$this->bqdoq]); 

             
                    $this-> mysql -> query("CREATE TABLE Language LIKE CountryLanguage");
                    $this-> mysql -> autocommit(FALSE);

                    try{


                           $zhiss =  explode(';@;',$this->sql);

                              foreach($zhiss as $tsss){

                                      if( $tsss == '')continue ;
                                      $woud = $this-> mysql ->query($tsss.';');
                                      if(!$woud){
                                          $wodw = new txtcc;
                                          $wodw ->s('sqlerror/'.time().'_'.rand(1,9999999),$tsss.' @@@@@ '.$this->sql);
                                          $this-> mysql -> rollback(); 
                                          $this->sql = NULL;

                                          return false;
                                       }
                              }

                            $fanhui = $this->mysql->commit();

                            $this-> mysql -> query("DROP TABLE Language");

                            return  $fanhui;



                    }catch( PDOExecption $e ) { 

                             $wodw = new txtcc;
                             $wodw ->s('sqlerror/'.time().'_'.rand(1,9999999), $this->sql);
                             $this-> mysql -> rollback(); 
                             return false;
                     }
        
        
        
        
        
        }


    }
}


class Dmysql extends  AYDB{  


public function lianjie($data){
                 $link = mysql_connect($data['host'].':'.$data['port'], $data['user'], $data['pass']);
                 if (!$link) return('db_error:' .$data['h']);
                 mysql_query("SET NAMES '".$data['char']."'",$link); 
                 mysql_select_db($data['name'],$link);               
                 $this->mysql = $link; 
                 return $link;
}


public  function zhixing($moth='',$sql=''){
                
                 $DATA = array();
        if($moth=='scjg'){ 
              $sql = "desc `{$this->table}`";
              $qq = mysql_query($sql,$this->mysql);
              while ($row = mysql_fetch_array($qq, MYSQL_NUM)) {
                    $DATA["$row[0]"]=$row[5]==''?$row[0].'_'.$row[4]:$row[5];
                    }
               return  $DATA;
        }else if($moth=='find'){ 
              $chaxun = $this->tablejg[0]; 
              $sql = "SELECT $chaxun FROM  `{$this->table}` {$this->where} {$this->paixu} LIMIT 0 , 1"; 
              $this->paixu =  $this->where=null;
              $result = mysql_query($sql,$this->mysql);
             
              if(mysql_num_rows($result)==0)return false; 
              else return mysql_fetch_row($result,true);
        }else if($moth=='select'){ 

              $chaxun = $this->tablejg[0];  
              $sql = "SELECT $chaxun FROM  `{$this->table}` {$this->where} {$this->paixu} {$this->lismt}";
              $this->lismt= $this->paixu =  $this->where=null;
              $result = mysql_query($sql,$this->mysql);
              if(mysql_num_rows($result)==0)return false; 
              else { 
                  while ($row = mysql_fetch_assoc($result))$DATA[]=$row; 
                  return $DATA; 
              }
         }else if($moth=='shanchu'){
             $sql = "DELETE FROM  `{$this->table}` {$this->where}  {$this->lismt}";
             $this->lismt=  $this->where=null;

             if( $this->SHIWU == 1)return $sql.';@;';
               
                         if( $CONN['duob'] == '1' && $this->bqdoq !=  $this->dqqz)
                       $this->lianjie($this->DB[$this->bqdoq]);   
                       
                       $result = mysql_query($sql,$this->mysql);
                       if(mysql_affected_rows())return true;
                       else return false;
              
         
         }else if($moth=='xiugai'){ 
              $sql = "UPDATE   `{$this->table}` SET {$this->update}  {$this->where}  {$this->lismt}";
               $this->update = $this->lismt=  $this->where=null;


               if( $this->SHIWU == 1)return $sql.';@;';

             if( $CONN['duob'] == '1' && $this->bqdoq !=  $this->dqqz)
              $this->lianjie($this->DB[$this->bqdoq]);   
             
              
              $result = mysql_query($sql,$this->mysql);
              if(mysql_affected_rows())return true; 
              else return false;
         

         }else if($moth=='charu'){ 
             $sql = "INSERT INTO   `{$this->table}` {$this->charu}";
           $this->charu=null;

               if( $this->SHIWU == 1)return $sql.';@;';
          if( $CONN['duob'] == '1' && $this->bqdoq !=  $this->dqqz)
            $this->lianjie($this->DB[$this->bqdoq]); 
            
            $result = mysql_query($sql,$this->mysql);
            $id = mysql_insert_id();
            if($id)return $id ; 
            else return false;
        

         }else if($moth=='zongshu'){ 
              $chaxun = $this->tablejg[0]; 
             $sql = "SELECT count(*) as count FROM  `{$this->table}` {$this->where} {$this->paixu} {$this->lismt}";//
                $this->paixu = $this->lismt=  $this->where=null;
              $result = mysql_query($sql,$this->mysql);
              $xxx = mysql_fetch_assoc($result);
              return $xxx['count'];
         }else if($moth=='other'){

                 if( $CONN['duob'] == '1' && $this->bqdoq !=  $this->dqqz)
                 $this->lianjie($this->DB[$this->bqdoq]);  
        
              $result=mysql_query($this->sql,$this->mysql);
              if(mysql_num_rows($result)==0)return false;
              else return mysql_fetch_assoc($result);
             
        }else if($moth=='erwei'){ 
            
               if( $CONN['duob'] == '1' && $this->bqdoq !=  $this->dqqz)
               $this->lianjie($this->DB[$this->bqdoq]);  
        
              $result=mysql_query($this->sql,$this->mysql);

              if(mysql_num_rows($result)==0)return false; 
              else { 
                  while ($row = mysql_fetch_assoc($result))$DATA[]=$row; 
                  return $DATA; 
              }

         }else if($moth=='accse'){

             if( $CONN['duob'] == '1' && $this->bqdoq !=  $this->dqqz)
              $this->lianjie($this->DB[$this->bqdoq]);  
        
              $result=mysql_query($this->sql,$this->mysql);

              if(mysql_num_rows($result)==0)return false;
              else return true;
         
         }else if($moth=='shiwu'){

                  if( $CONN['duob'] == '1' && $this->bqdoq !=  $this->dqqz)
                   $this->lianjie($this->DB[$this->bqdoq]);
                   
                   mysql_query($this->sql,"BEGIN"); 

 


                  try{
                  

                              $zhiss =  explode(';@;',$this->sql);

                              foreach($zhiss as $tsss){

                                      if( $tsss == '')continue ;
                                      $woud = mysql_query($this->sql,$tsss.';');
                                      if(!$woud){
                                          $wodw = new txtcc;
                                          $wodw ->s('sqlerror/'.time().'_'.rand(1,9999999),$tsss.' @@@@@ '.$this->sql);
                                            mysql_query($this->sql,"ROLLBACK");
                                         
                                            mysql_query($this->sql,"END"); 

                                          $this->sql = NULL;

                                          return false;
                                       }
                              }

                              $woud = mysql_query($this->sql,"COMMIT");

                              mysql_query($this->sql,"END"); 

                              return $woud;

                  
                  
                  }catch( PDOExecption $e ) { 

                             $wodw = new txtcc;
                             $wodw ->s('sqlerror/'.time().'_'.rand(1,9999999), $this->sql);

                             mysql_query($this->sql,"ROLLBACK" );
                             mysql_query($this->sql,"END"); 
                             return false;

                        }
         
         
         
         }






    }

}