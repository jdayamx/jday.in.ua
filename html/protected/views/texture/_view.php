<?php
/* @var $this TextureController */
/* @var $data Texture */
?>

<div style="text-align:center;border-radius:3px;margin-bottom:10px;margin-right:10px;float:left;width:172px;border:1px solid #777;max-height:200px;height:200px;" class="shadow">

	<?php
		if($data->type!='wad') {
			echo CHtml::link('<div style="height:150px;width:100%;background-image:url('.$data->filename.');"></div>',array('texture/view','id'=>$data->id));
		} else {
			echo CHtml::link('<div style="height:150px;width:100%;background-image:url(/img/wad.png);"></div>',array('texture/view','id'=>$data->id));
		}
	?>

<?php
echo CHtml::encode($data->name);


echo '<hr>'.CHtml::encode($data->Category->name);


?>

</div>