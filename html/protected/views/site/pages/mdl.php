<?php

$mdl = Yii::app()->mdl;
$mdl->Load(realpath(dirname(__FILE__).'/can.mdl'));
//echo '<pre>'.print_r($mdl->header, true).'</pre>';

$this->renderpartial('/site/game/mdl',array('model'=>$mdl));

echo '<pre>'.print_r($mdl, true).'</pre>';


?>