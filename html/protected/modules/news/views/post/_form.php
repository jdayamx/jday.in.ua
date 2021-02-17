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
	'id'=>'post-form',
	'enableAjaxValidation'=>false,
)); ?>

<!-- form -->
<table class="table-choc border shadow">
	<tr>
		<td class="header" colspan="2"><?php echo $title;?></td>
	</tr>
	<tr>
		<td class="row" width="25%">
			<?php echo $form->labelEx($model,'title'); ?>
:
			<h5></h5>
		</td>
		<td>
			<?php echo $form->textField($model,'title'); ?>
			<?php echo $form->error($model,'title'); ?>
		</td>
	</tr>
	<tr>
		<td class="row" width="25%">
			<?php echo $form->labelEx($model,'category_id'); ?>
:
			<h5></h5>
		</td>
		<td>
			<?php echo $form->DropDownList($model,'category_id',CHtml::ListData(Category::model()->findAll(), 'id', 'name'),array('empty'=>'-- нет --')); ?>
			<?php echo $form->error($model,'category_id'); ?>
		</td>
	</tr>
	<tr>
		<td class="row" width="25%">
			<?php echo $form->labelEx($model,'body'); ?>
:
			<h5></h5>
		</td>
		<td>
			<?php
			//echo $form->textarea($model,'body', array('rows'=>'10'));
			$this->widget('application.extensions.tinymce.ETinyMce',
                array(
                    'model'=>$model,
					'attribute'=>'body',
                    'useSwitch' => false,
                    'editorTemplate'=>'full',

                    'options' => array(
			            'width'=>'100%',
                    'height'=>'300',
         			),

                    )
     	);
			?>
			<?php echo $form->error($model,'body'); ?>
		</td>
	</tr>
	<tr>
		<td class="row" width="25%">
			<?php echo $form->labelEx($model,'visible'); ?>
:
			<h5></h5>
		</td>
		<td>
			<?php echo $form->checkBox($model,'visible'); ?>
			<?php echo $form->error($model,'visible'); ?>
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
			if($model->image) {
				echo '<img src="'.$model->image.'" width="200" id="imgview" style="max-width:200px;max-height:200px;">';
			} else {
				echo '<img src="data:image/png;base64,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" id="imgview" style="max-width:200px;max-height:200px;">';
			}
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
