<?php

class GlobalController extends Controller
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
		$this->actionMenu();
	}

	public function actionMenu()
	{
		$items = $this->module->items;
		$sort = new CSort;
		$sort->defaultOrder = 'prio ASC';
		$sort->attributes = array(
					'prio'=>array(
                        'label'=>'приоритеу',
                        'asc'=>'prio ASC',
                        'desc'=>'prio DESC',
                        'default'=>'desc',
                    ),
                    'title'=>array(
                        'label'=>'названию',
                        'asc'=>'title ASC',
                        'desc'=>'title DESC',
                        'default'=>'desc',
                    ),
                    'description'=>array(
                        'asc'=>'description ASC',
                        'desc'=>'description DESC',
                        'default'=>'desc',
                        'label'=>'описанию',
                    ),
                );


		$dataProvider = new CArrayDataProvider($items, array(
		        'keyField'   => 'id',
		        'pagination' => array(
		                'pageSize'=>10,
		        ),
		        'sort' => $sort));

		$this->render('menu',array(
			'dataProvider'=>$dataProvider
		));
	}

	public function actionSettings() {
		if(isset($_POST['setup'])) {
			Yii::app()->settings->set('setup', $_POST['setup']);
			$this->add_log('Сохранены настройки системы');
			$this->refresh();
		}
		$this->render('settings');
	}


	public function actionLogs() {
    	$model=new Logs('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Logs']))
            $model->attributes=$_GET['Logs'];

        $this->render('logs',array(
            'model'=>$model,
        ));
    }

}