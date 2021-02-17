<?php
$this->breadcrumbs=array(
	'Mitems'=>array('index'),
	$model->name,
);
?>

<table class="table-choc border">
	<tr>
		<td class="header">
			Просмотр MItem #<?php echo $model->id; ?>
		</td>
	</tr>
	<tr>
		<td width="30%" class="row_in">

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'category.name',
		'type.name',
		'reg_proc',
		'timetoget',
		'cost_by_craft',
		'cost',
		'count',
	),
)); ?>
</td>
	</tr>
</table>
