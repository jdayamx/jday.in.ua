<?php

class WWWHosting extends CFormModel {
	public $hdd = 50000;
	public $period = 1;
	public $price = 1;
	public $php = 2;
	public $mysql = 0;
	public $mysql_dump = 0;
	public $ftp = 2;
	public $www_dump = 0;
	public $phpmem = 64;
	public function attributeLabels()
	{
		return array(
			'hdd'=>'Пространство на диске:',
			'period'=>'Период оплаты:',
			'php'=>'Использовать PHP:',
			'mysql'=>'Использовать MySQL:',
			'ftp'=>'Доступ по FTP:',
			'mysql_dump'=>'Резервное копирование БД MySQL:',
			'www_dump'=>'Резервное копирование сайта:',
			'phpmem'=>'PHP memory_limit:',
		);
	}
	public function getHdd_values()
	{		$hdd = array();
		$hdd[50000] = 'Miсro 50Мб';
		$hdd[100000] = 'Mini 100Мб';
		$hdd[270000] = 'Easy 270Мб';
		$hdd[620000] = 'Norma 620Мб (CD)';
		$hdd[4300000] = 'Big 4.3Гб (DVD)';
		$hdd[8600000] = 'Extra 8.6Гб (BlueRay)';
		$hdd[20000000] = 'Lab 20Гб';		return $hdd;	}
	public function getPhp_values()
	{
		$ret = array();
		$ret[0] = 'Нет';
		$ret[2] = 'Да';
		return $ret;
	}
    public function getPhpmem_values()
	{
		$ret = array();
		$ret[64] = '64Мб';
		$ret[128] = '128Мб';
		$ret[192] = '192Мб';
		$ret[256] = '256Мб';
		return $ret;
	}
 	public function getMySql_dump_values()
	{
		$ret = array();
		$ret[0] = 'Нет';
		$ret[25] = '1 раз в день';
		$ret[10] = '1 раз в неделю';
		$ret[5] = '1 раз в месяц';
		return $ret;
	}
	public function getWww_dump_values()
	{
		$ret = array();
		$ret[0] = 'Нет';
		$ret[50] = '1 раз в неделю';
		$ret[10] = '1 раз в месяц';
		return $ret;
	}

	public function getMySql_values()
	{
		$ret = array();
		$ret[0] = 'Нет';
		$ret[3] = 'Да';
		return $ret;
	}

	public function rules()
    {
        return array(
            array('hdd','required'),
            array('hdd, period, price, php, mysql, ftp, mysql_dump, www_dump, phpmem','safe'),
        );
    }

	public function getPeriod_values()
	{
		$ret = array();
		$ret[1] = '1 Месяц';
		$ret[2] = '2 Месяца';
		$ret[3] = '3 Месяца';
		$ret[6] = '6 Месяцев';
		$ret[12] = '1 Год';
		$ret[24] = '2 Года';
		$ret[36] = '3 Года';
		return $ret;
	}

	public function Calc()
	{		switch($this->hdd) {			case 100000:
				$hdd =4;
			break;
			case 270000:
				$hdd =6;
			break;
			case 620000:
				$hdd =10;
			break;
			case 4300000:
				$hdd = 20;
			break;
			case 8600000:
				$hdd = 26;
			break;
			case 20000000:
				$hdd = 40;
			break;
			default:
				$hdd =2;		}
		switch($this->phpmem) {
			case 128:
				$phpmem =2;
			break;
			case 192:
				$phpmem =5;
			break;
			case 256:
				$phpmem =10;
			break;
			default:
				$phpmem =0;
		}		$price = 1;
		if (!$this->mysql) $this->mysql_dump = 0;
		if (!$this->php) $phpmem = 0;		$this->price = ($price+$hdd+$this->php+$this->mysql+$this->ftp+$this->mysql_dump+$this->www_dump+$phpmem)*$this->period;	}}

?>