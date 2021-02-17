<?php

class ForumModule extends CWebModule
{
	public $defaultController='forums';

    public $db;

	public function init()
	{
		$this->setImport(array(
			'forum.models.*',
			'forum.components.*',
		));
		$this->db = array(
           		'class'=>'CDbConnection',
           		'connectionString'=>'sqlite:'.dirname(__FILE__).'/data/forum.db',
       		);
		return parent::init();
	}

	public function getName()
    {
        return Yii::t('ForumModule.forum', 'forum');
    }

    public function getVersion()
    {
        return Yii::t('ForumModule.forum', '1.0');
    }

	public function beforeControllerAction($controller, $action)
	{
		$controller->layout='//layouts/column1';

		if(parent::beforeControllerAction($controller, $action))
		{
			return true;
		}
		else
			return false;
	}
}
