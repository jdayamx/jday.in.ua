<?php
/* @var $this ModelController */

$this->breadcrumbs=array(
	'Список моделей'=>array('/model'),
	'Загрузить модель',
);

$form=$this->beginWidget('CActiveForm', array(
    'id'=>'files-s-form',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
));
?>
<table class="table-choc border shadow">
	<tr>
		<td class="header" colspan="2">
			Загрузить модель
		</td>
	</tr>
	<tr>
		<td class="row" width="200">
			Выберите файл:
		</td>
		<td>
			<?php
				echo $form->FileField($model, 'model_file');
				echo $form->errorSummary($model);
			?>
		</td>
	</tr>
	<tr>
		<td class="footer" colspan="2">
			<?php
				echo CHtml::submitButton('Загрузить');
			?>
		</td>
	</tr>
</table>
<?php
$this->endWidget();
?>