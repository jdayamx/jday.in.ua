<?php
print gearman_version() . "<br>";


$client= new GearmanClient();
$client->addServer('127.0.0.1');

# Регистрируем задачу для фонового выполнения
# "sendmail" - это тип задачи
# $mail - это данные письма
for ($i=1;$i<=5;$i++) {
	$mail = array( 'to' => 'test@gmail.com', 'subject' => 'Привет'.rand(1,1000), 'body' => 'Это тестовое сообщение №'.$i, );
	$client->doBackground("sendmail", serialize($mail));
	echo $client->returnCode() . '<br>';
}
echo serialize(array( 'to' => 'test@gmail.com', 'subject' => 'Привет'.rand(1,1000), 'body' => 'Это тестовое сообщение №', ));
?>