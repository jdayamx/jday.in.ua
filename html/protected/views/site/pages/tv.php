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
foreach($data->chnlist as $ch) {
echo '</table>';
//echo '<pre>'.print_r($data, true).'</pre>';
?>