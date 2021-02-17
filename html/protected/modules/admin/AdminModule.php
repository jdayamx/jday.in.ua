<?php

class AdminModule extends CWebModule
{
	public $db;

	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'admin.models.*',
			'admin.components.*',
		));

		$this->db = array(
           		'class'=>'CDbConnection',
           		'connectionString'=>'sqlite:'.dirname(__FILE__).'/data/admin.db',
       	);
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			Yii::app()->theme = 'admin';
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}

	public function getItems() {
    	$panels = array();
    	foreach(Yii::app()->metadata->getModules() as $module) {
    		if(isset(Yii::app()->getModule($module)->Navigation)) {
    			foreach (Yii::app()->getModule($module)->Navigation as $panel) {
    				foreach ($panel['items'] as $item) {
    					$panels[$panel['title']]['title'] = $panel['title'];
    					$panels[$panel['title']]['prio'] = Max($panels[$panel['title']]['prio'],$panel['prio']);
    					$item['label'] = CHtml::image(Yii::app()->theme->baseUrl.'/img/admin/'.$item['icon'].'.png',$item['icon']).'<h3>'.$item['label'].'</h3>'.$item['description'];
    					$panels[$panel['title']]['items'][] = $item;
    				}
    			}

    		}
    	}
    	return array_values($panels);
    }

    public function getDescription()
    {
        return Yii::t('AdminModule.admin', 'Admin Panel module');
    }

    public function getVersion()
    {
        return Yii::t('AdminModule.admin', '1.1');
    }
    public function getName()
    {
        return Yii::t('AdminModule.admin', 'admin');
    }

    public function getNavigation()
    {
        return array(
        	array(
            	'title' => 'Сторонние разделы',
            	'prio'=>50,
            	'items' => array(
            		array(
            			'icon'=>'Mimetypes-text-x-log-icon',
            			'label'=>'Логи',
            			'description'=>'Просмотр логов сайта и серверов',
            			'url'=>'/admin/global/logs',
            		),
            	),
            ),
            array(
            	'title' => 'Настройки скрипта',
            	'items' => array(
            		array(
            			'icon'=>'setup',
            			'label'=>'Настройка системы',
            			'description'=>'Настройка общих параметров скрипта, а также настройка вывода новостей и комментариев, настройка системы безопасности скрипта',
            			'url'=>'/admin/global/settings',
            		),
            		array(
            			'icon'=>'Firewall-icon',
            			'label'=>'Права доступа',
            			'description'=>'Настройка прав доступа на отдельные странички сайта',
            			'url'=>'/admin/access/index',
            		),
            	),
            ),
            array(
            	'title' => 'Управление пользователями',
            	'items' => array(
            		array(
            			'icon'=>'User',
            			'label'=>'Редактирование пользователей',
            			'description'=>'Управление зарегистрированными на сайте пользователями, редактирование их профилей и блокировка аккаунта',
            			'url'=>array('/admin/user/index'),
            		),
            		array(
            			'icon'=>'Group-icon',
            			'label'=>'Настройка групп пользователей',
            			'description'=>'Создание и управление различными группами пользователей на сайте, назначение прав доступа для этих групп',
            			'url'=>array('/admin/group/index'),
            		),
            	),
            ),
           /* array(
            	'title' => 'Утилиты',
            	'items' => array(
            		array(
            			'icon'=>'wmlogo_128',
            			'label'=>'WebMoney',
            			'description'=>'Просмотр логов платежей на сайт',
            			'url'=>'/adm/general/wm',
            		),
            	),
            ), */
        );
    }
}
