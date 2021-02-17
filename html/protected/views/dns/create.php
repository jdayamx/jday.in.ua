<?php
/* @var $this DnsController */
/* @var $model DnsDomain */

$this->breadcrumbs=array(
	'Dns Domains'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DnsDomain', 'url'=>array('index')),
	array('label'=>'Manage DnsDomain', 'url'=>array('admin')),
);
?>

<h1>Create DnsDomain</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>