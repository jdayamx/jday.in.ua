<style>
.detail_box {
	display: table;
	position:relative;
	width:930px;
	text-align:left;
	height:170px;
	margin:9px;
	padding:5px;
	background:#fff;
	border:1px solid #999;
	border-radius:3px;
	box-shadow: 0 0 3px rgba(0,0,0,0.5);
}
.info {
	display:table-cell;
	vertical-align:middle;
}
</style>
<div class="detail_box">
	<div class="info">
		<img src="<?=$model->logo;?>" style="float:left;margin-right:20px;">
	</div>
<div style="float:left;width:700px;">
<h1><?=$model->name_en .' '.($model->name_ru?'<font color="gray">('.$model->name_ru.')</font>':'');?></h1>
<hr>
<p>
<?=$model->description;?>
</p>
<b>Сайт:</b> <?=CHtml::link($model->url,$model->url);?>
<div style="text-align:right;right:15px;bottom:15px;;width:200px;position:absolute;">
<?php echo CHtml::link('В','http://slando.ua/transport/legkovye-avtomobili/'.mb_strtolower(str_replace(' ','-',trim($model->name_en)))).'се'.CHtml::link('го','http://market.autoua.net/catalog/cars/'.mb_strtolower(str_replace(' ','_',trim($model->name_en))).'/').' '.Yii::t('','{n} модель|{n} модели|{n} моделей|{n} модели',$model->cars_count);?>
</div>
</div>
</div>