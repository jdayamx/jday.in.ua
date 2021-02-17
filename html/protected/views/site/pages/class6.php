<style>
* {
	font-family:Tahoma;
	font-size:14px;
}
table {
	border-collapse:collapse;
}

@media all {
	.page-break	{ display: none; }
}

@media print {
	.page-break	{ display: block; page-break-before: always; }
}

</style>

<?php

$this->layout = 'clear';
echo '<center><b>Список дiтей, якi навчаються в 1-Б класi гімназії №267 та проживають у мiкрорайонi обслуговування
</b></center>';
echo '<table width="100%" border=1>';
echo '<tr>
			<th width="20%">Адреса</th>
			<th width="30%">ПIБ учня</th>
			<th width="15%">День народження</th>
			<th width="5%">Клас</th>
			<th>ПІБ одного з батьків</th>

		  <tr>';
foreach(SPeople::model()->findAll(array('condition'=>'address like "%Верб% 9%" OR address like "%Трост% 6%"','order'=>'street, build_number, build_letter, flat ASC')) as $p) {
		$par = explode(PHP_EOL,$p->parents);
		$phones = explode(PHP_EOL,$p->phones);
		foreach($phones as $id=>$phone) {
			if(preg_match('~044.~',$phone))unset($phones[$id]);
		}
	echo '<tr>
			<td>'.$p->address.'</td>
			<td>'.$p->sname.' '.$p->fname.' '.$p->mname.'</td>
			<td align="center">'.date('d.m.Y', strtotime($p->birthday)).'</td>
			<td align="center">1Б</td>
			<td>'.$par[count($par)-1].' '.str_replace(' ', '',$phones[count($phones)-1]).'</td>
		  <tr>';
}
echo '</table>';


echo '<div class="page-break"></div><br>';

echo '<center><b>Список дiтей, якi навчаються в 1-Б класi гімназії №267 але не проживають у мiкрорайонi обслуговування
</b></center>';
echo '<table width="100%" border=1>';
echo '<tr>
			<th width="20%">Адреса</th>
			<th width="30%">ПIБ учня</th>
			<th width="15%">День народження</th>
			<th width="5%">Клас</th>
			<th>ПІБ одного з батьків</th>
		  <tr>';
$n=0;
foreach(SPeople::model()->findAll(array('condition'=>'address NOT like "%Верб% 9%" AND address NOT like "%Трост% 6%" AND address NOT like "%Гаш%"','order'=>'street, build_number, build_letter, flat ASC')) as $p) {
		$par = explode(PHP_EOL,$p->parents);
		$phones = explode(PHP_EOL,$p->phones);
		foreach($phones as $id=>$phone) {
			if(preg_match('~044.~',$phone))unset($phones[$id]);
		}
	echo '<tr>
			<td>'.$p->address.'</td>
			<td>'.$p->sname.' '.$p->fname.' '.$p->mname.'</td>
			<td align="center">'.date('d.m.Y', strtotime($p->birthday)).'</td>
			<td align="center">1Б</td>
			<td>'.$par[count($par)-1].' '.str_replace(' ', '',$phones[count($phones)-1]).'</td>
		  <tr>';
}
echo '</table>';

echo '<div class="page-break"></div><br>';

echo '<center><b>Список дiтей, якi навчаються в 1-Б класi гімназії №267 та проживають в iнших районах
</b></center>';
echo '<table width="100%" border=1>';
echo '<tr>
			<th width="20%">Адреса</th>
			<th width="30%">ПIБ. учня</th>
			<th width="15%">День народження</th>
			<th width="5%">Клас</th>
			<th>ПІБ одного з батьків</th>
		  <tr>';
$n=0;
foreach(SPeople::model()->findAll(array('condition'=>'address like "%Гаш%"','order'=>'street, build_number, build_letter, flat ASC')) as $p) {
		$par = explode(PHP_EOL,$p->parents);
		$phones = explode(PHP_EOL,$p->phones);
		foreach($phones as $id=>$phone) {
			if(preg_match('~044.~',$phone))unset($phones[$id]);
		}
	echo '<tr>
			<td>'.$p->address.'</td>
			<td>'.$p->sname.' '.$p->fname.' '.$p->mname.'</td>
			<td align="center">'.date('d.m.Y', strtotime($p->birthday)).'</td>
			<td align="center">1Б</td>
			<td>'.$par[count($par)-1].' '.str_replace(' ', '',$phones[count($phones)-1]).'</td>

		  <tr>';
}
echo '</table>';


/*
echo '<div class="page-break"></div><br>';

echo '<center><b>Список дiтей, якi навчаються в 1-Б класi гімназії №267 та проживають в iнших районах
</b></center>';
echo '<table width="100%" border=1>';
echo '<tr>
			<th width="18">№ з/п</th>
			<th>Адреса</th>
			<th>П.I.Б. учня</th>
			<th>День народження</th>
			<th>П.I.Б. мати</th>
			<th>Телефон (моб.)</th>
		  <tr>';
$n=0;
foreach(SPeople::model()->findAll(array('order'=>'street, build_number, build_letter, flat ASC')) as $p) {

		$par = explode(PHP_EOL,$p->parents);
		$phones = explode(PHP_EOL,$p->phones);

		$address = explode(',', $p->address);
		if(!$p->build_letter) $p->build_letter = preg_replace('~[0-9]~','', $address[1]);
		//$p->save(false);
		foreach($phones as $id=>$phone) {
			if(preg_match('~044.~',$phone))unset($phones[$id]);
		}
	echo '<tr>
			<td align="center">'.sprintf('%02s',($n+=1)).'</td>
			<td><pre>'.print_R($p->attributes, 1).'</pre></td>
			<td>'.$p->sname.' '.$p->fname.' '.$p->mname.'</td>
			<td>'.$p->birthday.'</td>
			<td>'.$par[count($par)-1].'</td>
			<td>'.$phones[count($phones)-1].'</td>
		  <tr>';
}
echo '</table>';
*/
?>
