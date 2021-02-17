<style>
* {
	font-family:Tahoma;
	font-size:15px;
}
table {
	border-collapse:collapse;
}
</style>

<?php

$this->layout = 'clear';
echo '<center><b>Список учнiв 1-Б класу 2017/2018 рр.</b></center>';
echo '<table width="100%" border=1>';
echo '<tr>
			<th width="18">№ з/п</th>
			<th>П.I.Б. учня</th>
			<th width="20%"></th>
			<th width="20%"></th>
			<th width="20%"></th>
		  <tr>';
foreach(SPeople::model()->findAll() as $p) {
	echo '<tr>
			<td align="center">'.sprintf('%02s',($n+=1)).'</td>
			<td>'.$p->sname.' '.$p->fname.' '.$p->mname.'</td>
			<td></td>
			<td></td>
			<td></td>
		  <tr>';
}
echo '<tr>
			<td></td>
			<td><b>Всього:</b></td>
			<td width="20%"></td>
			<td width="20%"></td>
			<td width="20%"></td>
		  <tr>';
echo '</table>';
?>
