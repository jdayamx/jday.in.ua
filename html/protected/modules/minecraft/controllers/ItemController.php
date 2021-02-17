<?php

class ItemController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new MItem;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['MItem']))
		{
			$model->attributes=$_POST['MItem'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['MItem']))
		{
			$model->attributes=$_POST['MItem'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new MItem('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['MItem']))
			$model->attributes=$_GET['MItem'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=MItem::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='mitem-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionClac($id) {
		$host   = '127.0.0.1';
		$port   = '25564';
		$user   = 'root';
		$pass   = 'balamut83';
		$socket = fsockopen($host, $port) or die('Could not connect to: '.$host);
		stream_set_blocking($socket, 25);
		fputs($socket, $user."\r\n");
		//print_r(fgets($socket, 1024));
		fputs($socket, $pass."\r\n");
		//print_r(fgets($socket, 1024));
		fputs($socket, "\r\n");
		fputs($socket, "price ".$id." 1\r\n");
		//socket_read($socket, 2048);
		for($i=0;$i<=24;$i++) {
			$r = fgets($socket, 256);
		}
		while(preg_match('~RemoteBukkit|CONSOLE~ui',$r)) {
			$r = fgets($socket, 256);
		}
        //echo gettype($socket);
		socket_close($socket);

		//print_r(trim($r));
		$_musor = explode('$',preg_replace('~([^\$^\.^0-9]+)~ui','',trim($r)));
		echo trim(sprintf('%10.2f',$_musor[2]));

	}
}
