<?php
?>



<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pcategory-form',
	'enableAjaxValidation'=>true,
)); ?>

<table>
<tr>
	<td colspan="2">
		Поля со значком <span class="required">*</span> обязательны к заполнению
		<?php echo $form->errorSummary($model); ?>
	</td>
</tr>


	<tr valign="top">
		<td class="row" width="220">
		<?php echo $form->labelEx($model,'pid'); ?>
		</td>
		<td>
		<?php echo $form->DropDownList($model,'pid',CHtml::ListData(PCategory::model()->findAll(array('order'=>'if(pid>0,pid,id), pid, name','select'=>'*, if(pid,concat("--",name),name) as name')),'id','name'), array('empty'=>'-- нет --')); ?>
		<?php echo $form->error($model,'pid'); ?>
		</td>
	</tr>

	<tr valign="top">
		<td class="row" width="220">
		<?php echo $form->labelEx($model,'name'); ?>
		</td>
		<td>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'name'); ?>
		</td>
	</tr>

	<tr valign="top">
		<td class="row" width="220">
		<?php echo $form->labelEx($model,'description'); ?>
		</td>
		<td>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
		</td>
	</tr>

	<tr valign="top">
		<td class="row" width="220">
		<?php echo $form->labelEx($model,'enabled'); ?>
		</td>
		<td>
		<?php echo $form->DropDownList($model,'enabled', $model->yesno); ?>
		<?php echo $form->error($model,'enabled'); ?>
		</td>
	</tr>

	<tr>
		<td colspan="2" class="footer">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить'); ?>
		</td>
	</tr>
</table>

<?php $this->endWidget(); ?>

