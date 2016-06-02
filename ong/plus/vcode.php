<?php //

$PLUSvcode = 'vcode';

function vcode( $size = '0',$code = "0123456789", $shu = 4,$width = 130, $height = 40, $zadian = 100, $xiaos = 10){

        ob_clean();
        header("Content-type: image/png");

        $image = imagecreatetruecolor( $width , $height);
        imagefill( $image, 0, 0, imagecolorallocate( $image, 255, 255,245 ));

        if( $code == '' ) $code = "0123456789"; /* qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM*/

        $ascii='';  
        if($size == '0') $ZITI = rand(1,2);
        else  $ZITI = $size;
        $size = rand(23,28);

        imagesetthickness( $image ,30) ;

        for( $i = 0 ;$i < $shu ; $i++) {
            
            $char = $code{ rand( 0, strlen( $code )-1)};

            $COLOR = imagecolorallocate($image, rand(0,200), rand(0,200), rand(0,200));

            $shus = $i*( $width / $height ) * $xiaos ;
            $tux = $shus + rand( 5 , 10);
            $tuy =  (int)( $height / 2 ) + rand( 5 , $size);

            $coordinates = imagefttext( $image , $size , rand( -10, 20), $shus + rand( 5, 20), $tuy , $COLOR  , ONGPHP.'../tpl/font/'.$ZITI.'.ttf' , $char , array( 'character_spacing' => 20));

            if( rand( 0, 3) == 1 ) imagearc( $image, $tux + rand( -10 , 20), $tuy - rand( 1 , 20), 25 , 25 , 0, rand( 0 , 2 * $ZITI ), $COLOR);
            
            for( $z=0; $z <= $i * $zadian ; $z++ )  imagesetpixel( $image , rand( $tux - 30, $tux + 30),rand( $tuy - 30, $tuy + 30 ), $COLOR);
            
            $ascii .= $char;

        }
        if( rand( 0, 2) == 1)  imagearc( $image, $tux + rand( 10 , 20), $tuy -rand( 1 , 10), 22 , 22 , 0, rand( 0, 2 * $ZITI), $COLOR );

        $_SESSION['code'] = strtoupper( $ascii );
        $_SESSION['codetime'] = time();

        imagepng( $image );
        imagedestroy( $image );
}
