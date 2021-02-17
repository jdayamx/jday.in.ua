<table>
	<tr>
		<td class="header" colspan="2">Новый платеж</td>
	</tr>

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'zp-form',
    'action'=>array('/utils/zp','do'=>'create'),
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>

    <tr>
		<td class="row" width="200">
			<?php echo $form->labelEx($model,'summ'); ?>
		</td>
		<td>
			<?php echo $form->textField($model,'summ',array('style'=>'width:150px;','size'=>10,'maxlength'=>20)); ?>
        	<?php echo $form->error($model,'summ'); ?>
		</td>
	</tr>
    <tr>
		<td class="row" width="200">
			<?php echo $form->labelEx($model,'sign'); ?>
		</td>
		<td>
			<?php echo $form->dropdownlist($model,'sign',array(1=>'Приход',0=>'Расход',),array('empty'=>'- выберите -')); ?>
        	<?php echo $form->error($model,'sign'); ?>
		</td>
	</tr>

    <tr>
		<td class="row" width="200">
			<?php echo $form->labelEx($model,'actual_date'); ?>
		</td>
		<td>
			<?php echo $form->textField($model,'actual_date',array('style'=>'width:150px;','size'=>10,'maxlength'=>20)); ?>
        	<?php echo $form->error($model,'actual_date'); ?>
		</td>
	</tr>
    <tr>
		<td class="row" width="200">
			<?php echo $form->labelEx($model,'work'); ?>
		</td>
		<td>
			<?php echo $form->textField($model,'work',array('size'=>60,'maxlength'=>64)); ?>
        	<?php echo $form->error($model,'work'); ?>
		</td>
	</tr>
    <tr>
		<td class="footer" colspan="2">
			<div style="float:left;">
				<?php echo $form->errorSummary($model); ?>
			</div>
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
		</td>
	</tr>

<?php $this->endWidget(); ?>
</table>