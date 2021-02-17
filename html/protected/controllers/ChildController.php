<?php

class ChildController extends Controller
{
	public function actionColorings()
	{
		$this->render('colorings');
	}

	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionAjax()
	{
		$page = 'Упс';
		if($_POST['cat']) {
           	switch ($_POST['blank']) {
           		case 2:
           			$blank = '_blank_2';
           			$model = ChildColorings::model()->findAll(array('limit'=>2,'order'=>'RAND()','condition'=>'category_id IN ('.implode(',',array_merge(array_values($_POST['cat']),array(0))).')'));
           			foreach($model as $pid) {
           				$ids[] = $pid->id;
           			}
           		break;
           		case 4:
           			$blank = '_blank_4';
           			$model = ChildColorings::model()->findAll(array('limit'=>4,'order'=>'RAND()','condition'=>'category_id IN ('.implode(',',array_merge(array_values($_POST['cat']),array(0))).')'));
           			foreach($model as $pid) {
           				$ids[] = $pid->id;
           			}
           		break;
           		default:
           			$blank = '_blank_1';
           			$model = ChildColorings::model()->find(array('order'=>'RAND()','condition'=>'category_id IN ('.implode(',',array_merge(array_values($_POST['cat']),array(0))).')'));
           			$ids[] = $model->id;

           	}
			$page = $this->renderpartial($blank,array('model'=>$model),true);
			//$page .= '<pre>'.implode(',',array_values($_POST['cat'])).'</pre>';
			//$page .= '<pre>'.print_r($_POST,true).'</pre>';
		}
		echo json_encode(
			array(
				'page'=>$page,
				'print'=>CHtml::link('&nbsp;&nbsp;Печать&nbsp;&nbsp;',array('child/coloringsprint','blank'=>intval($_POST['blank']),'id'=>implode(',',$ids)),array('id'=>'print','class'=>'bbcode')),
			)
		);
	}

	public function actionColoringsPrint($blank, $id) {
		//echo $id;
		switch ($blank) {
           		case 2:
           			$blank = '_blank_2';
           			$model = ChildColorings::model()->findAll(array('condition'=>'id IN ('.CHtml::encode($id).')'));
           		break;
           		case 4:
           			$blank = '_blank_4';
           			$model = ChildColorings::model()->findAll(array('condition'=>'id IN ('.CHtml::encode($id).')'));
           		break;
           		default:
           			$blank = '_blank_1';
           			$model = ChildColorings::model()->findByPk(intval($id));
        }
  		$this->renderpartial($blank,array('model'=>$model));
	}

	public function actionUpload() {
		$model=new ChildColorings;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['ChildColorings']))
        {
            $model->attributes=$_POST['ChildColorings'];

            if($model->validate()&&$model->url) {
            	$ddd = date('Y-m-d');
            	$p = realpath(Yii::app()->baseUrl).DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'child'.DIRECTORY_SEPARATOR.$ddd;
            	if(!is_dir($p)) mkdir($p);
            	//file_get_contents($model->url);
            	$filename_from_url = parse_url($model->url);
            	//echo '<pre>'.print_r($filename_from_url,true).'</pre>';
				$info = pathinfo($filename_from_url['path']);
				//echo '<pre>'.print_r($info,true).'</pre>';
				$filename = $this->totranslit($model->name).'_'.$info['filename'].'.'.$info['extension'];
				$new_path_file = $p.DIRECTORY_SEPARATOR.$filename;
				$new_url_file = '/uploads/child/'.$ddd.'/'.$filename;
				file_put_contents($new_path_file,file_get_Contents($model->url));
            	$model->url = $new_url_file;
            	if($model->save())
                	$this->redirect(array('colorings'));
            	//echo '<pre>'.print_r($model->attributes,true).'</pre>';
            }
            //if($model->save())
            //    $this->redirect(array('colorings'));
        }

        $this->render('_upload',array(
            'model'=>$model,
        ));
	}

	public function actionSchool($id = 0) {
		if($id) {
			$model = School::model()->findByPk($id);
			$this->render('schcol_detail',array('model'=>$model));
		} else {
			$model=new School('search');
			$model->unsetAttributes();  // clear any default values
			if(isset($_GET['School']))
				$model->attributes=$_GET['School'];
			//$model = Contracts::model()->findAll();
			//$dataProvider=new CActiveDataProvider('Contracts');
			$this->render('school',array(
				'model'=>$model,
				//'dataProvider'=>$dataProvider,
			));
		}
	}

	public function actionSchoolPrint($id = 0) {
		$this->layout='list';

		if($id) {
			$model = School::model()->findByPk($id);
			$this->render('_schcol_detail',array('model'=>$model));
		} else {
			$model=new School('search');
			$model->unsetAttributes();  // clear any default values
			if(isset($_GET['School']))
				$model->attributes=$_GET['School'];
			//$model = Contracts::model()->findAll();
			//$dataProvider=new CActiveDataProvider('Contracts');
			$this->render('_school',array(
				'model'=>$model,
				//'dataProvider'=>$dataProvider,
			));
		}
	}
}