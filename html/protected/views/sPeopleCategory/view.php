<?php
$this->breadcrumbs=array(
	'Speople Categories'=>array('index'),
	$model->name,
);
?>

<table class="table-choc border">
	<tr>
		<td class="header">
			Просмотр SPeopleCategory #<?php echo $model->id; ?>
		</td>
	</tr>
	<tr>
		<td width="30%" class="row_in">

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
</td>
	</tr>
</table>
