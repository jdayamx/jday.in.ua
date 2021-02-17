<?php

$this->breadcrumbs=array(
	'Для детей'=>array('/child'),
	'Генератор раскрасок'=>array('child/colorings'),
	'Загрузить с интернета',
);

$form=$this->beginWidget('CActiveForm', array(
    'id'=>'child-colorings-form',
    'enableAjaxValidation'=>false,
)); ?>

<table class="table-choc border shadow">
	<tr>
        <td class="header" colspan="2">Загрузить с интернета</td>
    </tr>
    <tr>
	        <td class="row" width="25%">
	            <?php echo $form->labelEx($model,'name'); ?>:
	            <h5></h5>
	        </td>
	        <td>
	            <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>128)); ?>
	            <?php echo $form->error($model,'name'); ?>
	        </td>
	   </tr>
    <tr>
    <tr>
	        <td class="row" width="25%">
	            <?php echo $form->labelEx($model,'url'); ?>:
	            <h5></h5>
	        </td>
	        <td>
	            <?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>250)); ?>
	            <?php echo $form->error($model,'url'); ?>
	        </td>
	   </tr>
    <tr>
	<tr>
	        <td class="row" width="25%">
	            <?php echo $form->labelEx($model,'category_id'); ?>
	:
	            <h5></h5>
	        </td>
	        <td>
	            <?php //echo $form->textField($model,'country_id');
	            	echo $form->dropDownList($model,'category_id',CHtml::listData(ChildColoringsCategory::model()->findAll(array('order' => 'name',)), 'id', 'name'));
	            ?>
	            <?php echo $form->error($model,'category_id'); ?>
	        </td>
	   </tr>
    <tr>
<tr>
    <td class="footer" colspan=2>
    	<div style="float:left;">
    		<?php echo $form->errorSummary($model); ?>
    	</div>
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Загрузить' : 'Сохранить', array('class'=>'bbcode')); ?>
    </td>
</tr>
</table>
<?php $this->endWidget(); ?>