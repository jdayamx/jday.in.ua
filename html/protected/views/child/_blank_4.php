<?
$i=0;
foreach($model as $p) {
	echo CHtml::image($p->url,$p->name,array('width'=>'49%'));
	$i++;
	if($i==2) echo '<br>';
}
?>