<?php

class ModelsController extends Controller
{
	public $layout = "//layouts/column1" ;

	public function actionIndex($brand_id = null)
	{
        $this->render('index',array(
            'brand_id'=>intval($brand_id),
        ));
	}

	public function actionView($id)
	{
		$model = Car::model()->findByPk($id);
        $this->render('view',array(
            'model'=>$model,
        ));
	}

	public function actionUpdate($id)
	{
		$model = Car::model()->findByPk($id);
		if(isset($_POST['Car']))
        {
            $model->attributes=$_POST['Car'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }
        $this->render('update',array(
            'model'=>$model,
        ));
	}
}