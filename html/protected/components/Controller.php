<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to 'column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='column1';
	public $pageKeywords = 'Хостинг, хостинг сайтов, разработка сайтов, разработка приложений, аренда игровых серверов, игровые карты, раскраски для детей, полезные утилиты, iptables generator';
	public $pageDescription = 'Разработка и хостинг сайтов, хостинг игровых серверов';
	public $background = '';
	public $image = 'https://jday.in.ua/img/about_jday_in_ua.png';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	public $left_menu='';
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	public function accessRules()
	{
	/*echo '<pre>';
	print_r(array(
			Yii::app()->user->checkController(),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		));
	    die();*/
		return array(
			Yii::app()->user->checkController(),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function totranslit($str) {

		static $tbl= array(
			'а'=>'a',
			'б'=>'b',
			'в'=>'v', // w
			'г'=>'g',
			'д'=>'d',
			'е'=>'e',
			'ё'=>'jo', // yo - гост
			'є'=>'ye', // je
			'ж'=>'zh',
			'з'=>'z',
			'и'=>'i',
			'й'=>'j',
			'і'=>'i',
			'ї'=>'yi',
			'к'=>'k',
			'л'=>'l',
			'м'=>'m',
			'н'=>'n',
			'о'=>'o',
			'п'=>'p',
			'р'=>'r',
			'с'=>'s',
			'т'=>'t',
			'у'=>'u',
			'ф'=>'f',
			'х'=>'h', // x
			'ц'=>'c',
			'ч'=>'ch',
			'ш'=>'sh',
			'щ'=>'shh',
			'ъ'=>'"',
			'ы'=>"y'",
			'ь'=>"'",
			'э'=>"e", // eh - гост
			'ю'=>"ju", // yu - гост
			'я'=>"ya", // ya - гост ja
		);


		//1 приводим строку к нижнему регистру
		$str = mb_strtolower($str,"UTF-8");
	//	echo $str;
		//2 выполняем транслитерацию
		$str = strtr($str, $tbl);

		//3 удаляем лишние символы
		$str = preg_replace('~[\'`"]~','',$str);

		//4 заменяем все "левые символы"
		$str = preg_replace('~[^a-z0-9]+~','-',$str);

		//5 убираем лишние - вначале и вконце строки
		$str = trim($str,'-');

	    return $str;
	}

	public function add_log($msg = '', $type = 0)
	{
		$log = New Logs;
		$log->type = $type;
		$log->uid = isset(Yii::app()->user->Profile->id)?Yii::app()->user->Profile->id:-1;
		$log->user_group = isset(Yii::app()->user->Profile->group_id)?Yii::app()->user->Profile->group_id:-1;
		$log->username = isset(Yii::app()->user->name)?Yii::app()->user->name:'System';
		$log->ip = $_SERVER['REMOTE_ADDR'];
		$log->text = $msg;
		$log->adddate = date('Y-m-d H:i:s');
		$log->tools = $_SERVER['HTTP_USER_AGENT'];
		$log->save(false);
	}
}