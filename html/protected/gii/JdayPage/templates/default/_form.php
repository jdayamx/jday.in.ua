<?php echo "<?php\n"; ?>
?>



<?php echo "<?php \$form=\$this->beginWidget('CActiveForm', array(
	'id'=>'".$this->class2id($this->modelClass)."-form',
	'enableAjaxValidation'=>true,
)); ?>\n"; ?>

<table>
<tr>
	<td colspan="2">
		Поля со значком <span class="required">*</span> обязательны к заполнению
		<?php echo "<?php echo \$form->errorSummary(\$model); ?>\n"; ?>
	</td>
</tr>


<?php
foreach($this->tableSchema->columns as $column)
{
	if($column->autoIncrement)
		continue;
?>
	<tr valign="top">
		<td class="row" width="220">
		<?php echo "<?php echo ".$this->generateActiveLabel($this->modelClass,$column)."; ?>\n"; ?>
		</td>
		<td>
		<?php echo "<?php echo ".$this->generateActiveField($this->modelClass,$column)."; ?>\n"; ?>
		<?php echo "<?php echo \$form->error(\$model,'{$column->name}'); ?>\n"; ?>
		</td>
	</tr>

<?php
}
?>
	<tr>
		<td colspan="2" class="footer">
			<?php echo "<?php echo CHtml::submitButton(\$model->isNewRecord ? 'Добавить' : 'Сохранить'); ?>\n"; ?>
		</td>
	</tr>
</table>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>

