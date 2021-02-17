<?php

class UserController extends Controller
{
	public $layout = "//layouts/column1" ;

	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}


	public function actionIndex()
	{
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];
		$this->render('index',array('model'=>$model));
	}

	public function actionUpdate($id=0)
	{
		$model = $this->loadModel($id);

		if(isset($_POST['User']))
		{
			//echo '<pre>'.print_r($_POST['User'],true).'</pre>';
			//echo '<pre>'.print_r($_POST['UserData'],true).'</pre>';
			//Yii::app()->end();
			$model->attributes=$_POST['User'];
   			if($model->save()) {
				$this->redirect(array('/admin/user/index'));
			}
			//	$this->redirect(array('admin/AdminServer','user_id'=>$model->user_id));
		}
		$this->render('update',array('model'=>$model));
	}

	public function actionCreate()
	{
		$model = new User;
        $model->SetScenario('create');
		if(isset($_POST['User']))
		{
			//echo '<pre>'.print_r($_POST['User'],true).'</pre>';
			//echo '<pre>'.print_r($_POST['UserData'],true).'</pre>';
			//Yii::app()->end();
			$model->attributes=$_POST['User'];
   			if($model->save()) {
				$this->redirect(array('/admin/user/index'));
			}
			//	$this->redirect(array('admin/AdminServer','user_id'=>$model->user_id));
		}
		$this->render('create',array('model'=>$model));
	}

	 public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
    }

     public function loadModel($id)
    {
        $model=User::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Group $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}