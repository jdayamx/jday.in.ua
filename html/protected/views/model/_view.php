<?
if($data->mode) {	$b = 'background-color:#fff;';} else {	$b = 'background-color:#fdd;';}
?>
<div style="<?=$b?>text-align:center;border-radius:3px;margin-bottom:10px;margin-right:10px;float:left;width:172px;border:1px solid #777;max-height:200px;height:200px;" class="shadow">
<?
	echo CHtml::link($data->Logo,array('/model/view','id'=>$data->id));
	echo CHtml::encode($data->name).'<hr><b>'.CHtml::link($data->Category->p->name,array('model/index','Model3d[category_id][]'=>$data->Category->p->id)).'</b><br>'.CHtml::link($data->Category->name,array('model/index','Model3d[category_id][]'=>$data->category_id));
?>
</div>