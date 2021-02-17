<?php
/* @var $this UtilsController */

$this->breadcrumbs=array(
	'Утилиты'=>array('/utils'),
	'Нарезка изображения',
);
?>
<?php echo CHtml::beginForm(); ?>
<table class="table-choc border">
	<tr>
		<td class="header" colspan="2">Нарезка изображения</td>
	</tr>
	<tr>
		<td>
			<?php echo CHtml::activeLabel($model,'url'); ?>
			<?php echo CHtml::activeTextField($model,'url'); ?>
		</td>
		<td class="row" width="200" rowspan=2>
			<?php echo CHtml::submitButton('Начать нарезку'); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo CHtml::activeLabel($model,'width'); ?>
			<?php echo CHtml::activeTextField($model,'width'); ?>
			<?php echo CHtml::activeLabel($model,'height'); ?>
			<?php echo CHtml::activeTextField($model,'height'); ?>
		</td>
	</tr>
	<tr>
		<td colspan="2" id="img">
		<?php
			if($data !== null) {				echo '<img src="data:image/png;base64,'.base64_encode($data).'">';
				$im = ImageCreateFromString($data);
				$W = imagesx($im);
				$H = imagesy($im);

				$wc = (int)($W/$model->width);
				$hc = (int)($H/$model->height);
				echo '<hr>';
				for($i=0;$i<=$hc-1;$i++) {					for($j=0;$j<=$wc-1;$j++) {
						$dst = imagecreatetruecolor($model->width,$model->height);
						imagecopy($dst, $im, 0, 0, $model->width*$j,$model->height*$i, $W, $H);
						ob_start();
						imagepng($dst);
						$imagedata = ob_get_contents();
						ob_end_clean();
						//imagepng($dst);
						echo '<div width="'.($model->width+2).'" style="float:left;background-color:#aaa;margin-right:5px;margin-bottom:5px;border:2px solid #555;">
								<img style="margin:4px;" src="data:image/png;base64,'.base64_encode($imagedata).'"><br>';
								echo '<textarea style="max-width:'.($model->width+2).'px;">data:image/png;base64,'.base64_encode($imagedata).'</textarea>';
						echo '</div>';
						imagedestroy($dst);					}
				   //$dst = imagecreatetruecolor($w,$h);
				   //$x = $w*($i%$model->width);
				   //if(!($i%$part)) $y = $h*($i/$model->height);
				   //imagecopy($dst, $im, 0, 0, $x, $y, $w, $h);
				   //echo '<img src="data:image/png;base64,'.base64_encode($dst).'">';
				   //imagejpeg($dst,'part-'.$i.'.jpg');
				}
				imagedestroy($im);
			}
		?>
		</td>
	</tr>
</table>
<?php echo CHtml::endForm(); ?>