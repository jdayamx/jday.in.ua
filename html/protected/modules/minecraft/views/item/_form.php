<?php
?>



<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mitem-form',
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
		<?php echo $form->labelEx($model,'id'); ?>
		</td>
		<td>
		<?php echo $form->textField($model,'id',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'id'); ?>
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
		<?php echo $form->labelEx($model,'category_id'); ?>
		</td>
		<td>
		<?php echo $form->dropDownList($model,'category_id',CHtml::ListData(MItemCategory::model()->FindAll(),'id','name')); ?>
		<?php echo $form->error($model,'category_id'); ?>
		</td>
	</tr>

	<tr valign="top">
		<td class="row" width="220">
		<?php echo $form->labelEx($model,'type_id'); ?>
		</td>
		<td>
		<?php echo $form->dropDownList($model,'type_id',CHtml::ListData(MItemType::model()->FindAll(),'id','name')); ?>
		<?php echo $form->error($model,'type_id'); ?>
		</td>
	</tr>

	<tr valign="top">
		<td class="row" width="220">
		<?php echo $form->labelEx($model,'reg_proc'); ?>
		</td>
		<td>
		<?php echo $form->textField($model,'reg_proc',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'reg_proc'); ?>
		</td>
	</tr>

	<tr valign="top">
		<td class="row" width="220">
		<?php echo $form->labelEx($model,'timetoget'); ?>
		</td>
		<td>
		<?php echo $form->textField($model,'timetoget',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'timetoget'); ?>
		</td>
	</tr>

	<tr valign="top">
		<td class="row" width="220">
		<?php echo $form->labelEx($model,'cost_by_craft'); ?>
		</td>
		<td>
		<?php echo $form->textField($model,'cost_by_craft',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'cost_by_craft'); ?>
		</td>
	</tr>

	<tr valign="top">
		<td class="row" width="220">
		<?php echo $form->labelEx($model,'cost'); ?>
		<?php echo '<div style="float:right;">'.CHtml::ajaxLink('Узнать',array('/minecraft/item/clac','id'=>$model->id),array('success'=>'function(data){$("#MItem_cost").val(data);}')).'</div>';?>
		</td>
		<td>
		<?php echo $form->textField($model,'cost'); ?>
		<?php echo $form->error($model,'cost'); ?>

		</td>
	</tr>

	<tr valign="top">
		<td class="row" width="220">
		<?php echo $form->labelEx($model,'count'); ?>
		</td>
		<td>
		<?php echo $form->textField($model,'count',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'count'); ?>
		</td>
	</tr>

	<tr>
		<td colspan="2" class="footer">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить'); ?>
		</td>
	</tr>
</table>

<?php $this->endWidget(); ?>

