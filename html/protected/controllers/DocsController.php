<?php

class DocsController extends Controller
{
	public function accessRules()
	{
		return CMap::mergeArray(
		array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('Imgs'),
				'users'=>array('*'),
			),
		),
		parent::accessRules()
		);
	}

	public function actionImgs($img='')
	{
		$img = array_keys($_REQUEST);
		$this->add_log('Хотел потянуть картинку '.
		CHtml::encode($img[0]).($_SERVER["HTTP_REFERER"]?' '.CHtml::link('Ссылка',$_SERVER["HTTP_REFERER"]):'').
		'<pre>'.
		(count($_COOKIE)?'<b>COOKIE:</b>'.PHP_EOL.print_r($_COOKIE,true):'').
		(count($_REQUEST)?'<b>REQUEST:</b>'.PHP_EOL.print_r($_REQUEST,true):'').
		(count($_SERVER)?'<b>SERVER:</b>'.PHP_EOL.print_r($_SERVER,true):'').
		'</pre>',3);
		//http://sms-fly.com - рассылка смс
		$im = @imagecreatefrompng('http://jday.in.ua/img/hack_detection.png');
		//$text_color = imagecolorallocate($im, 233, 14, 91);
		//imagestring($im, 1, 5, 5,  $img[0], $text_color);
		//$text_color = imagecolorallocate($im, 0, 0, 0);
		//imagestring($im, 5, 5, 15,  'JDay HACK Detection (This web site can broke your computer)', $text_color);

		// Set the content type header - in this case image/jpeg
		header('Content-Type: image/jpeg');

		// Output the image
		imagepng($im);

		// Free up memory
		imagedestroy($im);
		//print_r($img[0]);
	}
}
