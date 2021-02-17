<?php

class MarketModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'market.models.*',
			'market.components.*',
		));
	}

	public function getName()
    {
        return Yii::t('MarketModule.market', 'market');
    }

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here     download-box-icon.png
			return true;
		}
		else
			return false;
	}

	public function getNavigation()
    {
        return array(
            array(
            	'title' => 'Утилиты',
            	'items' => array(
            		array(
            			'icon'=>'download-box-icon',
            			'label'=>'Репозиторий',
            			'description'=>'Список всех дополнений и компонентов, и их обновления',
            			'url'=>'/market/list/index',
            		),
            	),
            ),
        );
    }
}
