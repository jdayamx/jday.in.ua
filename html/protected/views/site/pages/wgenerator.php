<?php

$word = 'jday';


$word = mb_strtolower($word);
while (count($words)<pow(2, strlen($word))) {
	$w= '';
	for($i=0;$i<=strlen($word);$i++) {		$r = rand(0,1);
		if($r) {
			$w .= mb_strtoupper($word[$i]).'';
		} else {			$w .= mb_strtolower($word[$i]).'';		}	}
	//$words[$w] = $w;
	$words[$w] = 'INSERT INTO VIP (playerName,IP) VALUES ("'.$w.'","/94.45.64.13");';
}
ksort($words);


echo CHtml::tag('h1','',$word.' ('.Yii::t('','{n} вариант|{n} варианта|{n} вариантов|{n} варианта',count($words)).')');



echo '<pre>'.print_r($words, true).'</pre>';

echo implode('<br>',$words);

?>