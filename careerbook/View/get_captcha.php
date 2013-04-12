<?php
    session_start();
    header('content-type: images/jpeg');
    
    if(!isset($_REQUEST['secure'])) {
    	$_SESSION['secure'] = rand(1000,9999);
    }
    
    $text = $_SESSION['secure'];
    
    $text_font = 30;
    $image_width = 210;
    $image_height = 40;
    


	// Name the font to be used (note the lack of the .ttf extension)
	$font = '../font/Xeron.ttf';

    $image = imagecreate($image_width,$image_height);
    imagecolorallocate($image,255,255,255);
    
    $text_color = imagecolorallocate($image,0,0,0);
    
    for($x=1; $x<=30; $x++ ) {
        $x1 = rand(1,100);
        $y1 = rand(1,100);
        $x2 = rand(1,100);
        $y2 = rand(1,100);
        
        imageline($image,$x1,$y1,$x2,$y2,$text_color);
    }
    
    imagettftext($image,$text_font,0,15,30,$text_color,$font,$text);
    imagejpeg($image);
    
?>