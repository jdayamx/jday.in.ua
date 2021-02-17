<div style="width:50px;position:relative;left:10px;top:30px;">
<?php
	echo CHtml::ajaxLink(CHtml::image('/img/icons/map-icon.png','+'),array('texture/add','link'=>$model->filename),array('update'=>'#new_form'));
?>
</div>
<?
echo CHtml::image($model->filename,$model->name);
$ret = getimagesize(realpath('').$model->filename);
//print_r($ret[0]);
echo CHtml::image($model->filename,$model->name, array('style'=>'margin-left:5px;width:'.($ret[0]/2).'px'));
echo CHtml::image($model->filename,$model->name, array('style'=>'margin-left:5px;width:'.($ret[0]/4).'px'));
//echo $model->imageid;


?>