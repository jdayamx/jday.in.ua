<div style="width:150px;float:left;">
<?php
	foreach($model->textureInfos as $t) $textures[$i+=1] = $t->name;
	echo CHtml::DropDownList('skin','',$textures,array('style'=>'width:120px;','empty'=>'-- Выберите --'));
?>
</div>
<div style="width:150px;float:left;">
<?php echo CHtml::link('&nbsp;&nbsp;Export&nbsp;&nbsp;','#',array('class'=>'btn'));?>
</div>