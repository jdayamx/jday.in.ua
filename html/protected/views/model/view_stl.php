<?php
/* @var $this ModelController */

$this->breadcrumbs=array(
	'Список моделей'=>array('/model'),
	'Просмотр '.$model->name,
);


$files = glob(realpath('uploads/model').DIRECTORY_SEPARATOR.$model->created.DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.$model->id.'_*.png');
$img = array();
$imgs = '';
foreach($files as $file) {
	$file = str_replace(realpath('uploads/model'),'/uploads/model',$file);
	$imgs .= CHtml::image($file,'screenshot '.$file);
	$img[] = $file;
}


//$mdl = Yii::app()->mdl;
//$mdl->Load($model->filename);

?>
<table class="table-choc border shadow">
	<tr>
		<td class="header" colspan="3">
			Модель <?php echo $model->name;?>
		</td>
	</tr>
	<tr valign="top">
		<td class="row_in" width="300" rowspan="3">
			<?php echo CHtml::image($img[0],'Модель '.$img[0],array('width'=>300));?>
		</td>
		<td class="row" width="200">
			Название:
		</td>
		<td>
			<?php echo $model->name;?>
		</td>
	</tr>
	<tr valign="top">
		<td class="row" width="200">
			Категория:
		</td>
		<td>
			<?php echo CHtml::link($model->Category->p->name,array('model/index','Model3d[category_id][]'=>$model->Category->p->id));?> -> <?php echo CHtml::link($model->Category->name,array('model/index','Model3d[category_id][]'=>$model->category_id));?>
		</td>
	</tr>
	<tr valign="top">
		<td class="row" width="200">
			Дата добавления:
		</td>
		<td>
			<?php echo $model->created;?>
		</td>
	</tr>



	<tr valign="top">
		<td colspan="3">
		<b>Скачать модель:</b><br>
			<?php
				echo CHtml::link($model->name,array('/model/download','id'=>$model->id));
			?>
			<br><br>
			Cкачиваний: <?php echo $model->downloads;?>
		</td>

	</tr>


	<tr>
		<td class="row" colspan="3">
			<div style="text-align:center;"><?php echo $imgs;?></div>
		</td>
	</tr>
</table>
