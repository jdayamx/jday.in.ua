<?php
$this->breadcrumbs=array(
	'Mitem Categories'=>array('index'),
	$model->name,
);
?>

<table class="table-choc border">
	<tr>
		<td class="header">
			Просмотр MItemCategory #<?php echo $model->id; ?>
		</td>
	</tr>
	<tr>
		<td width="30%" class="row_in">

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'nalog',
	),
)); ?>
</td>
	</tr>
</table>
