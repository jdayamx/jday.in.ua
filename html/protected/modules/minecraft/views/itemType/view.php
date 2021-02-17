<?php
$this->breadcrumbs=array(
	'Mitem Types'=>array('index'),
	$model->name,
);
?>

<table class="table-choc border">
	<tr>
		<td class="header">
			Просмотр MItemType #<?php echo $model->id; ?>
		</td>
	</tr>
	<tr>
		<td width="30%" class="row_in">

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'nalog_bye',
		'nalog_sell',
	),
)); ?>
</td>
	</tr>
</table>
