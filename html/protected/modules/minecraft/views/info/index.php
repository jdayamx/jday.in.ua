<?php

$this->pageTitle=Yii::app()->name . ' - minecraft players info of server jday';
$this->breadcrumbs=array(
    'minecraft'=>array('/minecraft'),
	'info',
);


//$data = file_get_contents('/game/minecraft/kcauldron/1.7.10-1492.155/usercache.json');
$_data = exec('cat /game/minecraft/kcauldron/1.7.10-1492.155/usercache.json');
$data = json_decode($_data);
echo '
<table class="zzz table-choc border">
	<tr class="head">
			<th>Игрок</th>
			<th>Играл на сервере</th>
			<th>test</th>
	</tr>';

//<td><pre>'.print_r($data, true).'</pre></td>
/*
 [2] => stdClass Object
        (
            [name] => jday
            [uuid] => 92b08dc7-2713-3de9-bc39-1a9fc20ce8c1
            [expiresOn] => 2015-09-24 23:44:31 +0300
        )
*/
foreach($data as $user) {
	//$file = '/game/minecraft/kcauldron/1.7.10-1492.155/plugins/Essentials/userdata/'.(string)$user->uuid.'.yml';
	$file = '/game/minecraft/kcauldron/1.7.10-1492.155/world/stats/'.(string)$user->uuid.'.json';
	$_udata = exec(' cat '.$file);
	$udata = json_decode($_udata);
	echo '<tr>
			<td>'.$user->name.'</td>
			<td>'.$user->expiresOn.'</td>
			<td><pre>'.print_r($udata, true).'</pre></td>

	  </tr>';
}

echo '</table>';

?>

