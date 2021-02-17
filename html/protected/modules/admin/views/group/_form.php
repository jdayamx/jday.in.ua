<?php
/* @var $this GroupController */
/* @var $model Group */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'group-_group_form-form',
	'enableAjaxValidation'=>false,
)); ?>

<!-- form -->
<table class="table-choc border shadow">
	<tr>
		<td class="header" colspan="2"><?php echo $title;?></td>
	</tr>
	<tr>
		<td class="row" width="25%">
			<?php echo $form->labelEx($model,'name'); ?>
:
			<h5></h5>
		</td>
		<td>
			<?php echo $form->textField($model,'name'); ?>
			<?php echo $form->error($model,'name'); ?>
		</td>
	</tr>
	<tr>
		<td class="row">
			<?php echo $form->labelEx($model,'description'); ?>
:
			<h5></h5>
		</td>
		<td>
			<?php echo $form->textField($model,'description'); ?>
			<?php echo $form->error($model,'description'); ?>
		</td>
	</tr>
	<tr>
		<td class="row">
			<?php echo $form->labelEx($model,'color'); ?>
:
			<h5></h5>
		</td>
		<td>
			<?php echo $form->textField($model,'color'); ?>
			<?php echo $form->error($model,'color'); ?>
		</td>
	</tr>
 	<tr>
		<td colspan=2 class="footer">
			<div id="update" style="float:left;"><?php echo $form->errorSummary($model); ?>
</div> <?php echo CHtml::submitButton('Отправить'); ?>
		</td>
	</tr>
</table>
<!-- /form -->

<?php $this->endWidget(); ?>
