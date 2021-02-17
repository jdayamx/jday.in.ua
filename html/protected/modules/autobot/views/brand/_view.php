 <?php
/* @var $this CarBrandController */
/* @var $data CarBrand */
?>

<div class="wbox">
	<div class="info">
	<?php
		echo CHtml::link(CHtml::image($data->logo,$data->name_en,array('width'=>128)),array('/autobot/models/index','brand_id'=>$data->id));
	?>
	<br />
    <?php echo '<b>'.$data->name_en.'</b> ('.$data->name_ru.')';
    ?>
    </div>
</div>