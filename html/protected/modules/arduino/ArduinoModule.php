<?php

class ArduinoModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'arduino.models.*',
			'arduino.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			$controller->layout = "//layouts/column1";
			//$controller->background = 'background:url("/img/bg_clouds2.png")repeat-x 0 -70px, url("/img/mtop.png")repeat-x 0 90px, url("/img/mbg.png");';
			$controller->background = 'background:#2B3D4F url("/img/arduino/Home-Header-Bg.png")repeat-x;background-origin: top;background-position: top 100%;background-size: 1441px 260px;';

			return true;
		}
		else
			return false;
	}
}
