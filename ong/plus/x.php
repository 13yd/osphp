<?php //

$PLUSx ='x';

function x( $filename, $arr='',$time=''){  

         if( is_array( $arr ))
             $con = var_export( $arr, true);
         else{
             $con = $arr;
             if(! $con || $con == '' ) $con = '0';
         }

         if( $con != ''){

             if($time != '') $con = "<?php \$time= '".zifuzhuan($time)."'; return $con;";
             else            $con = "<?php return $con;";
         } 
         
         conWrite( $filename, $con); 
         return true;
}


function conWrite( $filename, $content)
{
         $filename_lock = $filename.'.lock';
         $os = 0;
         while( 1 ) {

              $os++;
              if(file_exists( $filename_lock)) {

                  if($os > 1000){
                     unlink( $filename_lock);
                     break;
                  }
                  usleep( 1);

              }else{

                  touch( $filename_lock);
                  $f = fopen( $filename, 'w');
                  fwrite( $f, $content);
                  fclose( $f);
                  unlink( $filename_lock);
                  break;
              }
         }

         if( file_exists( $filename_lock)) unlink( $filename_lock);
}