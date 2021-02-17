<table class="table-choc border">
<tr>
<td class="header">Категории</td>
</tr>
<tr >
<td class="row" >
<?php
foreach ($model as $id=>$cat)
{
	//print_r($tex);
	$col = '#555';
	if($cat==$cat->id) $col = '#F55555';
	echo '<div style="border-bottom:1px dashed '.$col.';color:'.$col.';">'.CHtml::link($cat->name,array('texture/index','cat'=>$cat->id,'material'=>($material?$material:0)),array('style'=>'text-decoration:none;color:'.$col.';')).'<span style="float:right;">'.$cat->Count.'<span></div>';
}
?>
</td>
</tr>
</table>
<br>