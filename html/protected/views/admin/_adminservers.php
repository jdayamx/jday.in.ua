<?php


$this->breadcrumbs=array(
	'Админка' => array('index'),
	'Админы серверов'
);


?>

<div class="panelR">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'admin-servers-admin-form',
	'enableAjaxValidation'=>false,
)); ?>
<table class="shortstory">
<tr>
<td class="thead" colspan="2">admin</td>
</tr>
<tr>
<td class="row2" colspan="2"><?php echo $form->errorSummary($model); ?>
Поля отмеченные <span class="required">*</span> обязательны к заполнению.</td>
</tr>
<tr>
	<td class="row1">
		<?php echo $form->labelEx($model,'lgsl_id'); ?>
		<?php echo $form->error($model,'lgsl_id'); ?>
	</td>
	<td class="row2">
		<?php
		//echo $form->textField($model,'lgsl_id');
		echo $form->dropDownList($model,'lgsl_id', CHtml::listData(Yii::app()->lgsl->server_list(), 'id', 'name'));
		?>
	</td>
</tr>
<tr>
	<td class="row1">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</td>
	<td class="row2">
		<?php
		//echo $form->textField($model,'user_id');
		echo $form->dropDownList($model,'user_id', CHtml::listData(User::model()->UserAdmins(), 'id', 'name'),array(
		'ajax' => array(
			'type'=>'POST', //request type
			'url'=>CController::createUrl('ServerList'), //url to call.
			'update'=>'#AdminServers_lgsl_id', //selector to update
		)
	));
		?>
	</td>
</tr>
<tr>
	<td class="row1">
		<?php echo $form->labelEx($model,'cpanel'); ?>
		<?php echo $form->error($model,'cpanel'); ?>
	</td>
	<td class="row2">
		<?php echo $form->dropDownList($model,'cpanel',array(0=>'Нет',1=>'Да')); ?>
	</td>
</tr>
<tr>
	<td class="row1">
	</td>
	<td class="row2">
		<?php echo CHtml::submitButton('Отправить', array('class'=>'bbcode')); ?>
	</td>
</tr>
</table>
<?php $this->endWidget(); ?>
</div>
<br>