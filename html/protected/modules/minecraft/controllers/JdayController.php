<?php

class JdayController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionSaveAll()
	{
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
		//print_r(fgets($socket, 1024));
		socket_close($socket);
		echo 'Ок';
	}

	public function actionOp()
	{
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
		fputs($socket, "op jday\r\n");
		socket_read($socket, 2048);
		//print_r(fgets($socket, 1024));
		socket_close($socket);
		echo 'Ок';
	}
	public function actionDeOp()
	{
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
		fputs($socket, "deop jday\r\n");
		socket_read($socket, 2048);
		//print_r(fgets($socket, 1024));
		socket_close($socket);
		echo 'Ок';
	}

	public function actionSurvival()
	{
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
		fputs($socket, "gamemode survival jday\r\n");
		socket_read($socket, 2048);
		//print_r(fgets($socket, 1024));
		socket_close($socket);
		echo 'Ок';
	}

	public function actionCreative()
	{
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
		fputs($socket, "gamemode creative jday\r\n");
		socket_read($socket, 2048);
		//print_r(fgets($socket, 1024));
		socket_close($socket);
		echo 'Ок';
	}

	public function actionVanish()
	{
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
		fputs($socket, "give may 1 1\r\n");
		fputs($socket, "msg may Вам выдали &9Камень&r в размере &31&r шт\r\n");
		socket_read($socket, 2048);
		//print_r(fgets($socket, 1024));
		socket_close($socket);
		echo 'Ок';
	}


}