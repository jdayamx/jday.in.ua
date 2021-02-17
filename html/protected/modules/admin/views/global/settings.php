<?php
echo CHtml::beginForm('','POST');
?>
<table class="table-choc border shadow">
	<tr>
		<td colspan="2" class="header">Настройка системы</td>
	</tr>
	<tr>
		<td width="290" class="row">
			Название сайта:
			<h5>например: "Моя домашняя страница"</h5>
		</td>
		<td class="field">
			<?php echo CHtml::textField('setup[title]', Yii::app()->settings->get('setup','title')); ?>
		</td>
	</tr>
	<tr>
		<td class="row">
			Описание (Description) сайта:
			<h5>Краткое описание, не более 200 символов</h5>
		</td>
		<td class="field">
			<?php echo CHtml::textArea('setup[description]', Yii::app()->settings->get('setup','description')); ?>
		</td>
	</tr>
	<tr>
		<td class="row">
			Ключевые слова (Keywords) для сайта:
			<h5>Введите через запятую основные ключевые слова для вашего сайта</h5>
		</td>
		<td class="field">
			<?php echo CHtml::textArea('setup[keywords]', Yii::app()->settings->get('setup','keywords')); ?>
		</td>
	</tr>
	<tr>
		<td class="row">
			Скрыть кнопку входа на сайте:
			<h5>При скрытии кнопки на сайте, для входа появится горячая кнопка <font color="red">F8</font></h5>
		</td>
		<td class="field">
			<?php echo CHtml::DropDownList('setup[adminhotkey]', Yii::app()->settings->get('setup','adminhotkey'),array(0=>'Нет', 1=>'Да')); ?>
		</td>
	</tr>
	<tr>
		<td colspan="2" class="footer">
			<?php echo CHtml::submitButton('Сохранить настройки'); ?>
		</td>
	</tr>
</table>

<br>

<?php
echo CHtml::endForm();

$this->pageTitle=Yii::app()->name . ' - Настройка системы';
$this->breadcrumbs=array(
	'Панель управления'=>array('/admin/global/menu'),
	'Настройка системы',
);
?>
<!--
<audio controls="controls" autoplay="autoplay" loop="loop" preload="auto" style="display:none;">
        <source src="/media/breakme.ogg" type="audio/ogg">
        <source src="/media/breakme.mp3" type="audio/mpeg">
</audio>
-->