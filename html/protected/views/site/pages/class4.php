<style>
* {
	font-family:Tahoma;
	font-size:10px;
}
table {
	border-collapse:collapse;
}
</style>

<?php

$this->layout = 'clear';
echo '<center><b>Список 1-Б класу 2017/2018 рр.</b></center>';
echo '<table width="100%" border=1>';
echo '<tr>
			<th>№ з/п</th>
			<th>П.I.Б. учня</th>
			<th>Дата народження</th>
			<th>Адреса</th>
			<th>Група здоров`я</th>
			<th>Група фiзкульт.</th>
			<th>Проба Руф`є</th>
			<th width="30%">Дiагноз</th>
		  <tr>';
foreach(SPeople::model()->findAll() as $p) {
	echo '<tr>
			<td align="center">'.sprintf('%02s',($n+=1)).'</td>
			<td>'.$p->sname.' '.$p->fname.' '.$p->mname.'</td>
			<td>'.date('d.m.Y',strtotime($p->birthday)).'</td>
			<td>'.$p->address.'</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  <tr>';
}
echo '</table>';
?>
