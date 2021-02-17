<?php

class AccessController extends Controller
{
	public $layout = "//layouts/column1" ;

	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	public function accessRules()
	{
		return array(
			array('allow',
					'expression'=>'!$user->isGuest && in_array($user->GroupId,array(1))',
			// allow authenticated user to perform 'create' and 'update' actions
				//'actions'=>array('index','view','create','update','delete'),
				//'users'=>array('jday'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex($module='',$controller='',$group = 1)
	{

		//$test = Access::model()->FindAll();

		//Yii::app()->db->createCommand('show create table access')->execute();

		//echo '<pre>'.print_r($test,true).'</pre>';


		if(isset($_POST['Access'])||isset($_POST['yt0'])) {

			foreach(Access::model()->FindAllByAttributes(
				array(
					'module'=>$module,
					'controller'=>$controller,
					'group_id'=>$group,
				)
			) as $ac) $ac->delete(false);
            //$connection = Yii::app()->getModule('admin')->db;
            /*
            $connection = Yii::createComponent($this->module->db);
			$connection->createCommand('
			DELETE FROM access
			WHERE
			module="'.CHtml::encode($module).'"
			AND controller="'.CHtml::encode($controller).'"
			AND group_id="'.CHtml::encode($group).'"
		')->execute();  */
			//echo 'module: '.$module.'<br>';
			//echo 'controller: '.$controller.'<br>';
			//echo 'group: '.$group.'<br>';
			//echo '<pre>'.print_r($_POST['Access'],true).'</pre>';

			foreach($_POST['Access'] as $action=>$aggress) {
				$ac = new Access;
				$ac->module = CHtml::encode($module);
				$ac->controller = CHtml::encode(mb_strtolower($controller));
				$ac->action = mb_strtolower($action);
				$ac->name = ($ac->module?$ac->module.'->':'').CHtml::encode(mb_strtolower($controller)).'->'.mb_strtolower($action);
				$ac->group_id = CHtml::encode($group);
				$ac->aggress = $aggress;
				$ac->save(false);
			}
			$this->redirect(array('/admin/access/index','module'=>CHtml::encode($module),'controller'=>CHtml::encode($controller),'group'=>CHtml::encode($group)));
		}

		$this->render('index',
			array(
				'module'=>$module,
				'controller'=>$controller,
				'group' => $group
			)
		);
	}
}