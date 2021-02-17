<style>
* {
	font-family: Tahoma;
}
table {
	border:1px solid black;
	border-collapse:collapse;
	width:100%;
}
</style>
<?php
require_once(YiiBase::getPathOfAlias('application.components.simple_html_dom').'.php');
$this->layout = 'list';
echo CHtml::tag('h1',_,'Расписание электричек до калиновки и обратно');

echo '<table>';
echo '<tr>
		<th>[Прямые] Киев - Калиновка</th>
</tr>';

$content1 = false;//Yii::app()->cache->get('content1');
if($content1 === false) {
	$content1 = file_get_html('http://poezdato.net/raspisanie-poezdov/kiev--kalinovka-1/elektrichki/',false, null, -1, -1, true, true, 'utf-8');
	Yii::app()->cache->set('content1', $content1, 60*60*24*7);
}
	foreach($content1->find('table.schedule_table stackable desktop') as $element) {
		foreach($element->find('tr') as $el) {
			foreach($element->find('td') as $el2) {
					$info[] = trim($el2->plaintext);

			}
		}
	}



print_r($el);


echo '</table>';

?>