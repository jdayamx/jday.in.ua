<?php
/* @var $this CarController */
/* @var $data Car */
?>

<div class="car">
	<div class="info">
	<?php
		echo CHtml::link(CHtml::image($data->logo,$data->model,array('width'=>200)),array('/autobot/models/view','id'=>$data->id));
	?>



    <?php echo '<b>'.$data->brand->name_en.'</b> '.$data->model.' - '.$data->year.' ['.count($data->carSales).']' ?>
    <br />

   </div>
</div>