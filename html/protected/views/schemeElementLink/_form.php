<?php
?>



<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'scheme-element-link-form',
	'enableAjaxValidation'=>true,
)); ?>

<table>
<tr>
	<td colspan="2">
		Поля со значком <span class="required">*</span> обязательны к заполнению
		<?php echo $form->errorSummary($model); ?>
	</td>
</tr>


	<tr valign="top">
		<td class="row" width="220">
		<?php echo $form->labelEx($model,'element_id'); ?>
		</td>
		<td>
		<?php echo $form->dropDownList($model,'element_id',CHtml::ListData(Element::model()->findAll(),'id','name'),array('empty'=>'-- Выберите элемент --')); ?>
		<?php echo $form->error($model,'element_id'); ?>
		</td>
	</tr>

	<tr valign="top">
		<td class="row" width="220">
		<?php echo $form->labelEx($model,'number'); ?>
		</td>
		<td>
		<?php echo $form->textField($model,'number',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'number'); ?>
		</td>
	</tr>

	<tr valign="top">
		<td class="row" width="220">
		<?php echo $form->labelEx($model,'element_type_id'); ?>
		</td>
		<td>
		<?php
			$types = ElementTypeCategory::model()->findAll();
			echo '<table><tr>';
			$el = 0;
			foreach($types as $type) {
				echo '<td class="header">';
				echo $type->name;
				echo '</td>';
			}
			echo '</tr><tr valign="top">';
			foreach($types as $type) {
				echo '<td >';
				foreach(CHtml::ListData($type->elementTypes, 'id', 'nameimage') as $val=>$label) {
					//echo $form->radio($model,'element_type_id',CHtml::ListData($type->elementTypes, 'id', 'nameimage'), array('id'=>'elm_'.$type->id.$el));
					echo '<div>';

					echo CHtml::radioButton('SchemeElementLink[element_type_id]',($model->element_type_id==$val?$model->element_type_id:''),array('value'=>$val,'id'=>'elm_'.$type->id.$el));

					echo '<label for="elm_'.$type->id.$el.'">'.$label.'</label>';
					echo '</div>';
					$el++;
				}
				echo '</td>';

			}
			echo '</tr></table>';

		?>
		<?php echo $form->error($model,'element_type_id'); ?>
		</td>
	</tr>

	<tr valign="top">
		<td class="row" width="220">
		<?php echo $form->labelEx($model,'value'); ?>
		</td>
		<td>
		<?php echo $form->textField($model,'value',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'value'); ?>
		</td>
	</tr>

	<tr>
		<td colspan="2" class="footer">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить'); ?>
		</td>
	</tr>
</table>

<?php $this->endWidget(); ?>

