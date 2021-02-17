<?php

/**
 * This is the model class for table "model".
 *
 * The followings are the available columns in table 'model':
 * @property string $id
 * @property string $pid
 * @property string $category_id
 * @property string $name
 * @property string $filename
 * @property string $hash
 * @property string $info
 */
class Model3d extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'model';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pid, category_id, name, filename, hash, created', 'required'),
			array('pid, category_id', 'length', 'max'=>10),
			array('mode', 'length', 'max'=>2),
			array('name', 'length', 'max'=>128),
			array('hash', 'length', 'max'=>34),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('info, downloads', 'safe'),
			array('id, pid, category_id, name, filename, hash, info, created, mode', 'safe', 'on'=>'search'),
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
			'Category' => array(self::HAS_ONE, 'ModelCategory', array('id'=>'category_id')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'pid' => 'Pid',
			'category_id' => 'Category',
			'name' => 'Name',
			'filename' => 'Filename',
			'hash' => 'Hash',
			'info' => 'Info',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('pid',$this->pid,true);

		/*
		echo count($this->Category->child);
		if(count($this->Category->child)) {
			$ids = array();
			foreach($this->Category->child as $_ids) $ids[] = $_ids->id;
			$criteria->addCondition('category_id in ('.implode(',',$ids).')');
		} else {
			$criteria->compare('category_id',$this->category_id,true);
		}*/

		$pids = ModelCategory::model()->FindByPk($this->category_id);

  		if(count($pids->child)) {
			$ids = array();
			foreach($pids->child as $_ids) $ids[] = $_ids->id;
			$criteria->addCondition('category_id in ('.implode(',',$ids).')');
		} else {
			$criteria->compare('category_id',$this->category_id,true);
		}

		$criteria->compare('name',$this->name,true);
		$criteria->compare('filename',$this->filename,true);
		$criteria->compare('hash',$this->hash,true);
		$criteria->compare('info',$this->info,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('mode',$this->mode);

		if(Yii::app()->user->id != 1) {
			$criteria->addCondition('mode = 1');
		}


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
		    	'defaultOrder'=>'id DESC'
		    ),
		    'pagination'=>array(
		    	'pageSize'=>44,
		    ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Model the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getLogo() {
		$files = glob(realpath('uploads/model').DIRECTORY_SEPARATOR.$this->created.DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.$this->id.'_*.png');
		foreach($files as $file) {
			$file = str_replace(realpath('uploads/model'),'/uploads/model',$file);
			return CHtml::image($_SERVER["REQUEST_SCHEME"].'://'.$_SERVER["HTTP_HOST"].$file,'screenshot '.$file,array('width'=>172));
		}
		return 'Error LOGO!<br>';
	}

	public function getIcon() {
		$files = glob(realpath('uploads/model').DIRECTORY_SEPARATOR.$this->created.DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.$this->id.'_*.png');
		foreach($files as $file) {
			$file = str_replace(realpath('uploads/model'),'/uploads/model',$file);
			return CHtml::image($_SERVER["REQUEST_SCHEME"].'://'.$_SERVER["HTTP_HOST"].$file,'screenshot '.$file,array('width'=>48,'class'=>'model-icon'));
		}
		return '';
	}

	public function getFormat() {

		$info = pathinfo($this->name);
		$extension = $info['extension'];
		//print_r(pathinfo($this->name));
		return mb_strtolower($extension);
	}
}
