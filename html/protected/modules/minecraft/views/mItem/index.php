<?php
/* @var $this MItemController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Mitems',
);

$this->menu=array(
	array('label'=>'Create MItem', 'url'=>array('create')),
	array('label'=>'Manage MItem', 'url'=>array('admin')),
);
?>

<h1>Mitems</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
