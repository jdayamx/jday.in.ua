<?php
?>



<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'scheme-form',
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
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'name'); ?>
		</td>
	</tr>

	<tr valign="top">
		<td class="row" width="220">
		<?php echo $form->labelEx($model,'parent_id'); ?>
		</td>
		<td>
		<?php echo $form->textField($model,'parent_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'parent_id'); ?>
		</td>
	</tr>

	<tr valign="top">
		<td class="row" width="220">
		<?php echo $form->labelEx($model,'description'); ?>
		</td>
		<td>
		<?php
		//echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50));
		$this->widget('application.extensions.tinymce.ETinyMce',
                array(
                    'model'=>$model,
					'attribute'=>'description',
                    'useSwitch' => false,
                    'editorTemplate'=>'full',

                    'options' => array(
			            'width'=>'100%',
                    	'height'=>'600',
         			),

                    )
                );
		?>
		<?php echo $form->error($model,'description'); ?>
		</td>
	</tr>

	<tr valign="top">
		<td class="row" width="220">
		<?php echo $form->labelEx($model,'logo'); ?>
		</td>
		<td>
		<?php echo $form->textArea($model,'logo',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'logo'); ?>
		</td>
	</tr>

	<tr>
		<td colspan="2" class="footer">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить'); ?>
		</td>
	</tr>
</table>

<?php $this->endWidget(); ?>

