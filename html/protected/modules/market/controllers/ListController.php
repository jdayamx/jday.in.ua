<?php

class ListController extends Controller
{
	public $layout='//layouts/admin';

	public function accessRules()
	{
		return array(
			array('allow',
					'expression'=>'!$user->isGuest && in_array($user->GroupId,array(1,2))',
			// allow authenticated user to perform 'create' and 'update' actions
				//'actions'=>array('index','view','create','update','delete'),
				//'users'=>array('jday'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex()
	{
		$this->render('index');
	}
}