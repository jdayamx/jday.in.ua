<?php

/**
 * This is the model class for table "p_category".
 *
 * The followings are the available columns in table 'p_category':
 * @property string $id
 * @property string $pid
 * @property string $name
 * @property string $description
 * @property integer $enabled
 */
class PCategory extends CActiveRecord
{

	public $yesno = array(0=>'Нет', 1=>'Да');

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'p_category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('enabled', 'numerical', 'integerOnly'=>true),
			array('pid', 'length', 'max'=>10),
			array('name', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, pid, name, description, enabled', 'safe', 'on'=>'search'),
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
			'parent' => array(self::BELONGS_TO, 'PCategory', 'pid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'pid' => 'Родитель',
			'name' => 'Наименование',
			'description' => 'Описание',
			'enabled' => 'Отображение',
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
		$criteria->compare('pid',$this->pid,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('enabled',$this->enabled);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>100,
			),
			'sort'=>array(
				'defaultOrder'=>'if(pid>0,pid,id), pid, name',
			),
		));
	}

	public function getTree($id = 0) {
 		$tree = array();
		$cat = PCategory::model()->findAll(array('condition'=>'pid="'.$id.'"','order'=>'name'));
 		foreach($cat as $c) {
                $ptree = $this->getTree($c->id);
         		$tree[$c->id]['text'] = CHtml::link(CHtml::image('/img/icons/task-pencil-icon.png','+'),array('/print3d/category/update','id'=>$c->id)).$c->name.CHtml::link(CHtml::image('/img/icons/bullet-add-icon.png','+'),array('/print3d/category/create','pid'=>$c->id));
         		if (count($ptree)) {
         			$tree[$c->id]['children'] = $ptree;
         		}
 		}

 		return $tree;
	}
}