<?php
/* @var $this MapsdController */
/* @var $model MapsDownload */

$this->breadcrumbs=array(
	'Maps Downloads'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MapsDownload', 'url'=>array('index')),
	array('label'=>'Create MapsDownload', 'url'=>array('create')),
	array('label'=>'View MapsDownload', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage MapsDownload', 'url'=>array('admin')),
);
?>

<h1>Update MapsDownload <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>