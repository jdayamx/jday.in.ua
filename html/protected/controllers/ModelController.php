<?php

class ModelController extends Controller
{
	public function actionCreate()
	{
		$model=new Files;
		if(isset($_POST['Files'])){
			$model->attributes=$_POST['Files'];

		    $model->model_file=CUploadedFile::getInstance($model,'model_file');
		    if($model->validate()){
		    	if(!is_dir(realpath('uploads/model').DIRECTORY_SEPARATOR.date('Y-m-d'))) {
					//chmod(realpath('uploads/model'),777);
					mkdir(realpath('uploads/model').DIRECTORY_SEPARATOR.date('Y-m-d'));
					mkdir(realpath('uploads/model').DIRECTORY_SEPARATOR.date('Y-m-d').DIRECTORY_SEPARATOR.'img');
				}
		    	$name = trim(str_replace(' ','_',$model->model_file->name));
		    	$path = realpath('uploads/model').DIRECTORY_SEPARATOR.date('Y-m-d').DIRECTORY_SEPARATOR.$name;
		    	$file_size = filesize($path);
		    	$find_mdl = Model3d::model()->findByAttributes(array('hash'=>md5(basename($path).$file_size)));

		        if(!$find_mdl&&$model->model_file->saveAs($path)) {

		        	$mdl = new Model3d;
					$mdl->pid = 0;
					$mdl->map_id  = 0;
					$mdl->category_id = '';
					$mdl->name = basename($path);
					$mdl->filename = $path;
					$mdl->hash = md5(basename($path).$file_size);
					$mdl->info = '';
					$mdl->mode = 0;
					$mdl->created = date('Y-m-d');
					$mdl->downloads = 0;
					$mdl->save(false);
		        	$this->redirect(array('model/view','id'=>$mdl->id));
		        }

		        if($find_mdl) {
		        	$this->redirect(array('model/view','id'=>$find_mdl->id));
		        }
		    }
		}
		$this->render('create',array(
			'model'=> $model,
		));
	}

	public function actionCreatefrommap($id = null, $file = null, $hash = null)
	{
		if($id !== null&&$file !== null&&$hash !== null) {
			$map = MapsDownload::model()->findByPk($id);
		    if($map) {
				//echo $file.' '.$hash.' '.$id;
				$model=MapsDownload::model()->findByPk($id);

				if(preg_match('/(.zip)/i',$model->PathFile))
				{
					$na = false;
					$zip = Yii::app()->zip;
					$zip->extractZip ($model->PathFile, realpath('uploads/map/tmp'), array($file));
					unset($zip);
					//$info = $zip->infosZip($model->PathFile);
				}
				if(preg_match('/\.rar/i',$model->PathFile)) {
					$na = false;
					$rar = Yii::app()->rar;
					$rar->extractRar ($model->PathFile, realpath('uploads/map/tmp'),array($file));
					unset($rar);
					//$info = $rar->infosRar($model->PathFile);
				}

				if(preg_match('/\.7z/i',$model->PathFile)) {
					$na = false;
					$rar = Yii::app()->p7z;
					$rar->extract7z ($model->PathFile, realpath('uploads/map/tmp'),array($file));
					unset($rar);
					//$info = $rar->infosRar($model->PathFile);
				}

				$file_array = explode(DIRECTORY_SEPARATOR,$file);
				$file_s = $file_array[count($file_array)-1];

				if(!is_dir(realpath('uploads/model').DIRECTORY_SEPARATOR.date('Y-m-d'))) {
					//chmod(realpath('uploads/model'),777);
					mkdir(realpath('uploads/model').DIRECTORY_SEPARATOR.date('Y-m-d'));
					mkdir(realpath('uploads/model').DIRECTORY_SEPARATOR.date('Y-m-d').DIRECTORY_SEPARATOR.'img');
				}

				if(is_dir(realpath('uploads/model').DIRECTORY_SEPARATOR.date('Y-m-d'))&&!is_file(realpath('uploads/model').DIRECTORY_SEPARATOR.date('Y-m-d').DIRECTORY_SEPARATOR.$file_s)) {
					copy(realpath('uploads/map/tmp').'/'.$file,realpath('uploads/model').DIRECTORY_SEPARATOR.date('Y-m-d').DIRECTORY_SEPARATOR.$file_s);
					unlink(realpath('uploads/map/tmp').'/'.$file);
				}

				//$mdl = Yii::app()->mdl;

				//$mdl->Load(realpath('uploads/model').DIRECTORY_SEPARATOR.date('Y-m-d').DIRECTORY_SEPARATOR.$file_s);

				$new_model = new Model3d;
				$new_model->filename = realpath('uploads/model').DIRECTORY_SEPARATOR.date('Y-m-d').DIRECTORY_SEPARATOR.$file_s;
				$new_model->name = $file_s;
				$new_model->map_id = $id;
				$new_model->hash = $hash;
				$new_model->created = date('Y-m-d');
				if($new_model->save(false)) {
					echo CHtml::link($file,array('/model/view','id'=>$new_model->id));
				}

				//echo '<pre>'.print_r($new_model->attributes, true).'</pre>';



				/*if($rar) {
			$rar->extractRar ($model->PathFile, realpath('uploads/map/tmp'),array($arch_file));


		} else {
			$zip->extractZip ($model->PathFile, realpath('uploads/map/tmp'), array($arch_file));
			$bsp->Load(realpath('uploads/map/tmp').'/'.$arch_file);
			unlink(realpath('uploads/map/tmp').'/'.$arch_file);
			unset($zip);
		}
                  */

				//echo 'Чёто делаем !!!';

			} else {
				echo 'Нет такой карты!!!';
			}
			Yii::app()->end();
		}
		echo 'Какая-то ошибка!!!';
	}

	public function actionIndex()
	{
		$model=new Model3d('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Model3d']))
            $model->attributes=$_GET['Model3d'];

        $this->render('index',array(
            'model'=>$model,
        ));

		/*$c = array();
		if(Yii::app()->user->id!=1) $c[] = 'mode=1';
		if($category_id!==null) $c[] = 'category_id in (22)';

		//print_r( implode(' AND ',$c)   );
		//Yii::app()->end();
		$dataProvider=new CActiveDataProvider('Model3d',
			array(
				'criteria'=>array(
		    		'condition'=>implode(' AND ',$c),
		    	),
		    	'sort'=>array(
		    		'defaultOrder'=>'id DESC'
		    	),
		    	'pagination'=>array(
		    		'pageSize'=>30,
		    	),
			)
		);
		if(!Yii::app()->request->isAjaxRequest) {
	        $this->render('index',array(
	            'dataProvider'=>$dataProvider,
	            'category_id'=>$category_id,
	        ));
        } else {
        	print_r($category_id);
        	$this->renderpartial('index',array(
            'dataProvider'=>$dataProvider,
            'category_id'=>$category_id,
        ));
        } */
	}

	public function actionDownload($id)
	{
		$model = $this->loadModel($id);
		if($model) {
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename='.basename($model->filename).'');
			header('Content-Transfer-Encoding: binary');
			header('Connection: Keep-Alive');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma: public');
			header('Content-Length: ' . filesize($model->filename));
			ob_clean();
			flush();
			readfile($model->filename);
			$model->downloads +=1;
			$model->save(false);
			exit;
		}
		//echo file_get_contents($model->filename);
	}

	public function actionView($id)
	{
		$model = $this->loadModel($id);  
		
		$files = glob(realpath('uploads/model').DIRECTORY_SEPARATOR.$model->created.DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.$model->id.'_*.png');
		     
		if($files[0]) $this->image = 'https://jday.in.ua'.str_replace(realpath('uploads/model'),'/uploads/model',$files[0]);
		
		$this->pageKeywords = '3D модель '.$model->name.', скачать модель '.$model->name;
		$this->pageTitle= Yii::app()->name . ' - 3D модель '.$model->name;
		$this->pageDescription = 'Скачать 3D модель '.$model->name.' (описание, характеристики, скриншоты)';
		
		/*
		
		$img = array();
		$imgs = '';
		*/
		
		if(!$model->mode) {
			if(isset($_POST['Model3d']))
	        {
	            $model->attributes=$_POST['Model3d'];
	            if($model->validate()) {
		            $model->mode = 1;
		            if($model->save()) {
		                $this->redirect(array('view','id'=>$model->id));
		            }
	            }
	        }
	        switch($model->format) {
	        	case 'stl':
	        		$this->render('view_edit_stl',array('model'=>$model));
	        	break;
				default:
				$this->render('view_edit',array('model'=>$model));
			}
		} else {
			switch($model->format) {
				case 'stl':
	        		$this->render('view_stl',array('model'=>$model));
	        	break;
				default:
					$this->render('view',array('model'=>$model));
			}
		}

	}

	// Uncomment the following methods and override them if needed

	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			//array(
    	     //   'COutputCache + view',
	         //   'duration'=>100,
            //	'varyByParam'=>array('id'),
        	//),
			//'COutputCache',
           // 'duration'=>100,
           // 'varyByParam'=>array('id'),
		);
	}

   /*
	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/

	public function loadModel($id)
	{
		$model=Model3d::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}