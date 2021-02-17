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
class ForumEmail extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Access the static model class
	 */
	public function getDbConnection()
    {
        $db = Yii::app()->controller->module->db;
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
		return 'forum_email';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, template', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('name, template', 'safe', 'on'=>'search'),
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
			'name' => 'Название',
			'template' => 'Шаблон',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;
		$criteria->compare('name',$this->name,true);
		$criteria->compare('template',$this->template,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}