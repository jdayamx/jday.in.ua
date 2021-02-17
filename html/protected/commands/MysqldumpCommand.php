<?php
class MysqldumpCommand extends CConsoleCommand
{
	public function run() {
		//$old_mem = ini_get("memory_limit");
		//ini_set("memory_limit","1024M");
		//ini_set("max_execution_time", "0");
		$connection=ssh2_connect('176.111.63.39', 3395);
		if (ssh2_auth_password($connection, 'root', 'GlobalPaSS2012')) {
			echo 'Аутентификация выполнена!'.PHP_EOL;
		   // $stream = ssh2_exec($connection, 'mysqldump -B credit -u root --password=UserPaSS2012>/tmp/sqldump'.PHP_EOL.'');
		   ssh2_exec($connection, 'mysqldump -B credit -u root --password=UserPaSS2012>/tmp/sqldump'.PHP_EOL.'');
			//stream_set_blocking($stream, true);
			//$output = stream_get_contents($stream);
	  		$file_name = realpath('').DIRECTORY_SEPARATOR.'sql'.DIRECTORY_SEPARATOR.'dmp_db_credit_'.date('YmdHis').'.sql';
	  		ssh2_scp_recv($connection, '/tmp/sqldump', $file_name);
			//file_put_contents($file_name, $output);
			echo PHP_EOL.$file_name.' - '.round(filesize($file_name)/1000/1000,2).'Mb Файл сохранен'.PHP_EOL;

		} else {
		  echo 'Ошибка аутентификации'.PHP_EOL;
		}
		//ini_set("memory_limit",$old_mem);
	}
}
?>