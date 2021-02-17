<?php

/**
 * This is the model class for table "access".
 *
 * The followings are the available columns in table 'access':
 * @property string $controller
 * @property string $action
 * @property string $name
 * @property integer $group_id
 * @property integer $aggress
 */
class Access extends CActiveRecord
{
	public function getDbConnection()
    {
        //$db = Yii::app()->controller->module->db;
        $db = Yii::app()->getModule('admin')->db;
        return Yii::createComponent($db);
    }

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'access';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('controller, action, name, group_id', 'required'),
			array('group_id, aggress', 'numerical', 'integerOnly'=>true),
			array('controller, action', 'length', 'max'=>32),
			array('name', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('controller, action, name, group_id, aggress', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'controller' => 'Controller',
			'action' => 'Action',
			'name' => 'Name',
			'group_id' => 'Group',
			'aggress' => 'Aggress',
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

		$criteria->compare('controller',$this->controller,true);
		$criteria->compare('action',$this->action,true);
		$criteria->compare('module',$this->module,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('group_id',$this->group_id);
		$criteria->compare('aggress',$this->aggress);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}