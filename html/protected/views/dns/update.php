<?php
/* @var $this DnsController */
/* @var $model DnsDomain */

$this->breadcrumbs=array(
	'Dns Domains'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DnsDomain', 'url'=>array('index')),
	array('label'=>'Create DnsDomain', 'url'=>array('create')),
	array('label'=>'View DnsDomain', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage DnsDomain', 'url'=>array('admin')),
);
?>

<h1>Update DnsDomain <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>