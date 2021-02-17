<?php

class MapsdController extends Controller
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
			/*array(
    	        'COutputCache + view',
	            'duration'=>100,
            	'varyByParam'=>array('id'),
        	),
        	array(
    	        'COutputCache + index',
	            'duration'=>100,
            	'varyByParam'=>array('MapsDownload_page'),
        	),*/
			//'COutputCache',
           // 'duration'=>100,
           // 'varyByParam'=>array('id'),
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return CMap::mergeArray(
		array(
			array('allow',
				'actions'=>array('xml','index','view','UpdateParams','UpdateParams2','Download','AddWad'),
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

		$info = unserialize(base64_decode($model->info));
		//Textures
		foreach($info['Textures'] as $name => $data) {
			preg_match('/src="(.+)" alt/ui',$data['img'], $ret);
			if($ret[1]) {
			//echo '<pre style="text-align:left;">'.print_r($ret[1],true).'</pre>';
				$path = realpath('').$ret[1];
				$path_to = realpath('').'/data/textures/'.trim($name).'.png';
				if(!is_file($path_to)) {
					copy($path,$path_to);
				}
			}
		}
		echo 'Ok';
		/*//echo '<pre style="text-align:left;">'.print_r(unserialize(base64_decode($model->info)),true).'</pre>';
		foreach(unserialize(base64_decode($model->info)) as $texture) {
			$path = realpath('').$texture['img'];
			$path_to = realpath('').'/data/textures/'.trim($texture['name']).'.png';
			if(!is_file($path_to)) {
				copy($path,$path_to);
			}
			//echo $path.'--->'.$path_to.'<br>';
		}
		echo 'Ok';*/
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
		$model=new MapsDownload;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['MapsDownload']))
		{
			$model->attributes=$_POST['MapsDownload'];
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
		// $this->performAjaxValidation($model);

		if(isset($_POST['MapsDownload']))
		{
			$model->attributes=$_POST['MapsDownload'];
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
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex($gamename = '')
	{
		$model=new MapsDownload('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['MapsDownload']))
			$model->attributes=$_GET['MapsDownload'];

		$this->render('index',array(
			'model'=>$model,
		));
		/*
		$criteria=new CDbCriteria;
		$criteria->condition = 'is_download = 1 AND images <> ""'.($gamename?' AND gamename="'.$gamename.'"':'');
		$criteria->order ='id DESC';

		$dataProvider=new CActiveDataProvider('MapsDownload',array(
			'criteria'=>$criteria,
			'pagination'=>array(
   					'pageSize'=>48,
			)
		));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'gamename'=>$gamename
		));*/
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new MapsDownload('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['MapsDownload']))
			$model->attributes=$_GET['MapsDownload'];

		$this->render('admin',array(
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
		$model=MapsDownload::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='maps-download-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    public function actionXml($name='',$id=null) {    	if($id!==null) $model=MapsDownload::model()->findByPk($id);        if($name) $model=MapsDownload::model()->findByAttributes(array('mapname'=>$name));
       	header("Content-Type: text/xml");
        header("Expires: Thu, 19 Feb 1998 13:24:18 GMT");
		header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
		header("Cache-Control: no-cache, must-revalidate");
		header("Cache-Control: post-check=0,pre-check=0");
		header("Cache-Control: max-age=0");
		header("Pragma: no-cache");
		echo "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\"?>";
		echo " <response> ";
        if($model) {			echo '<name>'.$model->mapname.'</name>';
			echo '<gamename>'.$model->gamename.'</gamename>';
			echo '<gamemod>'.$model->gamename.'</gamemod>';

			echo '<links>';
				echo '<link>'.$model->resurce.'</link>';
				echo '<link>'.Yii::app()->createAbsoluteUrl('mapsd/view',array('id'=>$model->id)) .'</link>';
			echo '</links>';
			if($model->images) {				echo '<images>';
				foreach(unserialize(base64_decode($model->images)) as $type=>$imgs) {					echo '<images_'.$type.'>';
						foreach($imgs as $img) {							echo '<img>http://jday.in.ua'.$img.'</img>';						}
					echo '</images_'.$type.'>';				}
				echo '</images>';
			}

			if($model->info) {				echo '<info>';
				foreach(unserialize(base64_decode($model->info)) as $key=>$val) {					if(is_array($val)) {
						echo  '<info_'.$key.'>';
						if(!in_array($key, array('Textures','files'))) {							foreach($val as $k=>$v) {								echo  '<info_'.strip_tags($key).'_'.strip_tags(trim($k)).'>';
								echo  strip_tags($v);
								echo  '</info_'.strip_tags($key).'_'.strip_tags(trim($k)).'>';							}
						} else {							switch($key) {								case 'files':
									foreach($val as $k=>$v) {
										echo '<file>';
										echo  strip_tags($v);
										echo '</file>';
									}
								break;
								case 'Textures':
									foreach($val as $k=>$v) {
										echo '<texture>';
										echo '<size>'.$v['size'].'</size>';
										preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i',$v['img'],$ret);
										if($ret[1])  echo '<img>http://jday.in.ua'.$ret[1].'</img>';

										echo '</texture>';
									}
								break;								default:							}						}
						echo  '</info_'.$key.'>';					} else {						echo  '<info_'.$key.'>';
						echo  strip_tags($val);
						echo  '</info_'.$key.'>';					}				}
				//echo '<pre>'.print_r(unserialize(base64_decode($model->info)),true).'</pre>';
				echo '</info>';
			}
			//echo '<pre>'.print_r($model->info,true).'</pre>';
            echo '<error>0</error>';        } else {        	 echo '<error>1</error>';        }
        echo "</response> ";
        //echo '<pre>'.print_r(unserialize(base64_decode($model->info)),true).'</pre>';    }
 	public function actionUpdateParams2($id) { 		$model = $this->loadModel($id);
 		if($model->info) {
			$this->renderpartial('_params2',array('data'=>unserialize(base64_decode($model->info))));
			Yii::app()->end();
		}
		$bsp2 = Yii::app()->bsp2;
		$na = true;
		if(preg_match('/(.zip)/i',$model->PathFile))
		{
			$na = false;
			$zip = Yii::app()->zip;
			$info = $zip->infosZip($model->PathFile);
		}
		if(preg_match('/\.rar/i',$model->PathFile)) {
			$na = false;
			$rar = Yii::app()->rar;
			$info = $rar->infosRar($model->PathFile);
		}
		$arch_file = '';
		set_time_limit(0);
		$old_mem = ini_get("memory_limit");
		ini_set("memory_limit","768M");

		foreach($info as $file=>$hz)
		{
			if(preg_match('/(.bsp)/i',mb_strtolower($file))) {
				$arch_file = $file;
				break;
			}
		}

		if($na||!$arch_file) {
			echo '<font color="red">Не поддерживается распаковка такого файла</font>';
			Yii::app()->end();
		}

		if($rar) {
			$rar->extractRar ($model->PathFile, realpath('uploads/map/tmp'),array($arch_file));
			$bsp2->Load(realpath('uploads/map/tmp').'/'.$arch_file);
			unlink(realpath('uploads/map/tmp').'/'.$arch_file);
			unset($rar);
		} else {
			$zip->extractZip ($model->PathFile, realpath('uploads/map/tmp'), array($arch_file));
			$bsp2->Load(realpath('uploads/map/tmp').'/'.$arch_file);
			unlink(realpath('uploads/map/tmp').'/'.$arch_file);
			unset($zip);
		}

		$infoBsp['version'] = $bsp2->header->version;
		$infoBsp['nodes'] = $bsp2->header->lumps['LUMP_NODES']->fourCC;
		$infoBsp['faces'] = $bsp2->header->lumps['LUMP_FACES']->fourCC;
		$infoBsp['models'] = $bsp2->header->lumps['LUMP_MODELS']->fourCC;
		$infoBsp['planes'] = $bsp2->header->lumps['LUMP_PLANES']->fourCC;
		$infoBsp['VERTEXES'] = $bsp2->header->lumps['LUMP_VERTEXES']->fourCC;
		$infoBsp['edges'] = $bsp2->header->lumps['LUMP_EDGES']->fourCC;
		$infoBsp['surfEdges'] = $bsp2->header->lumps['LUMP_SURFEDGES']->fourCC;
		$infoBsp['mapversion'] = $bsp2->header->mapRevision;
		$infoBsp['MaxRange'] = 'world_mins: '.$bsp2->header->lumps['LUMP_ENTITIES']->data['worldspawn'][0]['world_mins'].', world_maxs: '.$bsp2->header->lumps['LUMP_ENTITIES']->data['worldspawn'][0]['world_maxs'];
		$infoBsp['skyname'] = $bsp2->header->lumps['LUMP_ENTITIES']->data['worldspawn'][0]['skyname'];
		foreach($bsp2->header->lumps['LUMP_ENTITIES']->data as $eclass=>$ent) {
			$infoBsp['entities'][$eclass] = count($ent);
		}
        if($infoBsp['version']) {
			$model->info = base64_encode(serialize($infoBsp));
			//$model->mid = $id;
			$model->save(false);
		} else {			echo '<font color="red">Не удалось прочитать заголовки</font>';
			Yii::app()->end();		}
		unset($bsp);
		ini_set("memory_limit", $old_mem);
		$this->renderpartial('_params2',array('data'=>unserialize(base64_decode($model->info)))); 	}

	public function actionUpdateParams($id)
	{
		$model = $this->loadModel($id);
		if($model->info) {
			$this->renderpartial('_params',array('data'=>unserialize(base64_decode($model->info))));
			Yii::app()->end();
		}

		//print_r($model->PathFile);

		$bsp = Yii::app()->bsp;
		$na = true;
		if(preg_match('/(.zip)/i',$model->PathFile))
		{
			$na = false;
			$zip = Yii::app()->zip;
			$info = $zip->infosZip($model->PathFile);
		}
		if(preg_match('/\.rar/i',$model->PathFile)) {
			$na = false;
			$rar = Yii::app()->rar;
			$info = $rar->infosRar($model->PathFile);
		}
		$arch_file = '';


		set_time_limit(0);
		$old_mem = ini_get("memory_limit");
		ini_set("memory_limit","768M");

		foreach($info as $file=>$hz)
		{
			if(preg_match('/(.bsp)/i',mb_strtolower($file))) {
				$arch_file = $file;
				break;
			}
		}

		if($na||!$arch_file) {
			echo '<font color="red">Не поддерживается распаковка такого файла</font>';
			Yii::app()->end();
		}

		if($rar) {
			$rar->extractRar ($model->PathFile, realpath('uploads/map/tmp'),array($arch_file));
			$bsp->Load(realpath('uploads/map/tmp').'/'.$arch_file);
			unlink(realpath('uploads/map/tmp').'/'.$arch_file);
			unset($rar);
		} else {
			$zip->extractZip ($model->PathFile, realpath('uploads/map/tmp'), array($arch_file));
			$bsp->Load(realpath('uploads/map/tmp').'/'.$arch_file);
			unlink(realpath('uploads/map/tmp').'/'.$arch_file);
			unset($zip);
		}

		$model->info = $bsp->ShortData;
		//$model->mid = $id;
		$model->save(false);
		unset($bsp);
		ini_set("memory_limit",$old_mem);
		//echo '<pre>'.print_r($bsp->ShortData, true).'</pre>';
		//echo '<pre>'.print_r($bsp->ShortInfo, true).'</pre>';

		///www/csm.my-gs.info/html/share/maps/7bac5828a1f2c9bf06b942a33265e3d4.rar
		$this->renderpartial('_params',array('data'=>unserialize(base64_decode($model->info))));
	}

	public function actionDownload($id)
	{
		$model = $this->loadModel($id);
		if($model) {
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename='.basename($model->PathFile).'');
			header('Content-Transfer-Encoding: binary');
			header('Connection: Keep-Alive');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma: public');
			header('Content-Length: ' . filesize($model->PathFile));
			ob_clean();
			flush();
			readfile($model->PathFile);
			$model->downloads +=1;
			$model->save(false);
			exit;
		}
	}

	public function actionAddWad($id,$name)
	{
		$model = $this->loadModel($id);
		$old_mem = ini_get("memory_limit");
		ini_set("memory_limit","450M");
		switch(CFileHelper::getExtension($model->PathFile))
		{
			case 'rar':
				$rar = Yii::app()->rar;
				$info = $rar->infosRar($model->PathFile);
				$search_file = '';
				foreach ($info as $file=>$tmp) {
					if(preg_match('/'.$name.'/ui',$file)) {
						$search_file = $file;
						break;
					}
				}
				if($search_file) {
					$search_path = realpath('uploads/map/tmp').DIRECTORY_SEPARATOR.$search_file;
					$rar->extractRar ($model->PathFile, realpath('uploads/map/tmp'),array($search_file));
					if(is_file($search_path)) {
						$wad = new hlwad(array('path'=>dirname($search_path).DIRECTORY_SEPARATOR,'file'=>basename($search_path)));
						$texture_data = $wad->ShortData();
						if (count($texture_data))
						{
							$find_texture = Texture::model()->find(array('condition'=>'filename=:fn','params'=>array(':fn'=>basename($search_path))));
							if(!$find_texture) {
								$find_texture = New Texture;
								$find_texture->name = basename($search_path);
								$find_texture->filename = basename($search_path);
								$find_texture->type = 'wad';
								$find_texture->pid = 0;
								$find_texture->mid = $id;
								$find_texture->texture_category_id = 1;
								$find_texture->info = base64_encode(serialize($texture_data));
								$find_texture->save(false);
								echo 'Для просмотра текстур нажмите на '.CHtml::link(basename($search_path),array('texture/view','id'=>$find_texture->id));
								$map_link = TextureMapLink::model()->find(array('condition'=>'map_id=:m AND texture_id=:t','params'=>array(':m'=>$id,':t'=>$find_texture->id)));
								if(!$map_link) {
									$map_link = New TextureMapLink;
									$map_link->map_id = $id;
									$map_link->texture_id = $find_texture->id;
									$map_link->save(false);
								}
							} else {
								$map_link = TextureMapLink::model()->find(array('condition'=>'map_id=:m AND texture_id=:t','params'=>array(':m'=>$id,':t'=>$find_texture->id)));
								if(!$map_link) {
									$map_link = New TextureMapLink;
									$map_link->map_id = $id;
									$map_link->texture_id = $find_texture->id;
									$map_link->save(false);
								}
								echo 'Для просмотра текстур нажмите на '.CHtml::link(basename($search_path),array('texture/view','id'=>$find_texture->id));
							}

						}
						unlink($search_path);
					}
				}
				unset($rar);
			break;
			case 'zip':
				$zip = Yii::app()->zip;
				$info = $zip->infosZip($model->PathFile);
				$search_file = '';
				foreach ($info as $file=>$tmp) {
					if(preg_match('/'.$name.'/ui',$file)) {
						$search_file = $file;
						break;
					}
				}
				if($search_file) {
					$search_path = realpath('uploads/map/tmp').DIRECTORY_SEPARATOR.$search_file;
					//$rar->extractRar ($model->PathFile, realpath('uploads/map/tmp'),array($search_file));
					$zip->extractZip ($model->PathFile, realpath('uploads/map/tmp'),array($search_file));
					if(is_file($search_path)) {
						$wad = new hlwad(array('path'=>dirname($search_path).DIRECTORY_SEPARATOR,'file'=>basename($search_path)));
						$texture_data = $wad->ShortData();
						if (count($texture_data))
						{
							$find_texture = Texture::model()->find(array('condition'=>'filename=:fn','params'=>array(':fn'=>basename($search_path))));
							if(!$find_texture) {
								$find_texture = New Texture;
								$find_texture->filename = basename($search_path);
								$find_texture->type = 'wad';
								$find_texture->mid = $id;
								//$find_texture->info = base64_encode(json_encode($texture_data));
								$find_texture->info = base64_encode(serialize($texture_data));
								$find_texture->save(false);
								$map_link = TextureMapLink::model()->find(array('condition'=>'map_id=:m AND texture_id=:t','params'=>array(':m'=>$id,':t'=>$find_texture->id)));
								if(!$map_link) {
									$map_link = New TextureMapLink;
									$map_link->map_id = $id;
									$map_link->texture_id = $find_texture->id;
									$map_link->save(false);
								}
								echo 'Для просмотра текстур нажмите на '.CHtml::link(basename($search_path),array('texture/view','id'=>$find_texture->id));
							} else {
								$map_link = TextureMapLink::model()->find(array('condition'=>'map_id=:m AND texture_id=:t','params'=>array(':m'=>$id,':t'=>$find_texture->id)));
								if(!$map_link) {
									$map_link = New TextureMapLink;
									$map_link->map_id = $id;
									$map_link->texture_id = $find_texture->id;
									$map_link->save(false);
								}
								echo 'Для просмотра текстур нажмите на '.CHtml::link(basename($search_path),array('texture/view','id'=>$find_texture->id));
							}
						}
						unlink($search_path);
					}
				}
				unset($zip);
			break;
			default:
				echo 'К сожалению мы не смогли ковырнуть файл <b>'.$name.'</b>';
		}
		ini_set("memory_limit",$old_mem);

	}

	public function actionBotConfig($act='')
	{
		switch($act)
		{
			case 'addtoscan':
				if($_POST['dbi'])
				{
					$fids = Yii::app()->db->createCommand('SELECT max(id) as maxid FROM scan_ids WHERE bot_id = 2')->queryAll();
					$old = $fids[0]['maxid'];
					//print_r($fids[0]['maxid']);
					for($i=min(1,intval($_POST['dbi']));$i<=max(1,intval($_POST['dbi']));$i++) {
                        $sql = 'INSERT INTO scan_ids (id, bot_id, state) VALUES ('.($fids[0]['maxid']+$i).', "2", "1");';
                        Yii::app()->db->createCommand($sql)->query();
						//echo $sql.'<br>';
					}
					$fids = Yii::app()->db->createCommand('SELECT max(id) as maxid FROM scan_ids WHERE bot_id = 2')->queryAll();
					echo $old.'-><font color="red">'.$fids[0]['maxid'].'</font>';
				}

				//print_r($_REQUEST);
				//echo '<hr>';
				//print_r($_POST);
				Yii::app()->end();
			break;
			default:                   //                                 Yii::app()->db->createCommand($sql)->query()
			$this->render('botconfig');
		}

	}


}
