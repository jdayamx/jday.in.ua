<?php
print gearman_version() . "<br>";


$client= new GearmanClient();
$client->addServer('127.0.0.1');

# ������������ ������ ��� �������� ����������
# "sendmail" - ��� ��� ������
# $mail - ��� ������ ������
for ($i=1;$i<=5;$i++) {
	$mail = array( 'to' => 'test@gmail.com', 'subject' => '������'.rand(1,1000), 'body' => '��� �������� ��������� �'.$i, );
	$client->doBackground("sendmail", serialize($mail));
	echo $client->returnCode() . '<br>';
}
echo serialize(array( 'to' => 'test@gmail.com', 'subject' => '������'.rand(1,1000), 'body' => '��� �������� ��������� �', ));
?>