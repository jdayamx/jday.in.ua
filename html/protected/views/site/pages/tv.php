<?php

$opts = array(
  'http'=>array(
    'method'=>"GET",
    'header'=>"Accept-language: en\r\n" .
              "Cookie: qlqhzyhjljcfffyy=21636d1e642c874112d9674ac8e8b002; udpr=1;\r\n"
  )
);

$context = stream_context_create($opts);

// Open the file using the HTTP headers set above
//$data = file_get_contents('http://93.126.70.154:88/json/epg/nownext?cid=0', false, $context);
$data = file_get_contents('http://root:root@93.126.70.154:88/json/channel/list', false, $context);

$data = json_decode($data);
$path = Yii::getPathOfAlias('webroot');
echo '<table class="table-choc border">';
foreach($data->chnlist as $ch) {	$cname = mb_strtolower(str_replace(' ','_',trim($ch->name)));	$path_icon = $path.DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.'icons'.DIRECTORY_SEPARATOR.'ch'.DIRECTORY_SEPARATOR.$cname.'.jpg';	if(is_file($path_icon)) {		$icon = '<img src="/img/icons/ch/'.$cname.'.jpg" width="40">';	} else {		$icon = '';	}echo '<tr><td width="30">'.$ch->id.'</td><td width="16">'.($ch->encrypt?'<img src="/img/icons/key-icon.png">':'').'</td><td width="40" class="row_in" title="'.$cname.'">'.$icon.'</td><td>'.$ch->name.'</td><td> <img src="/img/icons/Satellite.png"> '.$data->subs->sub_child1[$ch->sub_child_handle[0]]->name.'</td></tr>';}
echo '</table>';
//echo '<pre>'.print_r($data, true).'</pre>';
?>