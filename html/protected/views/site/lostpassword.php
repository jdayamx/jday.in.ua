<?php
	$baseUrl = Yii::app()->baseUrl;
	$cs = Yii::app()->getClientScript();
	$this->pageTitle=Yii::app()->name . ' - Восстановление пароля';
	$this->breadcrumbs=array(
	'Login',
);
?>

<?php $form=$this->beginWidget('CActiveForm', array('id'=>'lp-form','enableAjaxValidation'=>true,)); ?>
	<table class="table-choc border">
		<tr>
			<td class="header" colspan=2>Восстановление пароля</td>
		</tr>
		<tr>
			<td colspan="2">
				<?php echo $form->labelEx($model,'email'); ?>
			</td>
		</tr>
		<tr>
			<td class="field">
				<?php echo $form->textField($model,'email'); ?>
				<?php echo $form->error($model,'email'); ?>
			</td>
			<td class="login_pass_message field">
				У вас нет аккаунта ? <br />
				<?=CHtml::link('Создать аккаунт',array('site/register'))?>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<?php echo CHtml::submitButton('Отправить',array('class'=>'bbcode')); ?>
			</td>
		</tr>
	</table>
<?php $this->endWidget(); ?>
