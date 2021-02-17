<?php
/* @var $this MItemController */
/* @var $model MItem */

$this->breadcrumbs=array(
	'Mitems'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List MItem', 'url'=>array('index')),
	array('label'=>'Create MItem', 'url'=>array('create')),
	array('label'=>'Update MItem', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete MItem', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MItem', 'url'=>array('admin')),
);
?>

<h1>View MItem #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'category_id',
		'type_id',
		'reg_proc',
		'timetoget',
		'cost_by_craft',
		'cost',
		'count',
	),
)); ?>
