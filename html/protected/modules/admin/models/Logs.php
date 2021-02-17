<?php

/**
 * This is the model class for table "logs".
 *
 * The followings are the available columns in table 'logs':
 * @property integer $id
 * @property integer $type
 * @property integer $uid
 * @property integer $user_group
 * @property string $username
 * @property string $ip
 * @property string $text
 * @property string $adddate
 */
class Logs extends CActiveRecord
{
	public $groups = array(
		0=>'Общий',
		1=>'Ошибки',
	);
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Logs the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getDbConnection()
    {
        //$db = Yii::app()->controller->module->db;
        $db = Yii::app()->getModule('admin')->db;
        return Yii::createComponent($db);
    }

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'logs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('adddate', 'required'),
			array('type, uid, user_group', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>100),
			array('ip', 'length', 'max'=>15),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, type, uid, user_group, username, ip, text, adddate', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'type' => 'Type',
			'uid' => 'Uid',
			'user_group' => 'User Group',
			'username' => 'Username',
			'ip' => 'Ip',
			'text' => 'Text',
			'adddate' => 'Adddate',
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
		if($_GET['type']) $criteria->addcondition('type='.intval($_GET['type']));
		//$criteria->order = 'id DESC';
		$criteria->compare('id',$this->id);
		$criteria->compare('type',$this->type);
		$criteria->compare('uid',$this->uid);
		$criteria->compare('user_group',$this->user_group);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('adddate',$this->adddate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
    			'defaultOrder'=>'id DESC',
  			),

			'pagination'=>array(
   					'pageSize'=>50,
				  )
		));
	}
}