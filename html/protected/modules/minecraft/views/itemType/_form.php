<?php
?>



<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mitem-type-form',
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
		<?php echo $form->labelEx($model,'name'); ?>
		</td>
		<td>
		<?php echo $form->textField($model,'name',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'name'); ?>
		</td>
	</tr>

	<tr valign="top">
		<td class="row" width="220">
		<?php echo $form->labelEx($model,'nalog_bye'); ?>
		</td>
		<td>
		<?php echo $form->textField($model,'nalog_bye',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'nalog_bye'); ?>
		</td>
	</tr>

	<tr valign="top">
		<td class="row" width="220">
		<?php echo $form->labelEx($model,'nalog_sell'); ?>
		</td>
		<td>
		<?php echo $form->textField($model,'nalog_sell',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'nalog_sell'); ?>
		</td>
	</tr>

	<tr>
		<td colspan="2" class="footer">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить'); ?>
		</td>
	</tr>
</table>

<?php $this->endWidget(); ?>

