<style>
.capcha {	text-align:center;}
.capcha img{	clear:both;
	margin:10px;}
</style>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'user-form',
    'enableAjaxValidation'=>true,
)); ?>
<table class="table-choc border">
<tr>
<td colspan="2" class="header"><?php  echo $title;?></td>
</tr>
<tr>
<td colspan="2"><?php echo $form->errorSummary($model); ?>
Поля отмеченные <span class="required">*</span> обязательны к заполнению.
</td>
</tr>
<tr>
	<td class="row" width="200">
		<?php echo $form->labelEx($model,'username'); ?>
	</td>
	<td>
		<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>128, 'placeholder'=>'Ваш логин')); ?>
		<?php echo $form->error($model,'username'); ?>
	</td>
</tr>
<tr>
	<td class="row">
		<?php echo $form->labelEx($model,'password'); ?>
	</td>
	<td>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>128, 'placeholder'=>'Ваш пароль')); ?>
		<?php echo $form->error($model,'password'); ?>
	</td>
</tr>
<tr>
	<td class="row">
		<?php echo $form->labelEx($model,'password2'); ?>
	</td>
	<td>
		<?php echo $form->passwordField($model,'password2',array('size'=>60,'maxlength'=>128, 'placeholder'=>'Подтверждение пароля')); ?>
		<?php echo $form->error($model,'password2'); ?>
	</td>
</tr>
<tr>
	<td class="row">
		<?php echo $form->labelEx($model,'email'); ?>
	</td>
	<td>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128, 'placeholder'=>'Ваш почтовый ящик')); ?>
		<?php echo $form->error($model,'email'); ?>
	</td>
</tr>
<tr>
	<td class="row">
		<?php echo $form->labelEx($model,'icq'); ?>
	</td>
	<td>
		<?php echo $form->textField($model,'icq',array('placeholder'=>'ICQ номер, если есть')); ?>
		<?php echo $form->error($model,'icq'); ?>
	</td>
</tr>
<tr>
	<td class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
	</td>
	<td>
		<?php echo $form->textField($model,'phone',array('placeholder'=>'Контактный телефон, формат ввода: 38cccaaabbxx')); ?>
		<?php echo $form->error($model,'phone'); ?>
	</td>
</tr>
<tr valign="middle">
	<td class="row">
		 <div class="capcha"><?php $this->widget('CCaptcha',
    array('captchaAction' => '/site/captcha')
); ?></div>
	</td>
	<td>
		<?php echo $form->textField($model,'verifyCode',array('style'=>'width:100px;','placeholder'=>'Код с картинки')); ?>
		<?php echo $form->error($model,'verifyCode'); ?>
	</td>
</tr>
<tr>
	<td colspan="2" class="footer">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Зарегистрироваться' : 'Сохранить',array('class'=>'bbcode')); ?>
	</td>
</tr>
</table>

<?php $this->endWidget(); ?>