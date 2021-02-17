<div style="position:relative;width:100%;height:100%;">
<?
echo CHtml::image($model[0]->url,$model[0]->name,array('width'=>'70%','style'=>'left:0;position:absolute;top:0;'));
echo CHtml::image($model[1]->url,$model[1]->name,array('width'=>'70%','style'=>'right:0;position:absolute;bottom:0;'));

?>
</div>