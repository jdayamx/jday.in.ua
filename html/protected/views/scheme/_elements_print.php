<style>
	table {
		border-collapse:collapse;
	}
</style>
<pre>
<?php
	$sql = 'SELECT *,CONCAT(element.letter,scheme_element_link.number) as elname, scheme_element_link.element_type_id as `type` FROM scheme_element_link LEFT JOIN element ON element.id = scheme_element_link.element_id WHERE scheme_element_link.scheme_id = "'.$model->id.'" ORDER BY elname, scheme_element_link.value+0';
    $_all_elements = array();
    foreach(Yii::app()->db->createCommand($sql)->queryAll() as $elm) {
		$_all_elements[$elm['name']][$elm['elname'].'|'.$elm['type']] = $elm['value'];
	}
	foreach($_all_elements as $cat=>$elements) {
		$kk = 0;
		foreach($elements as $_el=>$val) {
			list($el, $type) = explode('|', $_el);
			$all_elements[$cat][$val][$type]['count']++;
			$all_elements[$cat][$val][$type]['el'][$kk] = $el;
			if($type>0) $all_elements[$cat][$val][$type]['elt'] = ElementType::model()->findByPk($type)->NameImage;
			$kk++;
		}

	}
	//print_R($all_elements);
	echo '<table width="100%" border=1>';
	foreach($all_elements as $cat=>$elements) {
		echo '<tr style="background:#ddd;"><th colspan="4">'.$cat.'</th></tr>';
		echo '<tr style="background:#eee;"><td>Элемент №</td><td width="10%">Значение</td><td width="15%">Тип</td><td width="10%">Кол-во</td></tr>';
		foreach($elements as $_el=>$_val) {
			foreach($_val as $el=>$val) {
				echo '<tr><td>'.implode(', ',$val['el']).'</td><td>'.$_el.'</td><td>'.$val['elt'].'</td><td>'.$val['count'].'шт</td></tr>';
			}
		}
	}
	echo '</table>';
?>