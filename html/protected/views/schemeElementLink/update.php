<?php

$this->breadcrumbs=array(
	'Scheme Element Links'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Правка',
);

?>
<table class="table-choc border">
	<tr>
		<td class="header">
			Правка SchemeElementLink <?php echo $model->id; ?>		</td>
	</tr>
	<tr>
		<td width="30%" class="row_in">
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>		</td>
	</tr>
</table>