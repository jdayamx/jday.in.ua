<?php
/******************************************************************************
*                          Компонент DrWeb API 1.0                            *
******************************************************************************/

class DrWebApi extends CComponent{

	public $server_ip;
	public $server_port;
	public $admin_login;
	public $admin_pass;
	public $last_error = '';

	public function init() {
	}
    /*
    Функция для работы с XML
    */
	private function xml_load($url, $params = array()) {
		$parms_tmp_array = array();
		$parms_str = '';
		foreach ($params as $name=>$value)
		{
			if ($value) $parms_tmp_array[]=$name.'='.$value;
		}

		if (count($parms_tmp_array)>0) $parms_str ='?'.implode('&',$parms_tmp_array);
		return simplexml_load_file('http://'.$this->admin_login.':'.$this->admin_pass.'@'.$this->server_ip.':'.$this->server_port.'/'.$url.$parms_str, "SimpleXMLElement",LIBXML_NOCDATA);
	}
    /*
    id - Идентификатор группы. Если id не задан, то возвращается информация о всех группах *
	name - Название группы.
	from = YYYYMMDD или from = YYYYMMDDHHmmSS - Начальная  дата, для которой выбираются статистические данные.
	till = YYYYMMDD или till = YYYYMMDDHHmmSS - Конечная  дата, для которой выбираются статистические данные.
	statistics - Статистические данные группы. Параметр может принимать одно из пяти значений:
		all — вся статистика за период, заданный параметрами from и till (по умолчанию)
		main — только основная статистика
		none — никакой статистики
		stations — статистика только по клиентам (станциям)
		viruses — только  ТОП вирусов
	vircount - Задает количество вирусов в ТОПе  возвращаемых при statistics=all и statistics=viruses. Если statistics=none, то vircount игнорируется.

	Пример:
	$drweb->getGroupInfo(array('name'=>urlencode('AV+AS+PC')));
    */
	public function getGroupInfo($params = array('name'=>'Everyone')) {
        $xml = $this->xml_load('api/2.0/get-group-info.ds', $params);
		if ($xml->groups)
			return $xml->groups;
		else
			return false;
		}
    /*
    Обязательные параметры:
   	id - id пользователя *
	Необязательные:
	диапазон запроса (даты включительно); если не указано from<...>, то с начала; если не указано till<...>, то до конца:
	fromyear=YYYY
	frommonth=MM
	fromday=DD
	tillyear=YYYY
	tillmonth=MM
	tillday=DD
	vircount - запрашиваемое число вирусов в ответе (по умолчанию 10).

	Пример:
	$drweb->getClientStat(array('id'=>'99999'));
    */
	public function getClientStat($params = array()) {
		$xml = $this->xml_load('avdesk/api/get-customer-stat.ds', $params);
		if ($xml->stat)
			return $xml;
		else
			return false;
	}
    /*
    id - ID станции *
	components - on(yes), off(no) По умолчанию off
	installed-components - Установленные компоненты on(yes), off(no) По умолчанию off
	running-components - Запущенные компоненты on(yes), off(no) По умолчанию off
	rights - Права on(yes), off(no) По умолчанию off
	emails - on(yes), off(no) По умолчанию off
	group-membership - on(yes), off(no) По умолчанию off
	extra-info - on(yes), off(no) По умолчанию off
	modules - on(yes), off(no) По умолчанию off
	bases - Антивирусные базы on(yes), off(no) По умолчанию off
	key - Если параметр имеет значение on(yes), то в ответном XML будет содержаться информация о лицензионном ключе данной станции on(yes), off(no) По умолчанию off

	Пример:
	$drweb->getClientInfo(array('id'=>'99999'));
    */
	public function getClientInfo($params = array()) {
		$xml = $this->xml_load('api/3.0/stations/info.ds', $params);
		if (!$xml->error)
			return $xml->stations;
		else
		{
			$this->last_error = $xml->error->message;
			return false;
		}
	}

	/*
	id - Идентификатор станции *
	password - Пароль
	rate - Тарифная группа *
	expires - Срок допуска 0 – не ограниченное, иначе timestamp
	name - Название станции
	description - Описание
	room - Комната
	street - Улица
	city - Город
	floor - Этаж
	province - Область
	department - Отдел
	organization - Организация
	latitude - Широта
	longitude - Долгота
	block-begin - Дата начала блокировки
	block-end - Дата окончания блокировки
	parent-group - Родительская группа
	email - E-mail станции
	group - Группы

	Пример:
	$drweb->clientAdd(array('id'=>'99999','rate'=>'ebe76ffc-69e1-4757-b2b3-41506832bc9b'));
	*/
	public function clientAdd($params = array()) {
		$xml = $this->xml_load('api/3.0/stations/add.ds', $params);
		if (!$xml->error)
			return $xml->stations;
		else
		{
			$this->last_error = $xml->error->message;
			return false;
		}
	}
    /*
    id - Идентификатор станции *

    Пример:
    $drweb->clientDelete(array('id'=>'99999'));
    */
	public function clientDelete($params = array()) {
		$xml = $this->xml_load('api/3.0/stations/delete.ds', $params);
		if (!$xml->error)
			return $xml->stations;
		else
		{
			$this->last_error = $xml->error->message;
			return false;
		}
	}

	// Список всех станций (Клиентов)
	public function getCustomerInfo() {
        $xml = $this->xml_load('/avdesk/api/get-customer-info.ds');
		if ($xml->error)
			return $xml->error;
		else
			return $xml;
		}
}
?>