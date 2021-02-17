<?php
/* @var $this MItemController */
/* @var $data MItem */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('category_id')); ?>:</b>
	<?php echo CHtml::encode($data->category_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type_id')); ?>:</b>
	<?php echo CHtml::encode($data->type_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reg_proc')); ?>:</b>
	<?php echo CHtml::encode($data->reg_proc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('timetoget')); ?>:</b>
	<?php echo CHtml::encode($data->timetoget); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cost_by_craft')); ?>:</b>
	<?php echo CHtml::encode($data->cost_by_craft); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('cost')); ?>:</b>
	<?php echo CHtml::encode($data->cost); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('count')); ?>:</b>
	<?php echo CHtml::encode($data->count); ?>
	<br />

	*/ ?>

</div>