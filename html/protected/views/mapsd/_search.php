<?php
/* @var $this MapsdController */
/* @var $model MapsDownload */
/* @var $form CActiveForm */
?>


<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

<table class="table-choc border">
	<tr>
		<td class="header" colspan=2>Поиск карты</td>
	</tr>
	<tr>
		<td class="row">
			<?php echo $form->label($model,'gamename'); ?>
			<?php //echo $form->textField($model,'gamename',array('size'=>60,'maxlength'=>64));
				echo $form->DropDownList($model,'gamename',CHtml::ListData(MapsDownload::model()->findAll(array('group'=>'gamename','condition'=>'gamemod LIKE :gm','params'=>array(':gm'=>'%'.trim($model->gamemod).''))),'gamename','gamename'),array('empty'=>'-- Выберите игру --'));
			?>
		</td>
		<td class="row">
			<?php echo $form->label($model,'gamemod'); ?>
			<?php //echo $form->textField($model,'gamemod',array('size'=>60,'maxlength'=>64));
				echo $form->DropDownList($model,'gamemod',CHtml::ListData(MapsDownload::model()->findAll(array('group'=>'gamemod','condition'=>'gamename LIKE :gn','params'=>array(':gn'=>'%'.trim($model->gamename).''))),'gamemod','gamemod'),array('empty'=>'-- Выберите мод --'));
			?>
		</td>
	</tr>
<tr>
	<td class="row" colspan=2>
		<?php echo $form->label($model,'mapname'); ?>
		<?php echo $form->textField($model,'mapname',array('size'=>60,'maxlength'=>64)); ?>
	</td>
</tr>
	<tr class="footer">
		<td colspan=2>
			<?php echo CHtml::submitButton('Поиск',array('class'=>'btn')); ?>
		</td>
	</tr>

</table>
<?php $this->endWidget(); ?>
<br>