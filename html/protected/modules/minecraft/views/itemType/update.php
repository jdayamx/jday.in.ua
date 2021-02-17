<?php

$this->breadcrumbs=array(
	'Mitem Types'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Правка',
);

?>
<table class="table-choc border">
	<tr>
		<td class="header">
			Правка MItemType <?php echo $model->id; ?>		</td>
	</tr>
	<tr>
		<td width="30%" class="row_in">
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>		</td>
	</tr>
</table>