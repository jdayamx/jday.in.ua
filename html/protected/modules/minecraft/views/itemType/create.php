<?php
/* @var $this ItemTypeController */
/* @var $model MItemType */

$this->breadcrumbs=array(
	'Mitem Types'=>array('index'),
	'Новая запись',
);
?>

<table class="table-choc border">
	<tr>
		<td class="header">
			Новая запись
		</td>
	</tr>
	<tr>
		<td width="30%" class="row_in">
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>		</td>
	</tr>
</table>