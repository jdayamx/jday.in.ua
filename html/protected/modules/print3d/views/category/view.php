<?php
$this->breadcrumbs=array(
	'Pcategories'=>array('index'),
	$model->name,
);
?>

<table class="table-choc border">
	<tr>
		<td class="header">
			Просмотр PCategory #<?php echo $model->id; ?>
		</td>
	</tr>
	<tr>
		<td width="30%" class="row_in">

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'pid',
		'name',
		'description',
		'enabled',
	),
)); ?>
</td>
	</tr>
</table>
