<?php

$this->layout ='blank';

$data = array();


$data[0]['name'] 		= 'AuthPlugin';
$data[0]['version'] 	= '0.5';
$data[0]['url'] = 'http://files.msocial.in.ua/plugins/AuthPlugin.jar';




echo json_encode($data);
?>