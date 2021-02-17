<?php

/**
 * This is the model class for table "texture".
 *
 * The followings are the available columns in table 'texture':
 * @property string $id
 * @property string $filename
 * @property string $type
 * @property string $info
 */
class Texture extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Texture the static model class
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
		return 'texture';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pid, name, filename, type', 'required'),
            array('pid,mid', 'numerical', 'integerOnly'=>true),
            array('name', 'length', 'max'=>64),
            array('type', 'length', 'max'=>4),
            array('texture_category_id', 'length', 'max'=>10),
            array('info,mid', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, pid, name, filename, type, texture_category_id, info', 'safe', 'on'=>'search'),
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
			'maps' => array(self::MANY_MANY, 'MapsDownload', 'texture_map_link(texture_id, map_id)'),
			'Category' => array(self::BELONGS_TO, 'TextureCategory', 'texture_category_id'),
			'main' => array(self::BELONGS_TO, 'Texture', array('pid'=>'id')),
			'Materials' => array(self::MANY_MANY, 'TextureMaterials', 'texture_materials_link(texture_id, material_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'pid'=>'Parent',
			'name'=>'Название',
			'filelink' => 'Название',
			'filename' => 'Имя файла',
			'type' => 'Тип',
			'info' => 'Info',
			'texture_category_id' => 'Категория',

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

		$criteria->compare('id',$this->id,true);
        $criteria->compare('pid',$this->pid);
        $criteria->compare('mid',$this->mid);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('filename',$this->filename,true);
        $criteria->compare('hash',$this->hash,true);
        $criteria->compare('type',$this->type,true);

		if(mb_strpos($this->texture_category_id,',')!==false) $this->texture_category_id = explode(',',$this->texture_category_id);
        //if(is_array($this->texture_category_id)) $this->texture_category_id = implode(',',$this->texture_category_id);


        if(is_array($this->texture_category_id)&&count($this->texture_category_id)>0) {
        	$criteria->addcondition('texture_category_id IN ('.implode(',',$this->texture_category_id).')');
        } else {
        	$criteria->compare('texture_category_id',$this->texture_category_id);
        }

        print_R($this->texture_category_id);

        $criteria->compare('info',$this->info,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'id DESC'
			),
			'pagination'=>array(
				'pageSize'=>100,
			),
		));
	}
	public function getFileLink()
	{
		$name = $this->name;
		if(!$this->name) $name = 'Архив';
		return CHtml::link($name,array('texture/view','id'=>$this->id));
	}
	public function getInfoData()
	{
		return unserialize(base64_decode($this->info));
	}

	public function getcount()
	{
		return count($this->InfoData);
	}

	public function getimageid()
	{
	  //Размеры исходного изображения
	  $image = realpath('').$this->filename;
	  $size=getimagesize($image);
     // print_r($size);
	  //Исходное изображение
	  $image=imagecreatefrompng($image);

	  //Маска
	  $zone=imagecreate(20,20);

	  //Копируем изображение в маску
	  imagecopyresized($zone,$image,0,0,0,0,20,20,$size[0],$size[1]);

	  //Будущая маска
	  $colormap=array();

	  //Базовый цвет изображения
	  $average=0;

	  //Результат
	  $result=array();

	   //Заполняем маску и вычисляем базовый цвет
	  for($x=0;$x<20;$x++)
	    for($y=0;$y<20;$y++)
	    {
	      $color=imagecolorat($zone,$x,$y);
	      $color=imagecolorsforindex($zone,$color);

	      //Вычисление яркости было подсказано хабраюзером Ryotsuke
	      $colormap[$x][$y]= 0.212671 * $color['red'] + 0.715160 * $color['green'] + 0.072169 * $color['blue'];

	      $average += $colormap[$x][$y];
	    }

	  //Базовый цвет
	  $average /= 3000;

	  //Генерируем ключ строку
	  for($x=0;$x<20;$x++)
	    for($y=0;$y<20;$y++)
	          $result[]=($x<10?$x:chr($x+97)).($y<10?$y:chr($y+97)).round(2*$colormap[$x][$y]/$average);

	  //Возвращаем ключ
	  return join(' ',$result);
	}

	function imagediff($desc)
	{
	  $image = $this->imageid;
	  //echo $image.'<hr>'.$desc.'<hr><hr>';

	  $image=explode(' ',$image);
	  $desc=explode(' ',$desc);


	  $result=0;

	  foreach($image as $bit) {
	    if(in_array($bit,$desc)) {
	    	$result++;
	    }
	  }
        //echo count($image);
   		$proc = $result/((count($image)+count($desc))/2)*100;
   		$pro = $proc;
   		$pro = '<font color="gray">'.$proc.'</font>';
   		if($proc>40) $pro = '<font color="#ff333D">'.$proc.'</font>';
        if($proc>60) $pro = '<font color="#ff3332">'.$proc.'</font>';
        if($proc>95) $pro = '<font color="#ff3332">'.$proc.'</font>';
	   	return '~'.$pro.'%';
	}
}