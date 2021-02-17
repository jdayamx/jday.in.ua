<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'car-form',
    'enableAjaxValidation'=>false,
)); ?>

<table class="table-choc border">
	<tr>
		<td class="header" colspan="2">
			Правка <?=$model->brand->name_en.' '.$model->model.' ('.$model->year.')';?>
		</td>
	</tr>
	<tr>
		<td class="row" width="200">
          	<?php echo $form->labelEx($model,'brand_id'); ?>
		</td>
		<td class="row">
			<?php echo $form->DropDownList($model,'brand_id',CHtml::ListData(CarBrand::model()->findAll(),'id','name')); ?>
        	<?php echo $form->error($model,'brand_id'); ?>
		</td>
	</tr>
	<tr>
		<td class="row" width="200">
          	<?php echo $form->labelEx($model,'model'); ?>
		</td>
		<td class="row">
			<?php echo $form->textField($model,'model',array('size'=>60,'maxlength'=>128)); ?>
        	<?php echo $form->error($model,'model'); ?>
		</td>
	</tr>
	<tr>
		<td class="row" width="200">
          	 <?php echo $form->labelEx($model,'year'); ?>
		</td>
		<td class="row">
			<?php echo $form->textField($model,'year'); ?>
        	<?php echo $form->error($model,'year'); ?>
		</td>
	</tr>
	<tr>
		<td class="row" width="200">
          	<?php echo $form->labelEx($model,'body_type_id'); ?>
		</td>
		<td class="row">
			<?php echo $form->DropDownList($model,'body_type_id',CHtml::ListData(CarBodyType::model()->findAll(),'id','name'),array('empty'=>'-- Пусто --')); ?>
        	<?php echo $form->error($model,'body_type_id'); ?>
		</td>
	</tr>
</table>

    <?php echo $form->errorSummary($model); ?>


    <div class="row">
        <?php echo $form->labelEx($model,'logo'); ?>
        <?php echo $form->textArea($model,'logo',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'logo'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

<?php $this->endWidget(); ?>
