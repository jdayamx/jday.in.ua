 <?


$connection=@ssh2_connect('176.111.63.39', 3395); //game2
//$connection=ssh2_connect('localhost', 22); //www

if (@ssh2_auth_password($connection, 'root', 'LombardPaSS2012')) {
  echo "Аутентификация выполнена!\n";
} else {
  die('Ошибка аутентификации');
}

//$stream = ssh2_exec($connection, 'cat /proc/mdstat');
//$stream = ssh2_exec($connection, 'netstat -nut'); //Список соеденений
$stream = ssh2_exec($connection,// 'netstat -nut'.
	PHP_EOL.
//	'netstat -lantp |awk \'{print $5}\' | awk -F: \'{print $1}\' |sort |uniq -c |sort -rn'.
	PHP_EOL.
	'netstat -lanup |grep 93.126.64.206 |awk \'{print $4}\' |sort'.
	PHP_EOL.
	''
//	'netstat -lantp |awk \'{print $5}\' | awk -F: \'{print $1}\' | sort -u'
//	PHP_EOL.
//	'netstat -nut'
); //Список соеденений

  stream_set_blocking($stream, true);

  // The command may not finish properly if the stream is not read to end
  $output = stream_get_contents($stream);
echo '<pre>'.$output.'</pre>';

//$stream = ssh2_exec($connection, 'cd /usr/local/www/apache22/html/protected'.PHP_EOL.'ls');
//$stream = ssh2_exec($connection, 'cd /usr/local/www/apache22/html'.PHP_EOL.'ls');
  $stream = ssh2_exec($connection, 'mysqldump -B credit -u root --password=UserPaSS2012'.PHP_EOL.'');
  stream_set_blocking($stream, true);

  // The command may not finish properly if the stream is not read to end
  $output = stream_get_contents($stream);

  $file_name = realpath('').'/protected/sql/dmp_db_credit_'.date('ymdHis').'.sql';
  file_put_contents($file_name, $output);

echo '<pre>'.$output.'</pre>';

?>