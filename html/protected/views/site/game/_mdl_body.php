<div style="width:150px;float:left;">
<?php
	preg_match('/\/([a-zA-Z]+)\.mdl/ui',$model->header->name, $name);
	echo CHtml::DropDownList('name','',array($model->header->name=>($name[1]?$name[1]:$model->header->name)),array('style'=>'width:120px;'));
?>
<br><br>
<?php echo CHtml::DropDownList('hz','',array(''=>''),array('style'=>'width:120px;','disabled'=>'disabled'));?>
<br><br>
<?php
	if(!$model->header->numskinfamilies) $model->header->numskinfamilies = 1;
	for($i=1;$i<=$model->header->numskinfamilies;$i++) $skins[$i] = 'Skin '.$i;
	echo CHtml::DropDownList('skin','',$skins,array('style'=>'width:120px;'));
?>
</div>
<div style="width:150px;float:left;">
<?php echo CHtml::DropDownList('model','',array('model'=>'Submodel 1'),array('style'=>'width:120px;'));?>
</div>
<div style="width:160px;float:left;background:#EEE;padding:5px;">
Bones: <?php echo $model->header->numbones;?><br>
Bone Controllers: <?php echo $model->header->numbonecontrollers;?><br>
Hit Boxes: <?php echo $model->header->numhitboxes;?><br>
Sequences: <?php echo $model->header->numseq;?><br>
Sequence Groups: <?php echo $model->header->numseqgroups;?><br>
</div>
<div style="width:160px;float:left;background:#EEE;padding:5px;">
Textures: <?php echo $model->header->numtextures;?><br>
Skin Families: <?php echo $model->header->numskinfamilies;?><br>
Body Parts:  <?php echo $model->header->numbodyparts;?><br>
Attachments:  <?php echo $model->header->numattachments;?><br>
Transitions:  <?php echo $model->header->numtransitions;?><br>
</div>