<? 

/*
	header("Content-type:text/html; charset=utf-8");
	$checkcode='';
	$possible_letters ='23456789bcdfghjkmnpqrstvwxyzABCDEFGHJKMNPQRSTWXYZ';

	for($i=0;$i<4;$i++){
		//$checkcode.=dechex(rand(0,15));
		$checkcode.=substr($possible_letters, mt_rand(0,strlen($possible_letters)-1),1);
	}
	
	session_start();
	$checkcode = strtolower($checkcode);
	$_SESSION['checkcode']=$checkcode;
	
	$im=imagecreatetruecolor(110,30);//创建画布，默认背景是黑色
	$white=imagecolorallocate($im,250,255,255);//创建一个颜色
	$colorRand=imagecolorallocate($im,rand(0,255),rand(0,255),rand(0,255));
	
	for($i=0;$i<20;$i++){
		imageline($im,rand(0,110),rand(0,30),rand(0,110),rand(0,30),$colorRand);
	}	
	
	$font='./fonts/arial.ttf';
	imagettftext($im,rand(10,25),0,rand(0,50),rand(20,30),$white,$font,$checkcode);
	//imagestring($im,rand(3,5),rand(0,80),rand(0,20),$checkcode,$white);//水平地画一行字符串

	header("content-type:image/png");
	imagepng($im);//输出图像到网页
	
	imagedestory($im);//销毁图像，释放内存
*/



/****************************************************************************************************************************/
/*
	require dirname(__FILE__).'/include/common.inc.php';
	 
	session_start();
	 
	$enablegd = 1;
	$funcs = array('imagecreatetruecolor','imagecolorallocate','imagefill','imageline','imagedestroy','imagecolorallocatealpha','imageellipse','imagepng');
	foreach($funcs as $func)
	{
		if(!function_exists($func))
		{
			$enablegd = 0;
			break;
		}
	}
	if(!function_exists('ob_gzhandler')) ob_clean();
	 
	if($enablegd)
	{
		//create captcha
		$consts = 'cdfgkmnpqrstwxyz23456';
		$vowels = 'aek23456789';
		for ($x = 0; $x < 6; $x++)
		{
			$const[$x] = substr($consts, mt_rand(0,strlen($consts)-1),1);
			$vow[$x] = substr($vowels, mt_rand(0,strlen($vowels)-1),1);
		}
		$radomstring = $const[0] . $vow[0] .$const[2] . $const[1] . $vow[1] . $const[3] . $vow[3] . $const[4];
		$_SESSION['checkcode'] = $string = substr($radomstring,0,4); //only display 4 str
		//set up image, the first number is the width and the second is the height
		$imageX = strlen($radomstring)*8;       //the image width
		$imageY = 20;                                           //the image height
		$im = imagecreatetruecolor($imageX,$imageY);
 
		//creates two variables to store color
		$background = imagecolorallocate($im, rand(180, 250), rand(180, 250), rand(180, 250));
		$foregroundArr = array(imagecolorallocate($im, rand(0, 20), rand(0, 20), rand(0, 20)),
								imagecolorallocate($im, rand(0, 20), rand(0, 10), rand(245, 255)),
								imagecolorallocate($im, rand(245, 255), rand(0, 20), rand(0, 10)),
								imagecolorallocate($im, rand(245, 255), rand(0, 20), rand(245, 255)));
		$foreground2 = imagecolorallocatealpha($im, rand(20, 100), rand(20, 100), rand(20, 100),80);
		$middleground = imagecolorallocate($im, rand(200, 160), rand(200, 160), rand(200, 160));
		$middleground2 = imagecolorallocatealpha($im, rand(180, 140), rand(180, 140), rand(180, 140),80);
 
		//fill image with bgcolor
		imagefill($im, 0, 0, imagecolorallocate($im, 250, 253, 254));
		//writes string
		if(function_exists('imagettftext'))
		{
			imagettftext($im, 12, rand(30, -30), 5, rand(14, 16), $foregroundArr[rand(0,3)], PHPCMS_ROOT.'include/fonts/ALGER.TTF', $string[0]);
			imagettftext($im, 12, rand(50, -50), 20, rand(14, 16), $foregroundArr[rand(0,3)], PHPCMS_ROOT.'include/fonts/ARIALNI.TTF', $string[1]);
			imagettftext($im, 12, rand(50, -50), 35, rand(14, 16), $foregroundArr[rand(0,3)], PHPCMS_ROOT.'include/fonts/ALGER.TTF', $string[2]);
			imagettftext($im, 12, rand(30, -30), 50, rand(14, 16), $foregroundArr[rand(0,3)], PHPCMS_ROOT.'include/fonts/arial.ttf', $string[3]);
		}
		else
		{
			imagestring($im, 5, 3, floor(rand(0,5))-1, $string[0], $foregroundArr[rand(0,3)]);
			imagestring($im, 5, 16, floor(rand(0,5))-1, $string[1], $foregroundArr[rand(0,3)]);
			imagestring($im, 5, 23, floor(rand(0,5))-1, $string[2], $foregroundArr[rand(0,3)]);
			imagestring($im, 5, 33, floor(rand(0,5))-1, $string[3], $foregroundArr[rand(0,3)]);
		}
		//strikethrough
 
		$border = imagecolorallocate($im, 133, 153, 193);
		//imagefilledrectangle($aimg, 0, 0, $x_size - 1, $y_size - 1, $back);
		imagerectangle($im, 0, 0, $imageX - 1, $imageY - 1, $border);
 
		$pointcol = imagecolorallocate($im, rand(0,255), rand(0,255), rand(0,255));
		for ($i=0;$i<80;$i++)
		{
			imagesetpixel($im,rand(2,$imageX-2),rand(2,$imageX-2),$pointcol);
		}
		//random shapes
		for ($x=0; $x<9;$x++)
		{
			if(mt_rand(0,$x)%2==0)
			{
				imageline($im, rand(0, 120), rand(0, 120), rand(0, 120), rand(0, 120), rand(0, 999999));
				imageellipse($im, rand(0, 120), rand(0, 120), rand(0, 120), rand(0, 120), $middleground2);
			}
			else
			{
				imageline($im, rand(0, 120), rand(0, 120), rand(0, 120), rand(0, 120), rand(0, 999999));
				imageellipse($im, rand(0, 120), rand(0, 120), rand(0, 120), rand(0, 120), $middleground);
			}
		}
			//output to browser
		header("content-type:image/png\r\n");
		imagepng($im);
		imagedestroy($im);
	}
	else
	{
		$files = glob(PHPCMS_ROOT.'images/checkcode/*.jpg');
		if(!is_array($files)) exit($LANG['please_check_dir_images_checkcode']);
 
		$checkcodefile = $files[rand(0, count($files)-1)];
		$_SESSION['checkcode'] = substr(basename($checkcodefile), 0, 4);
 
		header("content-type:image/jpeg\r\n");
		include $checkcodefile;
	}
*/








/**************************************************************************************************************************/

	
	session_start();
	//Settings: You can customize the captcha here
	$image_width = 120;
	$image_height = 40;
	$characters_on_image = 4;
	$font = './fonts/arial.ttf';

	//The characters that can be used in the CAPTCHA code.
	//avoid confusing characters (l 1 and i for example)
	$possible_letters = '23456789bcdfghjkmnpqrstvwxyzABCDEFGHJKMNPQRSTWXYZ';
	//$possible_letters = '0123456789abcdefghijklnmopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	//$possible_letters = '0123456789abcdefghijklnmopqrstuvwxyz';
	$random_dots = 10;
	$random_lines = 30;
	$captcha_text_color="0x142864";
	$captcha_noice_color = "0x142864";

	$code = '';

	$i = 0;
	while ($i < $characters_on_image){ 
		$code .= substr($possible_letters, mt_rand(0, strlen($possible_letters)-1), 1);
		$i++;
	}


	$font_size = $image_height * 0.75;
	$image = @imagecreate($image_width, $image_height);


	// setting the background, text and noise colours here 
	$background_color = imagecolorallocate($image, 255, 255, 255);

	$arr_text_color = hexrgb($captcha_text_color);
	$text_color = imagecolorallocate($image, $arr_text_color['red'], 
	$arr_text_color['green'], $arr_text_color['blue']);

	$arr_noice_color = hexrgb($captcha_noice_color);
	$image_noise_color = imagecolorallocate($image, $arr_noice_color['red'], 
	$arr_noice_color['green'], $arr_noice_color['blue']);


	// generating the dots randomly in background 
	for( $i=0; $i<$random_dots; $i++ ) {
		imagefilledellipse($image, mt_rand(0,$image_width),mt_rand(0,$image_height), 2, 3, $image_noise_color);
	}


	// generating lines randomly in background of image 
	for( $i=0; $i<$random_lines; $i++ ) {
		imageline($image, mt_rand(0,$image_width), mt_rand(0,$image_height),mt_rand(0,$image_width), mt_rand(0,$image_height), $image_noise_color);
	}


	// create a text box and add 6 letters code in it 
	$textbox = imagettfbbox($font_size, 0, $font, $code); 
	$x = ($image_width - $textbox[4])/2;
	$y = ($image_height - $textbox[5])/2;
	imagettftext($image, $font_size, 0, $x, $y, $text_color, $font , $code);


	// Show captcha image in the page html page 
	header('Content-Type: image/jpeg');// defining the image type to be shown in browser widow
	imagejpeg($image);//showing the image
	imagedestroy($image);//destroying the image instance
	$code = strtolower($code);
	$_SESSION['checkcode'] = $code;
	function hexrgb ($hexstr)
	{
	  $int = hexdec($hexstr);
	  return array("red" => 0xFF & ($int >> 0x10),"green" => 0xFF & ($int >> 0x8),"blue" => 0xFF & $int);
	}


?>