<div style="width:150px;float:left;">
<?php
	foreach($model->studioseq as $id=>$s) $seq[$id] = $s['label'];
	echo CHtml::DropDownList('seq','',$seq,array('style'=>'width:120px;'));
?>
</div>