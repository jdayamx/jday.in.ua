<?php
if(isset($_POST['img'])) {
	file_put_contents('postdata.txt', date('Y-m-d H:i:s').PHP_EOL.print_r($_POST,true));
	$_data = base64_decode(str_replace('data:image/png;base64,','',$_POST['img']));
	file_put_contents('gc_screenshot_'.time().'.png', $_data);
}
// change the following paths if necessary
$yii=dirname(__FILE__).'/../../framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following line when in production mode
 defined('YII_DEBUG') or define('YII_DEBUG',true);

require_once($yii);
Yii::createWebApplication($config)->run();
