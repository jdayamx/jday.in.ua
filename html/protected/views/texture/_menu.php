<script>
function sels(name,col)
{
	document.getElementById('tt_' + name).style.border='2px solid ' + col;
	//document.getElementById('tt_' + name).style.background = col;
}
function zz(id)
{	 $(id).toggle();}
</script>
<table class="table-choc border">
<tr>
<td class="header">Список текстур</td>
</tr>
<tr >
<td class="row" >
<?php
foreach ($model->InfoData as $id=>$tex)
{
	//print_r($tex);
	echo '<div onclick="zz(\'#tt_'.$id.'\' );" onmouseover="sels('.$id.',\'yellow\');this.style.color=\'red\'" onmouseout="sels('.$id.',\'#999\');this.style.color=\'black\'" style="cursor:pointer;border-bottom:1px dashed #999;">'.$tex['name'].'<span style="float:right;">'.$tex['width'].'x'.$tex['height'].'<span></div>';
}
?>
</td>
</tr>
</table>