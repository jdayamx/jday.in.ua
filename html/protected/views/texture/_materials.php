<table class="table-choc border">
<tr>
<td class="header">Материалы</td>
</tr>
<tr >
<td class="row" >
<?php
foreach ($model as $id=>$m)
{
	//print_r($tex);
	$col = '#555';
	if($material==$m->id) $col = '#F55555';
	echo '<div style="border-bottom:1px dashed '.$col.';color:'.$col.';">'.CHtml::link($m->name,array('texture/index','material'=>$m->id,'cat'=>($cat?$cat:0)),array('style'=>'text-decoration:none;color:'.$col.';')).'<span style="float:right;">'.$m->Count.'<span></div>';
}
?>
</td>
</tr>
</table>