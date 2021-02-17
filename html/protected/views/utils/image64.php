<style>
#drop_zone {
      background: #ddd;
      border: #888 5px dotted;
      text-align: center;
      width: 800px;
      padding: 50px 0px 50px 0px;
      margin: 10px auto 10px auto;
      font: italic bold 15px verdana;
      color: #555;
      text-shadow: 1px 1px white;
    }
</style>

<?php
$this->breadcrumbs=array(
	'Утилиты'=>array('/utils'),
	'Изображение в Base64 encoder',
);
?>
<?php echo CHtml::beginForm(); ?>
<table class="table-choc border" id="win">
	<tr>
		<td class="header" colspan="2">Изображение в Base64 encoder</td>
	</tr>
	<tr>
		<td>
			<?php echo CHtml::activeLabel($model,'url'); ?>
			<?php echo CHtml::activeTextField($model,'url'); ?>
		</td>
		<td class="row" width="200">
			<?php echo CHtml::submitButton('Конвертировать'); ?>
		</td>
	</tr>
	<tr>
		<td colspan="2" id="img">
		<?php
			if($data !== null) {				echo '<img src="data:image/png;base64,'.base64_encode($data).'"><br>';
				echo '<textarea>data:image/png;base64,'.base64_encode($data).'</textarea>';
			}
		?>
		</td>
	</tr>
	<tr>
		<td class="header" colspan="2">Изображение из файла</td>
	</tr>
	<tr>
		<td colspan="2">
		       <div id="drop_zone">Перемести картинку в это поле</div>
		</td>
	</tr>
</table>
<?php echo CHtml::endForm(); ?>

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
              //var output = []
             // output.push("." + name + " {")

              /* Make CSS-images behave more like normal images */
              //if(document.forms[0].behave_like_image.checked) {
                //output.push("width: " + image.width + "px;")
                //output.push("height: " + image.height + "px;")
               // output.push("display: inline-block;")
              //}

              //output.push("background: transparent url(" + e.target.result + ") top left no-repeat;")

              //output.push("}")
              //output_tag.innerHTML += (document.forms[0].no_newlines.checked ? output.join(" ") : output.join("\n"))
              //output_tag.innerHTML += "\n"

              /* Support IE7 and below */
              //if(document.forms[0].ie7_compatibility.checked) {
              //  output_tag.innerHTML += "*:first-child+html ." + name + " { *background: transparent url(" + document.forms[0].image_path.value + file.name  + ") top left no-repeat; zoom: 1; display: inline; }";
              //  output_tag.innerHTML += "\n"
              //}
              //alert(name);
              //output_tag2.innerHTML += '<img name="' + name + '" src="' + e.target.result + '" />' + "\n"
              $('#win').append('<tr class="cim_'+name+'"><td class="header" colspan="2">Файл '+name+' ('+image.width+'x'+image.height+')<img src="/img/icons/cross-icon.png" style="float:right;cursor:pointer;" onclick="$(\'.cim_'+ name +'\').remove();"></td></tr>'+
              '<tr class="cim_'+name+'"><td><textarea rows="5">'+e.target.result+'</textarea></td><td><img src="'+e.target.result+'" style="max-width:200px;max-height:200px;"></td></tr>');
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