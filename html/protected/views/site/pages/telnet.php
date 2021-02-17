<?php

/*Yii::import("ext.telnet", true);

echo CHtml::tag('h1','','Telnet');

$t = $t = new TELNET();
$t->Connect('127.0.0.1:25564', 'root', 'balamut83');
//$t->SendString('root', true);
//$t->SendString('balamut83', true);
//$t->SendString('', true);
//$t->SendString('list', true);
//$data = $t->ReadTo(array('#'));

echo '<pre>'.print_r($data, true).'</pre>';
//echo 'ok' . PHP_EOL;
$t->LogIn();
//echo 'ok' . PHP_EOL;
//$t->GetOutputOf($command);
//$t->GetOutputOf(PHP_EOL);
echo '<pre>'.print_r($t->GetOutputOf('who'), true).'</pre>';*/

$host   = '127.0.0.1';
$port   = '25564';
$user   = 'root';
$pass   = 'balamut83';
$socket = fsockopen($host, $port) or die('Could not connect to: '.$host);
stream_set_blocking($socket, 25);
fputs($socket, $user."\r\n");
//print_r(fgets($socket, 1024));
fputs($socket, $pass."\r\n");
//print_r(fgets($socket, 1024));
fputs($socket, "\r\n");
fputs($socket, "save-all\r\n");
socket_read($socket, 2048);
print_r(fgets($socket, 1024));
socket_close($socket);
/*
// "Endless" loop
while(1)
 {
  while($line = fgets($socket, 1024))
   {
	// Code to deal with the output.
	switch($line)
	 {
	  case 'user:'
	   fputs($socket, $user."\r\n");
	  break;

	  case 'password:'
	   fputs($socket, $pass."\r\n");
	  break;

	 default:
	  // More code..
   }
 }
*/




?>