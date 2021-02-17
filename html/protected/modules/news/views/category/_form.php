<style>
#drop_zone {
      background: #ddd;
      border: #888 5px dotted;
      text-align: center;
      padding: 50px 0px 50px 0px;
      margin: 10px auto 10px auto;
      font: italic bold 15px verdana;
      color: #555;
      text-shadow: 1px 1px white;
    }
</style>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'category-form',
	'enableAjaxValidation'=>true,
)); ?>

<!-- form -->
<table class="table-choc border shadow">
	<tr>
		<td class="header" colspan="2"><?php echo $title;?></td>
	</tr>
	<tr>
		<td class="row" width="25%">
			<?php echo $form->labelEx($model,'name'); ?>
:
			<h5></h5>
		</td>
		<td>
			<?php echo $form->textField($model,'name'); ?>
			<?php echo $form->error($model,'name'); ?>
		</td>
	</tr>
	<tr>
		<td class="row">
			<?php echo $form->labelEx($model,'description'); ?>
:
			<h5></h5>
		</td>
		<td>
			<?php echo $form->textField($model,'description'); ?>
			<?php echo $form->error($model,'description'); ?>
		</td>
	</tr>
	<tr>
		<td class="row">
			<?php echo $form->labelEx($model,'image'); ?>
:
			<h5></h5>
		</td>
		<td>
			<?php echo $form->hiddenfield($model,'image',array('id'=>'image')); ?>
			<div id="drop_zone" class="span14" >Перемести картинку в это поле</div>
			<p class="hint"><?php
			if($model->image) echo '<img src="'.$model->image.'" width="200" id="imgview" style="max-width:200px;max-height:200px;">';
			?></p>
			<?php echo $form->error($model,'image'); ?>
		</td>
	</tr>
 	<tr>
		<td colspan=2 class="footer">
			<div id="update" style="float:left;"><?php echo $form->errorSummary($model); ?>
</div> <?php echo CHtml::submitButton('Отправить'); ?>
		</td>
	</tr>
</table>
<!-- /form -->

<?php $this->endWidget(); ?>

<script>
	var dropZone = document.getElementById('drop_zone');
	dropZone.addEventListener('dragover', handleDragOver, false);
	dropZone.addEventListener('drop', handleFileSelect, false);

	function handleFileSelect(e) {
      	e.stopPropagation();
      	e.preventDefault();
		var files = e.dataTransfer.files;

		for (var i = 0, f; f = files[i]; i++) {
        var reader = new FileReader()

        reader.onload = (function(file) {
          return function(e) {
            var name = file.name.replace(/\..+/, "")
            var image = new Image()
            image.src = e.target.result
            image.onload = function() {
            $('#image').val(e.target.result);
            $('#imgview').attr('src',e.target.result);

            }

          }
        })(f)
        reader.readAsDataURL(f)
      }
    }

    function handleDragOver(e) {
      e.stopPropagation();
      e.preventDefault();
      e.dataTransfer.dropEffect = 'copy';
    }

</script>
