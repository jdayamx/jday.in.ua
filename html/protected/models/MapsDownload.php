<?php

/**
 * This is the model class for table "maps_download".
 *
 * The followings are the available columns in table 'maps_download':
 * @property string $id
 * @property string $resurce
 * @property string $gamename
 * @property string $gamemod
 * @property string $mapname
 * @property string $images
 * @property string $lastupdate
 * @property integer $is_download
 * @property string $filename
 */
class MapsDownload extends CActiveRecord
{
	private $_managment = false;

	public function getManagment()
	{
		if(!$this->_managment) {
			$managment_class = $this->class;
			if($managment_class) {
				Yii::import("application.components.classes.".$managment_class, true);
				$this->_managment = New $managment_class;
				$this->_managment->object = $this;
			}
		}
		return $this->_managment;
	}
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MapsDownload the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'maps_download';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('resurce, gamename, gamemod, mapname, images, lastupdate, is_download, filename', 'required'),
			array('is_download', 'numerical', 'integerOnly'=>true),
			array('resurce, gamename, gamemod, mapname', 'length', 'max'=>64),
			array('filename', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, resurce, gamename, gamemod, mapname, images, lastupdate, is_download, filename, class', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'textures' => array(self::MANY_MANY, 'Texture', 'texture_map_link(map_id, texture_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'resurce' => 'Скачано с сайта',
			'gamename' => 'Игра',
			'gamemod' => 'Модификация',
			'mapname' => 'Название карты',
			'images' => 'Скриншоты',
			'lastupdate' => 'Дата обновления',
			'is_download' => 'Скачан ?',
			'filename' => 'Название файла',
			'class' => 'Обработка классом',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('resurce',$this->resurce,true);
		$criteria->compare('gamename',$this->gamename,true);
		$criteria->compare('gamemod',$this->gamemod,true);
		$criteria->compare('mapname',$this->mapname,true);
		$criteria->compare('images',$this->images,true);
		$criteria->compare('lastupdate',$this->lastupdate,true);
		$criteria->compare('is_download',$this->is_download);
		$criteria->compare('filename',$this->filename,true);
		$criteria->compare('class',$this->class,true);
		$criteria->addCondition('is_download=1');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'id DESC',
			),
			'pagination'=>array(
   					'pageSize'=>60,
			)
		));
	}
	public function getCoverImage()
	{
		$res = unserialize(base64_decode($this->images));
		if(!$res['thmb'][0]) $img = 'Нет<br>изображения';
		return CHtml::link('<div style="width:160px;height:120px;'.($res['thmb'][0]?'background:url('.$res['thmb'][0].') center center;':'').'">'.$img.'</div>',array('/mapsd/view','id'=>$this->id));
		//return '<div style="width:160px;height:120px;">'.CHtml::image($res['thmb'][0],$this->mapname.'_0',array('style'=>'width:160px;border:2px solid #555;')).'</div>';
	}

	public function getFirstImg() {
		$res = unserialize(base64_decode($this->images));
		return $_SERVER["REQUEST_SCHEME"].'://'.$_SERVER["HTTP_HOST"].$res['full'][0];
	}

	public function getScreens()
	{
		$res = unserialize(base64_decode($this->images));
		if(!$res['thmb'][0]) {
			return 'Нет скриншотов';
		} else {
			$ret = '';
			$res['full'] = array_unique($res['full']);
			sort($res['full']);
			foreach($res['thmb'] as $id=>$im) {
				//$ret .= '<div style="width:160px;height:120px;'.($im?'background:url('.$im.') center center;':'').'"></div>';
				$ret .= CHtml::link(CHtml::image($im,$this->mapname,array('title'=>'Скриншот '.$this->mapname.' №'.$id,'class'=>'mbox','style'=>'max-width:160px;max-height:120px;')),$res['full'][$id],array('rel'=>'screen'));
			}
			return $ret;
		}

	}

	public function getSize()
	{
		$ret = 'Нет файла';
		$path_to_file = realpath('').DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'map'.DIRECTORY_SEPARATOR.'file'.DIRECTORY_SEPARATOR.$this->filename;
		if(is_file($path_to_file))
		{
			$size = filesize($path_to_file);
			$units = array(' B', ' KB', ' MB', ' GB', ' TB');
    		for ($i = 0; $size >= 1024 && $i < 4; $i++) $size /= 1024;
	    	$ret = round($size, 2).$units[$i].' (MD5HASH: '.md5_file($path_to_file).')';
		}
		return $ret;
	}

	public function getFileInfo()
	{
		$ret = 'Нет информации';
		$path_to_file = realpath('').DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'map'.DIRECTORY_SEPARATOR.'file'.DIRECTORY_SEPARATOR.$this->filename;
		$path_to_img = realpath('').DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'map'.DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR;
		if(is_file($path_to_file))
		{
			$mkt = false;
			$ext = CFileHelper::getExtension($path_to_file);
			$flist = '';
			switch ($ext) {
				case '7z':
					$mkt = true;
					$p7z = Yii::app()->p7z;
					$info = $p7z->infos7z($path_to_file);
					$flist .= '<tr>';
					$flist .= '<td class="header">Файлы</td><td class="header">Размер</td><td class="header">Дата</td>';
					$flist .= '</tr>';
					foreach ($info as $file=>$data)
					{
						$wad = '';
						$css = 'row';

						if(preg_match('~.+[gfx\/env]+.+[lfLFrtRTdnDNbkBKupUP]{2}\.[TtGgAa]{3}~ui',$file)) {
							$skyBox[] = $file;
							$css = 'yellow';
							//continue;
						}

						if(preg_match('~.+(\.wav|\.mp3)~ui',$file)) {
							$al_find = Audio::model()->findByAttributes(array('hash_link'=>md5($this->id.$file)));
							if(!$al_find) {
								$css = 'green';
								$p7z->extract7z($path_to_file, realpath('uploads/map/tmp'),array($file));
								$tmp_file = realpath('uploads/map/tmp').DIRECTORY_SEPARATOR.$file;
								$hash = md5_file($tmp_file);
								$path_info = pathinfo($tmp_file);
								//$file .= print_r($path_info,true);
								$a_find = Audio::model()->findByAttributes(array('hash'=>$hash));
								if(!$a_find) {
									$date=date('Y-m-d');
									$adir = realpath('uploads/audio');
									if(!is_dir($adir.DIRECTORY_SEPARATOR.$date)) {
										mkdir($adir.DIRECTORY_SEPARATOR.$date);
									}
									$a_find = new Audio;
									$a_find->name =  $path_info['filename'];
									$a_find->link = '/uploads/audio/'.$date.'/'.$path_info['basename'];
									$a_find->date = $date;
									$a_find->format = $path_info['extension'];
									$a_find->hash = $hash;
									$a_find->hash_link = md5($this->id.$file);
									if($a_find->save()) {
										$amlink_find = AudioMapLink::model()->findByAttributes(array('map_id'=>$this->id,'audio_id'=>$a_find->id));
										if(!$amlink_find) {
											$amlink_find = new AudioMapLink;
											$amlink_find->map_id = $this->id;
											$amlink_find->audio_id = $a_find->id;
											$amlink_find->save(false);
										}
									}

								}
								copy($tmp_file,$adir.DIRECTORY_SEPARATOR.$date.DIRECTORY_SEPARATOR.$path_info['basename']);
								unlink($tmp_file);
								$file .='<br><audio src="'.$a_find->link.'" type="audio/x-wav" controls><p>Your browser does not support the audio element </p>source src="'.$a_find->link.'"/></audio>';
							} else {
								$css = 'yellow';
								$file .='<br><audio src="'.$al_find->link.'" type="audio/x-wav" controls><p>Your browser does not support the audio element </p>source src="'.$al_find->link.'"/></audio>';
							}

						}

						if(preg_match('~.+(\.jpg|\.png)~ui',$file)) {
							$ifile = $this->id.DIRECTORY_SEPARATOR.basename($file);
							if(!is_dir($path_to_img.$this->id)) {
								mkdir($path_to_img.$this->id);
							}
							if(!is_file($path_to_img.$ifile)) {
								$p7z->extract7z($path_to_file, realpath('uploads/map/tmp'),array($file));
								copy(realpath('uploads/map/tmp').DIRECTORY_SEPARATOR.$file,$path_to_img.$ifile);
								unlink(realpath('uploads/map/tmp').DIRECTORY_SEPARATOR.$file);
								//$file = $ifile;
							}
							$file = '<a href="/uploads/map/img/'.$ifile.'" rel="gallery"><img src="/uploads/map/img/'.$ifile.'" style="max-width:32px;max-height:32px;"></a> '.$file;
							//$css = 'green';
							//continue;
						}

						if(preg_match('/\.mdl$/ui',mb_strtolower($file))) {
							$css = 'green';
							$file_array = explode(DIRECTORY_SEPARATOR,$file);
							$file_s = $file_array[count($file_array)-1];
							$hash = md5($file_s.$data['NormalSize']);
							$find_model = Model3d::model()->findbyAttributes(array('hash'=>$hash));
							if (!$find_model) {
								$wad = CHtml::ajaxButton('Добавить ', array('model/Createfrommap','id'=>$this->id,'file'=>$file,'hash'=>$hash), array(
					    			'update' => '#wad'.md5($file),
    								'beforeSend' => 'function(){$("#overlay").addClass("loading");}',
					    			'complete' => 'function(){$("#overlay").removeClass("loading");}',
								));
							} else {
								$file = $find_model->Icon.' '.CHtml::link($file,array('model/view','id'=>$find_model->id));
								$css = 'row';
							}


							//print_r(());
						}

						$flist .= '<tr>';
						$flist .= '<td class="'.$css.'" id="wad'.md5($file).'">'.$file.$wad.'</td><td>'.$data['size'].'</td><td>'.$data['date'].'</td>';
						$flist .= '</tr>';
					}
				break;
				case 'zip':
					$mkt = true;
					$zip = Yii::app()->zip;
					$info = $zip->infosZip($path_to_file);
					$flist .= '<tr>';
					$flist .= '<td class="header">Файлы</td><td class="header">Размер исходный</td><td class="header">Размер сжатый</td>';
					$flist .= '</tr>';
					$skyBox = array();
					foreach ($info as $file=>$data)
					{
						$wad = '';
						$css = 'row';

						if(preg_match('~.+[gfx\/env]+.+[lfLFrtRTdnDNbkBKupUP]{2}\.[TtGgAa]{3}~ui',$file)) {
							$skyBox[] = $file;
							$css = 'yellow';
							//continue;
						}

						if(preg_match('~.+(\.wav|\.mp3)~ui',$file)) {
							$al_find = Audio::model()->findByAttributes(array('hash_link'=>md5($this->id.$file)));
							if(!$al_find) {
								$css = 'green';
								$zip->extractZip($path_to_file, realpath('uploads/map/tmp'),array($file));
								$tmp_file = realpath('uploads/map/tmp').DIRECTORY_SEPARATOR.$file;
								$hash = md5_file($tmp_file);
								$path_info = pathinfo($tmp_file);
								//$file .= print_r($path_info,true);
								$a_find = Audio::model()->findByAttributes(array('hash'=>$hash));
								if(!$a_find) {
									$date=date('Y-m-d');
									$adir = realpath('uploads/audio');
									if(!is_dir($adir.DIRECTORY_SEPARATOR.$date)) {
										mkdir($adir.DIRECTORY_SEPARATOR.$date);
									}
									$a_find = new Audio;
									$a_find->name =  $path_info['filename'];
									$a_find->link = '/uploads/audio/'.$date.'/'.$path_info['basename'];
									$a_find->date = $date;
									$a_find->format = $path_info['extension'];
									$a_find->hash = $hash;
									$a_find->hash_link = md5($this->id.$file);
									if($a_find->save()) {
										$amlink_find = AudioMapLink::model()->findByAttributes(array('map_id'=>$this->id,'audio_id'=>$a_find->id));
										if(!$amlink_find) {
											$amlink_find = new AudioMapLink;
											$amlink_find->map_id = $this->id;
											$amlink_find->audio_id = $a_find->id;
											$amlink_find->save(false);
										}
									}

								}
								copy($tmp_file,$adir.DIRECTORY_SEPARATOR.$date.DIRECTORY_SEPARATOR.$path_info['basename']);
								unlink($tmp_file);
								$file .='<br><audio src="'.$a_find->link.'" type="audio/x-wav" controls><p>Your browser does not support the audio element </p>source src="'.$a_find->link.'"/></audio>';
							} else {
								$css = 'yellow';
								$file .='<br><audio src="'.$al_find->link.'" type="audio/x-wav" controls><p>Your browser does not support the audio element </p>source src="'.$al_find->link.'"/></audio>';
							}

						}

						if(preg_match('~.+(\.jpg|\.png)~ui',$file)) {
							$ifile = $this->id.DIRECTORY_SEPARATOR.basename($file);
							if(!is_dir($path_to_img.$this->id)) {
								mkdir($path_to_img.$this->id);
							}
							if(!is_file($path_to_img.$ifile)) {
								$zip->extractZip($path_to_file, realpath('uploads/map/tmp'),array($file));
								copy(realpath('uploads/map/tmp').DIRECTORY_SEPARATOR.$file,$path_to_img.$ifile);
								unlink(realpath('uploads/map/tmp').DIRECTORY_SEPARATOR.$file);
								//$file = $ifile;
							}
							$file = '<a href="/uploads/map/img/'.$ifile.'" rel="gallery"><img src="/uploads/map/img/'.$ifile.'" style="max-width:32px;max-height:32px;"></a> '.$file;
							//$css = 'green';
							//continue;
						}

						if(preg_match('/\.mdl$/ui',mb_strtolower($file))) {
							$css = 'green';
							$file_array = explode(DIRECTORY_SEPARATOR,$file);
							$file_s = $file_array[count($file_array)-1];
							$hash = md5($file_s.$data['NormalSize']);
							$find_model = Model3d::model()->findbyAttributes(array('hash'=>$hash));
							if (!$find_model) {
								$wad = CHtml::ajaxButton('Добавить ', array('model/Createfrommap','id'=>$this->id,'file'=>$file,'hash'=>$hash), array(
					    			'update' => '#wad'.md5($file),
    								'beforeSend' => 'function(){$("#overlay").addClass("loading");}',
					    			'complete' => 'function(){$("#overlay").removeClass("loading");}',
								));
							} else {
								$file = $find_model->Icon.' '.CHtml::link($file,array('model/view','id'=>$find_model->id));
								$css = 'row';
							}


							//print_r(());
						}

						if(preg_match('/\.[wWaAdD]{3}/ui',$file)) {
							$file_array = explode(DIRECTORY_SEPARATOR,$file);
							$file_s = $file_array[count($file_array)-1];
							$find_texture = Texture::model()->find(array('condition'=>'filename=:fn','params'=>array(':fn'=>$file_s)));
							if ($find_texture) {
							if (!count($this->textures)) {

									$wad = CHtml::ajaxButton('обновить ', array('mapsd/AddWad','id'=>$this->id,'name'=>$file_s), array(
						    			'update' => '#wad'.md5($file),
    									'beforeSend' => 'function(){$("#overlay").addClass("loading");}',
						    			'complete' => 'function(){$("#overlay").removeClass("loading");}',
									));
								} else {
									$file = CHtml::link($file,array('texture/view','id'=>$find_texture->id));
								}

							} else {

								$wad = CHtml::ajaxButton('Добавить ', array('mapsd/AddWad','id'=>$this->id,'name'=>$file_s), array(
					    			'update' => '#wad'.md5($file),
    								'beforeSend' => 'function(){$("#overlay").addClass("loading");}',
					    			'complete' => 'function(){$("#overlay").removeClass("loading");}',
								));
							}
						}
						$flist .= '<tr>';
						$flist .= '<td class="'.$css.'" id="wad'.md5($file).'">'.$file.$wad.'</td><td>'.$data['NormalSize'].'</td><td>'.$data['Size'].'</td>';
						$flist .= '</tr>';
					}
                    /*
					if($skyBox) {
							$flist .= '<tr>';
							$flist .= '<td colspan=2 rowspan=7>222</td>';
							$flist .= '</tr>';
						foreach($skyBox as $file) {
							$flist .= '<tr>';
							$flist .= '<td class="row" id="skybox'.md5($file).'">'.$file.'</td>';
							$flist .= '</tr>';
						}
					}  */

					//print_r($info);
				break;
				case 'rar':
					$mkt = true;
					$rar = Yii::app()->rar;
					$info = $rar->infosRar($path_to_file);
					// $ret = '<pre>'.print_r($info, true).'</pre>';
					//$info = $rar->infosRar($path_to_file);
					$flist .= '<tr>';
					$flist .= '<td class="header">Файлы</td><td class="header">Размер исходный</td><td class="header">Размер сжатый</td>';
					$flist .= '</tr>';
					foreach ($info as $file=>$data)
					{
						$wad = '';
						$css = 'row';

						if(preg_match('~.+[gfx\/env]+.+[lfLFrtRTdnDNbkBKupUP]{2}\.[TtGgAa]{3}~ui',$file)) {
							$skyBox[] = $file;
							$css = 'yellow';
							//continue;
						}

						//AudioMapLink

						if(preg_match('~.+(\.wav|\.mp3)~ui',$file)) {
							$al_find = Audio::model()->findByAttributes(array('hash_link'=>md5($this->id.$file)));
							if(!$al_find) {
								$css = 'green';
								$rar->extractRar($path_to_file, realpath('uploads/map/tmp'),array($file));
								$tmp_file = realpath('uploads/map/tmp').DIRECTORY_SEPARATOR.$file;
								$hash = md5_file($tmp_file);
								$path_info = pathinfo($tmp_file);
								//$file .= print_r($path_info,true);
								$a_find = Audio::model()->findByAttributes(array('hash'=>$hash));
								if(!$a_find) {
									$date=date('Y-m-d');
									$adir = realpath('uploads/audio');
									if(!is_dir($adir.DIRECTORY_SEPARATOR.$date)) {
										mkdir($adir.DIRECTORY_SEPARATOR.$date);
									}
									$a_find = new Audio;
									$a_find->name =  $path_info['filename'];
									$a_find->link = '/uploads/audio/'.$date.'/'.$path_info['basename'];
									$a_find->date = $date;
									$a_find->format = $path_info['extension'];
									$a_find->hash = $hash;
									$a_find->hash_link = md5($this->id.$file);
									if($a_find->save()) {
										$amlink_find = AudioMapLink::model()->findByAttributes(array('map_id'=>$this->id,'audio_id'=>$a_find->id));
										if(!$amlink_find) {
											$amlink_find = new AudioMapLink;
											$amlink_find->map_id = $this->id;
											$amlink_find->audio_id = $a_find->id;
											$amlink_find->save(false);
										}
									}

								}
								copy($tmp_file,$adir.DIRECTORY_SEPARATOR.$date.DIRECTORY_SEPARATOR.$path_info['basename']);
								unlink($tmp_file);
								$file .='<br><audio src="'.$a_find->link.'" type="audio/x-wav" controls><p>Your browser does not support the audio element </p>source src="'.$a_find->link.'"/></audio>';
							} else {
								$css = 'yellow';
								$file .='<br><audio src="'.$al_find->link.'" type="audio/x-wav" controls><p>Your browser does not support the audio element </p>source src="'.$al_find->link.'"/></audio>';
							}

						}

						if(preg_match('~.+(\.jpg|\.png)~ui',$file)) {
							$ifile = $this->id.DIRECTORY_SEPARATOR.basename($file);
							if(!is_dir($path_to_img.$this->id)) {
								mkdir($path_to_img.$this->id);
							}
							if(!is_file($path_to_img.$ifile)) {
								$rar->extractRar($path_to_file, realpath('uploads/map/tmp'),array($file));
								copy(realpath('uploads/map/tmp').DIRECTORY_SEPARATOR.$file,$path_to_img.$ifile);
								unlink(realpath('uploads/map/tmp').DIRECTORY_SEPARATOR.$file);
								//$file = $ifile;
							}
							$file = '<a href="/uploads/map/img/'.$ifile.'" rel="gallery"><img src="/uploads/map/img/'.$ifile.'" style="max-width:32px;max-height:32px;"></a> '.$file;
							//$css = 'green';
							//continue;
						}

						if(preg_match('/\.mdl$/ui',mb_strtolower($file))) {
							$css = 'green';
							$file_array = explode(DIRECTORY_SEPARATOR,$file);
							$file_s = $file_array[count($file_array)-1];
							$hash = md5($file_s.$data['NormalSize']);
							$find_model = Model3d::model()->findbyAttributes(array('hash'=>$hash));
							if (!$find_model) {
								$wad = CHtml::ajaxButton('Добавить ', array('model/Createfrommap','id'=>$this->id,'file'=>$file,'hash'=>$hash), array(
					    			'update' => '#wad'.md5($file),
    								'beforeSend' => 'function(){$("#overlay").addClass("loading");}',
					    			'complete' => 'function(){$("#overlay").removeClass("loading");}',
								));
							} else {
								$file = $find_model->Icon.' '.CHtml::link($file,array('model/view','id'=>$find_model->id));
								$css = 'row';
							}


							//print_r(());
						}

						if(preg_match('/\.[wWaAdD]{3}/ui',$file)) {
							$file_array = explode(DIRECTORY_SEPARATOR,$file);
							$file_s = $file_array[count($file_array)-1];
							$find_texture = Texture::model()->find(array('condition'=>'filename=:fn','params'=>array(':fn'=>$file_s)));
							if ($find_texture) {
								if (!count($this->textures)) {
									$wad = CHtml::ajaxButton('Обновить ', array('mapsd/AddWad','id'=>$this->id,'name'=>$file_s), array(
						    			'update' => '#wad'.md5($file),
    									'beforeSend' => 'function(){$("#overlay").addClass("loading");}',
						    			'complete' => 'function(){$("#overlay").removeClass("loading");}',
									));
								} else {
									$file = CHtml::link($file,array('texture/view','id'=>$find_texture->id));
								}
							} else {

								$wad = CHtml::ajaxButton('Добавить ', array('mapsd/AddWad','id'=>$this->id,'name'=>$file_s), array(
					    			'update' => '#wad'.md5($file),
    								'beforeSend' => 'function(){$("#overlay").addClass("loading");}',
					    			'complete' => 'function(){$("#overlay").removeClass("loading");}',
								));
							}
						}
						$flist .= '<tr>';
						$flist .= '<td class="'.$css.'" id="wad'.md5($file).'">'.$file.' '.$wad.'</td><td>'.$data['NormalSize'].'</td><td>'.$data['Size'].'</td>';
						$flist .= '</tr>';
					}

					//print_r($info);
				break;
				default:
				$ret = 'Неизвестный архив <b>'.$ext.'</b>';
			}

			if ($mkt) {
				$ret = '<table>';
				$ret .= '<tr>';
				$ret .= '<td class="header" colspan="3">'.$ext.' Архив</td>';
				$ret .= '</tr>';

				$ret .= '<td class="yellow" colspan="3"></td>';
				$ret .= '</tr>';

				if($flist) $ret .= $flist;
				$ret .= '</table>';
			}

		}
		return $ret;
	}

	public function getPathFile()
	{
		return realpath('').DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'map'.DIRECTORY_SEPARATOR.'file'.DIRECTORY_SEPARATOR.$this->filename;
	}

	public function getDownload_file()
	{
		if (!$this->is_download) return 'Нет файла';
		return CHtml::link($this->mapname,array('mapsd/download','id'=>$this->id)).' (Кол-во зaкачек: '.$this->downloads.')';
	}

	public function getlink()
	{
		return CHtml::link($this->mapname,array('mapsd/view','id'=>$this->id));
	}

}