<style>
   table.zzz {
    table-layout: fixed; /* Фиксированная ширина ячеек */
    width: 100%; /* Ширина таблицы */
     text-align:center;
   }
   .col1 { width: 20px;}
   .coln { width: 60px;}
  </style>
<?php

$item_nalog = 20;

echo '<table class="zzz table-choc border">
<tr class="head">
			<th colspan="8">Налог '.$item_nalog.'%</th>
	</tr>
	<col class="col1">
   <col span="7" class="coln">';

$i = 64;
$i2 = 0.1;
	echo '<tr>
				<td width="30"></td>';
	foreach(array(4648,4649,4650,4651,4652,4653,4654) as $n2=>$item2) {
		echo '<td>'.CHtml::image('/img/minecraft/item/'.$item2.'.png','').'</td>';
	}
	echo '</tr>';
foreach(array(4648,4649,4650,4651,4652,4653,4654) as $n1=>$item1) {
	echo '<tr>
				<td width="30">'.CHtml::image('/img/minecraft/item/'.$item1.'.png','').'</td>';
	foreach(array(4648,4649,4650,4651,4652,4653,4654) as $n2=>$item2) {		$oo = floor(pow(64,($n1+1))/pow(64,($n2+1)));
		$oo_o = floor(pow(64,($n2+1))/pow(64,($n1+1)));
		$oo_nalog_o = floor($oo_o-($oo_o/100*$item_nalog));
		$oo_nalog = floor($oo-($oo/100*$item_nalog));		echo '<td '. ($oo>1?'':($oo_nalog_o>0?'class="row"':'class="yellow"')).'>'. ($oo>1?$oo:($oo_nalog_o>0?$oo_nalog_o:'')).'</td>';	}
	echo '</tr>';/*	echo '<tr>
				<td width="30">'.CHtml::image('/img/minecraft/item/'.$item.'.png','').'</td>
				<td>'.($i).'</td>
				<td>'.($i2).'</td>
				<td>'.($i3).'</td>
				<td>'.($n).'</td>
			</tr>';*/

	//$i = ($n+1)*64;
	//$i2 = pow(64,$n);
	//$i3 = pow(64,$n/2);
}
echo '</table><br>';
echo '<table class="zzz table-choc border">';
echo '<tr class="head">
			<th width="5%">ID</th>
			<th width="40" style="min-width:40px;">'.CHtml::image('/img/minecraft/item/'.$item->id.'.png','').'</th>
			<th width="20%">Название</th>
			<th>Средний % встречаемости на 1 регионе</th>
			<th>Время добычи (сек.)</th>
			<th>Крафт</th>
			<th>Цена<br>Продажа</th>
			<th>Цена<br>Покупка</th>
			<th>За колличество</th>
	</tr>';
foreach(MItemCategory::model()->findAll() as $cat) {	echo '<tr class="head">
			<th colspan="9">'.$cat->name.' (Налог '.$cat->nalog.'%)</th>
		</tr>';
	foreach($cat->items(array('order'=>'id+0')) as $item) {		$cost = $item->CalcCost;
		$cost_nalog = floor($cost-($cost/100*$cat->nalog));		echo '<tr id="item'.$item->id.'">
				<td width="5%">'.$item->id.'</td>
				<td  width="32">'.CHtml::image('/img/minecraft/item/'.$item->id.'.png','').'</td>
				<td>'.$item->name.'<br><small>'.$item->type->name.($item->type->nalog_bye?'<br>налог + '.$item->type->nalog_bye.'%':'').'</small></td>
				<td>'.$item->reg_proc.'</td>
				<td>'.$item->timetoget.'</td>
				<td>'.$item->Craft.'</td>
				<td><span title="Продажа">'.$cost.'</span><br>'.$item->VisualCost.'</td>
				<td><span title="Покупка">'.$cost_nalog.'</span><br>'.$item->getVisualCost($cat->nalog).'</td>

				<td>'.$item->count.'</td>
		</tr>';	}
}
echo '</table>';


//MCraft

?>