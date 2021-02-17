<?php

class MinecraftModule extends CWebModule
{
	public $defaultController='items';

	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'minecraft.models.*',
			'minecraft.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			$controller->layout = "//layouts/column1" ;
			$controller->background = 'background:url("/img/bg_clouds2.png")repeat-x 0 -70px, url("/img/mtop.png")repeat-x 0 90px, url("/img/mbg.png");';
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
