<?php

class NewsModule extends CWebModule
{
	public $db;

	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'news.models.*',
			'news.components.*',
		));

		$this->db = array(
           		'class'=>'CDbConnection',
           		'connectionString'=>'sqlite:'.dirname(__FILE__).'/data/news.db',
       	);
	}

	public function getName()
    {
        return 'Новости';
    }

    public function getDescription()
    {
        return 'Модуль новостей';
    }

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			Yii::app()->theme = 'admin';
			$controller->layout = "//layouts/column1" ;
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}

	public function getNavigation()
    {
        return array(
            array(
            	'title' => 'Новости',
            	'items' => array(
            		array(
            			'icon'=>'Cabinet-icon',
            			'label'=>'Категории',
            			'description'=>'Группировка новостей по тематикам',
            			'url'=>'/news/category/index',
            		),
            		array(
            			'icon'=>'news-icon',
            			'label'=>'Управление новостями',
            			'description'=>'Управление новостями, редактирование, добавление, удаление',
            			'url'=>'/news/post/index',
            		),
            	),
            ),
        );
    }
}
