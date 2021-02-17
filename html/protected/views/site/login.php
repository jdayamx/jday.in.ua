<?php
$this->pageTitle=Yii::app()->name . ' - Вход в систему';
$this->breadcrumbs=array(
	'Вход в систему',
);
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableAjaxValidation'=>true,
)); ?>
<table class="table-choc border">
<tr>
<td class="header" colspan=3>Вход в систему</td>
</tr>
<tr valign="top">
<td colspan=2>Пожалуйста, заполните следующую форму с вашими учетные данные для входа:</td>
<td class="row_in" rowspan=5 width="40%">
<table height="100%">
<td align="center">
		<img src="/img/info.png">
	</td>
	<td align="left">
		<b>Внимание !!!</b><br>
		Если у Вас нет аккаунта, Вы его можете создать перейдя по <?=Chtml::link('этой ссылке',array('site/register'))?>.<br>
		Если Вы забыли пароль, его можно <?=Chtml::link('восстановить',array('site/lostpassword'))?>.<br>
		Поля отмеченные <span class="required">*</span> обязательны к заполнению.
	</td>
</table>

</td>
</tr>
<tr>
	<td>
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</td>
	<td width="200">
		<?php echo $form->textField($model,'username'); ?>
	</td>
</tr>
<tr>
	<td>
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
	</td>
	<td width="200">
		<?php echo $form->passwordField($model,'password'); ?>
	</td>
</tr>
<tr>
	<td >
		<?php echo $form->error($model,'rememberMe'); ?>
	</td>
	<td width="200">
		<?php echo $form->checkBox($model,'rememberMe',array('checked'=>'checked','hidden'=>'""')); ?>
		<?php echo $form->label($model,'rememberMe'); ?>

	</td>
</tr>
<tr>
	<td>

	</td>
	<td width="200">
		<?php echo CHtml::submitButton('Вход',array('class'=>'bbcode')); ?>
	</td>
</tr>
</table>
<?php $this->endWidget(); ?>

<br>





