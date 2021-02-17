<?php $form=$this->beginWidget('CActiveForm'); ?>
<?php echo $form->hiddenField($model,'name'); ?>
<?php echo $form->hiddenField($model,'pid'); ?>
<?php echo $form->hiddenField($model,'mid'); ?>
<?php echo $form->hiddenField($model,'info'); ?>
<?php echo $form->hiddenField($model,'filename'); ?>
<?php echo $form->hiddenField($model,'type'); ?>

<?php
	//тут начинается магия
	//echo $model->name;

	foreach(TextureCategory::model()->findAll() as $cat) {		if($cat->preg&&preg_match('/'.$cat->preg.'/ui',$model->name)) {			$model->texture_category_id = $cat->id;			break;		}	}

	$mat = '';
	$mats = '';

	foreach(TextureMaterials::model()->findAll() as $m) {
		if($m->preg&&preg_match('/'.$m->preg.'/ui',$model->name)) {
			$mat = $m->id;
			$mats .='<div id="mat_'.$m->id.'"><input name="Materials[]" value="'.$m->id.'" type="hidden"><b>'.$m->name.'</b> <img src="/img/icons/cross-icon.png" onclick="$(\'#mat_'.$m->id.'\').remove();"></div>'.PHP_EOL;
			//break;
		}
	}
?>

<table class="table-choc border">
<tr>
<td class="header" colspan=2>Новая текстура</td>
</tr>
<tr >
<td class="" >

<label>Название:</label> <?=$model->name;?>

<?php echo CHtml::errorSummary($model); ?>

</td>
</tr>
	<tr>
		<td colspan=2>
		<?php
		//TextureMaterials
			echo $form->dropDownList($model,'texture_category_id',CHtml::listData(TextureCategory::model()->findAll(array('order' => 'name')), 'id', 'name'));
		?>
		</td>
	</tr>
	<tr>
		<td colspan=2>
		<?php
		//TextureMaterials
			echo CHtml::dropDownList('Material',$mat,CHtml::listData(TextureMaterials::model()->findAll(array('order' => 'name')), 'id', 'name'),array('id'=>'addmaterial'));
			echo '&nbsp;'.CHtml::image('/img/icons/add-icon.png','+',array('onclick'=>'$("#materials").append("<div id=\"mat_"+$("#addmaterial").val()+"\"><input name=\"Materials[]\" value=\""+$("#addmaterial").val()+"\" type=\"hidden\"><b>"+$("#addmaterial :selected").text()+"</b> <img src=\"/img/icons/cross-icon.png\" onclick=\"$(\'#mat_"+$("#addmaterial").val()+"\').remove();\"></div>");'))
		?>
		<div id="materials">
		<?php
			echo $mats;
		?>
		</div>
		</td>
	</tr>
	<tr>
		<td class="row" colspan="2">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
		</td>

	</tr>
</table>
<?php $this->endWidget(); ?>