<?php
/* @var $this MItemController */
/* @var $model MItem */

$this->breadcrumbs=array(
	'Mitems'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MItem', 'url'=>array('index')),
	array('label'=>'Manage MItem', 'url'=>array('admin')),
);
?>

<h1>Create MItem</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>