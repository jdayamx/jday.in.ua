<?php

class Print3dModule extends CWebModule
{
	public $defaultController='dev';
	
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'print3d.models.*',
			'print3d.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
	
	public function getName()
    {
        return '3D Печать';
    }

    public function getVersion()
    {
        return '1.0';
    }
    
}
