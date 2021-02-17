<?php
require_once(dirname(__FILE__).'/../../../components/simple_html_dom.php');


//Yii::import('application.components.simple_html_dom');
/*
//http://bonuscodewot.ru/razdacha-segodnya.html
	$ctx = stream_context_create(array('http'=>
		    array(
		        'timeout' => 1200,  //1200 Seconds is 20 Minutes
		    )
		));
$content = file_get_contents('http://bonuscodewot.ru/razdacha-segodnya.html', false, $ctx);
var_dump($content);*/
$content = file_get_html('http://bonuscodewot.ru/razdacha-segodnya.html');
//echo CHtml::encode($content);
$img = $content->find('div.basecont img')[0]->src;
$src = 'http://bonuscodewot.ru/'.$img;
echo CHtml::image($src,'');
$ctx = stream_context_create(array('http'=>
		    array(
		        'timeout' => 1200,  //1200 Seconds is 20 Minutes
		    )
		));

if($img) {
	file_put_contents('test.jpg',file_get_contents($src, false, $ctx));

	$IMagick = new IMagick('test.jpg');
	$IMagick->setImageColorSpace(Imagick::COLORSPACE_GRAY);
	file_put_contents('test.jpg',$IMagick);
	$IMagick = new IMagick('test.jpg');
	$IMagick->negateImage(0);
	$imageprops = $IMagick->getImageGeometry();
	$IMagick->modulateImage(200, 11, 11);
	$IMagick->resizeImage($imageprops['width']*2, $imageprops['height']*2, imagick::FILTER_SINC, 1, true);

	//
	//$IMagick->resizeImage(1000,540,Imagick::FILTER_LANCZOS,1);
	file_put_contents('test.jpg',$IMagick);
	//$IMagick = new IMagick('test.jpg');
	//$imageprops = $IMagick->getImageGeometry();
	//$IMagick->resizeImage($imageprops['width'], $imageprops['height'], imagick::FILTER_SINC, 1, true);
	//file_put_contents('test.jpg',$IMagick);

	//echo $IMagick;
	echo CHtml::image('/test.jpg','---------------------');

	unlink('test.txt.parser.txt');
	$output = shell_exec('tesseract test.jpg test.txt.parser nobatch letters  -c \'tessedit_char_whitelist=0123456789QWERTYUIOPASDFGHJKLZXCVBNM-.\'');


	$text = trim(file_get_contents('test.txt.parser.txt'));
	$text= str_replace('—','-',$text);
	preg_match('/.*(.{5}-.{5}-.{5}-.{5}).*/ui',$text,$zz);
	$text = $zz[0];
	//print_r($zz[0]);
	echo '<h1>'.$text.'</h1>';

	echo '<input type="text" style="font-size:40px;" value="'. trim($text,'- ').'">';


	print_R($output);
	$output = shell_exec('tesseract test.jpg stdout hocr');
	print_R($output);
} else {
	echo 'Ждемс картинку';
}
//echo '<iframe sandbox="allow-same-origin" src="https://ru.wargaming.net/shop/bonus/" height="420" width="99%">Ваш браузер не поддерживает плавающие фреймы!</iframe>';



?>