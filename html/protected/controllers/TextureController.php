<?php

class TextureController extends Controller
{
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	public function accessRules()
	{
		return CMap::mergeArray(
		array(
			array('allow',
				'actions'=>array('index','view','mixer','add','rem','maketexture'),
				'users'=>array('*'),
			),
			array('allow',
				'actions'=>array('adddata'),
				'users'=>array('jday'),
			),

		),
		parent::accessRules()
		);
	}

	public function actionAddData($id = 0) {
		$model = $this->loadModel($id);
		//echo '<pre style="text-align:left;">'.print_r(unserialize(base64_decode($model->info)),true).'</pre>';
		foreach(unserialize(base64_decode($model->info)) as $texture) {
			$path = realpath('').$texture['img'];
			$path_to = realpath('').'/data/textures/'.trim($texture['name']).'.png';
			if(!is_file($path_to)) {
				copy($path,$path_to);
			}
			//echo $path.'--->'.$path_to.'<br>';
		}
		echo 'Ok';
	}

	public function actionIndex($cat = 0, $material = 0)
	{
		$this->layout='column2';

		/*$model=new Texture('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Texture'])) {
            $model->attributes=$_GET['Texture'];
        }

       	if(Yii::app()->request->isAjaxRequest) {
       		echo '<pre>'.print_r($_POST,true).'</pre>';
       		$model->attributes=$_POST['Texture'];
       		$this->renderpartial('index',array(
	            'model'=>$model,
	        ),false,true);
       	} else {
       		$this->render('index',array(
	            'model'=>$model,
	        ));
       	}*/

       	$dataProvider=new CActiveDataProvider('Texture',array(
       		'sort'=>array(
       			'defaultOrder'=>'id desc',
       		),
       		'pagination'=>array(
       			'pageSize'=>60,
                'pageVar'=>'page',
       		)
       	));

      	if(!Yii::app()->request->isAjaxRequest) {
	        $this->render('index',array(
	            'dataProvider'=>$dataProvider,
	        ));
        } else {
        	$this->renderpartial('index',array(
         		'dataProvider'=>$dataProvider,
	        ));
        }

		//if(isset($_POST['ajax'])) {
		//	echo '<pre>'.print_r($_POST,true).'</pre>';
		//	$this->renderpartial('index',array('material'=>intval($material),'cat'=>intval($cat)),false,true);
		//} else {
		//	$this->render('index',array('material'=>intval($material),'cat'=>intval($cat)));
		//}

	}

	public function actionView($id)
	{
		$model = $this->loadModel($id);
		$this->render('view',array('model'=>$model));
	}

	public function actionMixer()
	{
		$this->layout='column2';
		$this->render('mixer');
	}

	public function actionMaketexture($mask = null)
	{
		switch($mask) {
			case 1:
				$m = new Imagick('http://jday.in.ua/img/mask/m1.png');
			break;
			case 2:
				$m = new Imagick('http://jday.in.ua/img/mask/m2.png');
			break;
			case 3:
				$m = new Imagick('http://jday.in.ua/img/mask/m3.png');
			break;
			case 4:
				$m = new Imagick('http://jday.in.ua/img/mask/m4.png');
			break;
			case 5:
				$m = new Imagick('http://jday.in.ua/img/mask/m5.png');
			break;
			case 6:
				$m = new Imagick('http://jday.in.ua/img/mask/m6.png');
			break;
			case 7:
				$m = new Imagick('http://jday.in.ua/img/mask/m7.png');
			break;
			case 8:
				$m = new Imagick('http://jday.in.ua/img/mask/m8.png');
			break;
			case 9:
				$m = new Imagick('http://jday.in.ua/img/mask/m9.png');
			break;
			case 10:
				$m = new Imagick('http://jday.in.ua/img/mask/m10.png');
			break;
			case 11:
				$m = new Imagick('http://jday.in.ua/img/mask/m11.png');
			break;
			case 12:
				$m = new Imagick('http://jday.in.ua/img/mask/m12.png');
			break;
			case 13:
				$m = new Imagick('http://jday.in.ua/img/mask/m13.png');
			break;
			case 14:
				$m = new Imagick('http://jday.in.ua/img/mask/m14.png');
			break;
			case 15:
				$m = new Imagick('http://jday.in.ua/img/mask/m15.png');
			break;
			case 16:
				$m = new Imagick('http://jday.in.ua/img/mask/m16.png');
			break;
			case 17:
				$m = new Imagick('http://jday.in.ua/img/mask/m17.png');
			break;
			case 18:
				$m = new Imagick('http://jday.in.ua/img/mask/m18.png');
			break;
			case 19:
				$m = new Imagick('http://jday.in.ua/img/mask/m19.png');
			break;
			case 20:
				$m = new Imagick('http://jday.in.ua/img/mask/m20.png');
			break;
			case 21:
				$m = new Imagick('http://jday.in.ua/img/mask/m21.png');
			break;
			case 22:
				$m = new Imagick('http://jday.in.ua/img/mask/m22.png');
			break;
			case 23:
				$m = new Imagick('http://jday.in.ua/img/mask/m23.png');
			break;
			default:
				$m = new Imagick('http://jday.in.ua/img/mask/transparent.png');
		}

		if(isset($_POST['t1'])&&isset($_POST['t2'])) {
			$t1 = new Imagick($_POST['t1']);
			$t2 = new Imagick($_POST['t2']);
			$t2->adaptiveResizeImage($t1->getImageWidth(), $t1->getImageHeight(), true);
			$m->adaptiveResizeImage($t1->getImageWidth(), $t1->getImageHeight(), true);

			$i1 = new Imagick();
			$i1->newImage(256, 256, new ImagickPixel('white'));
			$i1->setImageFormat('png');

			$i2 = new Imagick();
			$i2->newImage(256, 256, new ImagickPixel('white'));
			$i2->setImageFormat('png');

			$i1->compositeImage($t2, Imagick::COMPOSITE_DEFAULT, 0, 0);
			$i2->compositeImage($t1, Imagick::COMPOSITE_DEFAULT, 0, 0);
			$i2->compositeImage($m, Imagick::COMPOSITE_COPYOPACITY, 0, 0);
			$i1->compositeImage($i2, imagick::COMPOSITE_DEFAULT, 0, 0);

			//echo '['.$mask.']'.print_r($_POST,true);
			echo '<img src="data:image/png;base64,' . base64_encode($i1) . '" />';
		}
	}

	public function actionAdd($link = null)
	{
		$t = Yii::app()->cache->get('textures');

		if($link!=null) {
			if(!in_array($link,$t)) $t[] = $link;
			sort($t);
			Yii::app()->cache->set('textures',$t);
		}

		echo $this->renderpartial('_textures', array('model'=>$t), true);
	}

	public function actionRem($link = null)
	{
		$t = Yii::app()->cache->get('textures');

		if($link!=null) {

			if(in_array($link,$t)) {
				//print_r($t);
				$t = array_diff($t, array($link));
			}
			//unset($t[$link]);
			sort($t);
			Yii::app()->cache->set('textures',$t);
		}

		echo $this->renderpartial('_textures', array('model'=>$t), true);
	}

	public function loadModel($id)
	{
		$model=Texture::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'Текстура не найдена.');
		return $model;
	}

	public function actionCreate()
	{

		$model = New Texture;
		if($_POST['new'])
		{
			$model->attributes = $_POST['new'];
			$model->info = base64_encode(serialize($_POST['new']));
		}
       //echo '<pre>'.print_r($_POST,true).'</pre>';
		if(isset($_POST['Texture']))
		{
			$materials = false;
			if(isset($_POST['Materials'])) {
				foreach($_POST['Materials'] as $mat) $materials[$mat] = $mat;
				//echo '<pre>'.print_r($materials,true).'</pre>';
			}
			$model->attributes=$_POST['Texture'];
			$model->hash = md5_file(realpath('').$model->filename);
			if($model->save()) {
				$find_link_m = TextureMapLink::model()->findByAttributes(array('texture_id'=>$model->id,'map_id'=>$model->mid));
				if(!$find_link_m) {
					$find_link_m = new TextureMapLink;
					$find_link_m->texture_id =$model->id;
					$find_link_m->map_id = $model->mid;
					$find_link_m->save(false);
				}
				foreach($materials as $mat) {
					$material_new = new TextureMaterialsLink;
					$material_new->texture_id = $model->id;
					$material_new->material_id = $mat;
					$material_new->save(false);
				}
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		//echo '<pre>'.print_r($_POST,true).'</pre>';
		$this->renderpartial('_form',array('model'=>$model));
	}
}