<table class="table-choc border">
<tr>
<td class="header">Карты</td>
</tr>
<tr >
<td class="row" >
<?php

$mm = $model->maps;

if(!$mm) $mm = $model->main->maps;

foreach ($mm as $map)
{
	//print_r($tex);
	echo '<div>'.$map->link.'</div>';
}
?>
</td>
</tr>
</table>