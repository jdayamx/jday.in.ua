<?php

class DevController extends Controller
{
	public $layout = "//layouts/column1";
	
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionMy()
	{
		$this->render('my');
	}
}