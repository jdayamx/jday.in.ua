<?php
/* @var $this MapsdController */
/* @var $model MapsDownload */

$this->breadcrumbs=array(
	'Maps Downloads'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MapsDownload', 'url'=>array('index')),
	array('label'=>'Manage MapsDownload', 'url'=>array('admin')),
);
?>

<h1>Create MapsDownload</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>