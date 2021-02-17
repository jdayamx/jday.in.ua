<?php

class SiteController extends Controller
{
	public $layout='column1';
	public $_actions = array('View'=>'Просмотр','Delete'=>'Удаление','DeleteStation'=>'Удаление Станции','Create'=>'Добавление', 'Admin'=>'Управление', 'Index'=>'Главная', 'Update'=>'Редактирование', 'List'=>'Просмотр списка','Company'=>'Список компаний');

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xDDDDDD,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	public function accessRules()
	{
		return CMap::mergeArray(
		array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','login','page','logout','error','captcha'),
				'users'=>array('*'),
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('setlog'),
				'users'=>array('*'),
				'ips'=>array('94.45.64.13','94.244.1.14','94.45.70.90','94.45.70.42','94.45.70.46','94.45.70.72','94.45.70.169','94.45.70.50','94.45.70.154'),
			),
		),
		parent::accessRules()
		);
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	    $this->add_log('<b>Error '.$error['code'].'</b>: ['.($_SERVER["HTTP_REFERER"]?'<font color="blue">'.CHtml::encode($_SERVER["HTTP_REFERER"]).'</font> ---> ':'').'<font color=red>'.Yii::app()->request->url.'</font>] '.$error['message'],4);
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	public function actionAjaxAddr($do = '', $id = null)
	{
		switch($do) {
			case 'dis':
				if($id) {
					$ar['attr'] = 1;
					$ar['val'] = '<option value="">-- населенный пункт --</option>'.PHP_EOL;
					foreach (CHtml::ListData(AddrSettlement::model()->findAll(array('group'=>'name_ru','condition'=>'district_id=:did','params'=>array(':did'=>$id))),'id','name_ru') as $id=>$val) {
						$ar['val'] .= '<option value="'.$id.'">'.$val.'</option>'.PHP_EOL;
					}
				} else {
					$ar['val'] = '<option value="">-- населенный пункт --</option>';
					$ar['attr'] = 0;
				}
			break;
			case 'reg':
				if($id) {
					$ar['attr'] = 1;
					$ar['val'] = '<option value="">-- Выберите область --</option>'.PHP_EOL;
					$ar['val2'] = '<option value="">-- населенный пункт --</option>';
					foreach (CHtml::ListData(AddrDistrict::model()->findAll(array('condition'=>'region_id=:rid','params'=>array(':rid'=>$id))),'id','name_ru') as $id=>$val) {
						$ar['val'] .= '<option value="'.$id.'">'.$val.'</option>'.PHP_EOL;
					}
				} else {
					$ar['val'] = '<option value="">-- Выберите область --</option>';
					$ar['val2'] = '<option value="">-- населенный пункт --</option>';
					$ar['attr'] = 0;
				}
			break;
			default:
			$ar['info'] = 'No results found';
			$ar['get'] = print_r($_GET, true);
		}
		echo json_encode($ar);
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}


	public function actionTest()
	{
		$model = New WWWHosting;
		$model->attributes = $_POST;

		$model->price = $model->price*$model->period;


        $model->calc();
		$ar['price']=$model->price;
		$ar['text'] = print_r($model->attributes,true).'<hr>'.print_r($_POST,true);
		echo json_encode($ar);
	}

	public function actionRegister()
    {
        $model=new User;

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if(isset($_POST['User']))
        {
            $model->attributes=$_POST['User'];
            if($model->save())
                $this->redirect(array('site/profile','name'=>$model->username));
        }

        $this->render('register',array(
            'model'=>$model,
        ));
    }

    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionLostpassword()
	{
		$model=new LostPassword;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='lp-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		//print_r($_POST);
		if(isset($_POST['LostPassword']))
		{
			$model->attributes=$_POST['LostPassword'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->send())
				$this->redirect('login');
		}
		// display the login form
		$this->render('lostpassword',array('model'=>$model));
	}

	public function actionProfile($name)
    {
        $this->render('profile',array(
            'dataProvider'=>$this->loadModel($name),
        ));
    }

    public function loadModel($name)
    {
        $model=User::model()->with(array('group'))->find(array('condition'=>'username="'.$name.'"',));
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }


    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionSitemap()
    {
        $this->renderpartial('sitemap');
    }

    public function actionMakescreenshot()
    {
    	if(isset($_POST)) {
        	//echo base64_decode($_POST['data']);
        	if(isset($_POST['date'])&&isset($_POST['id'])) {
        		file_put_contents(realpath('uploads/model').DIRECTORY_SEPARATOR.$_POST['date'].DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.$_POST['id'].'_'.time().'.png',base64_decode($_POST['data']));
        	}
        	echo '<img src="data:image/png;base64,'.$_POST['data'].'" width="200" style="margin:0;">';
        }
    }

    public function actionSetLog($msg, $logtype=1) {
    	$this->add_log($msg,$logtype);
    }

    public function actionOffice($do='',$date=false,$time=false) {
    	if($date == false) $date = date('Y-m-d');
    	$data = array();
    	$data['path'] = Yii::getPathOfAlias('webroot.uploads.cam');
    	if($ff = glob($data['path'].DIRECTORY_SEPARATOR.'*', GLOB_ONLYDIR)) {

    		foreach($ff as $f) {
    			$info = pathinfo($f);
    			foreach(glob($data['path'].DIRECTORY_SEPARATOR.$info['filename'].DIRECTORY_SEPARATOR.'*', GLOB_ONLYDIR) as $_f) {
    				$_info = pathinfo($_f);
    				$data[$info['filename']]['time'][$_info['filename']] =  $_info['filename'];
    				$data[$info['filename']]['time_current'] =  $_info['filename'];
    			}
    		}
    	}

    	if($time == false) {
    		$time = $data[date('Ymd', strtotime($date))]['time_current'];
    	}

    	switch($do) {
    		case 'convert':
    			$_date = date('Ymd', strtotime($date));
    			$path = $data['path'].DIRECTORY_SEPARATOR.$_date.DIRECTORY_SEPARATOR.$time.DIRECTORY_SEPARATOR;
    			$link =  '/usr/bin/convert '.$path.'*.jpg '.$path.'video.mpg 2>&1';
    			//$link =  '/usr/bin/convert -h';
    			echo exec($link,$err, $errr);
    			echo '<script>location.reload(); </script>';
    		break;
    		default:
    		$this->render('office', array('date'=>$date,'data'=>$data,'time'=>$time));
    	}
    }

    public function actionNote() {
    	if(isset($_POST['msg'])) {
    		Yii::app()->cache->set('msg', $_POST['msg']);
    		Yii::app()->user->setFlash('success',"Сообщение отправлено");
    		$this->refresh();
    	}
    	$this->render('note', array('msg'=>Yii::app()->cache->get('msg')));
    }
}