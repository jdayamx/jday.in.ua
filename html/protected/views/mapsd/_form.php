<?php
/* @var $this MapsdController */
/* @var $model MapsDownload */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'maps-download-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'resurce'); ?>
		<?php echo $form->textField($model,'resurce',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'resurce'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gamename'); ?>
		<?php echo $form->textField($model,'gamename',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'gamename'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gamemod'); ?>
		<?php echo $form->textField($model,'gamemod',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'gamemod'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mapname'); ?>
		<?php echo $form->textField($model,'mapname',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'mapname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'images'); ?>
		<?php echo $form->textArea($model,'images',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'images'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lastupdate'); ?>
		<?php echo $form->textField($model,'lastupdate'); ?>
		<?php echo $form->error($model,'lastupdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_download'); ?>
		<?php echo $form->textField($model,'is_download'); ?>
		<?php echo $form->error($model,'is_download'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'filename'); ?>
		<?php echo $form->textField($model,'filename',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'filename'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->