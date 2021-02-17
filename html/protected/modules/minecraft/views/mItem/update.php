<?php
/* @var $this MItemController */
/* @var $model MItem */

$this->breadcrumbs=array(
	'Mitems'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MItem', 'url'=>array('index')),
	array('label'=>'Create MItem', 'url'=>array('create')),
	array('label'=>'View MItem', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage MItem', 'url'=>array('admin')),
);
?>

<h1>Update MItem <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>