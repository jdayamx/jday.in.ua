<?php

/**
 * This is the model class for table "dns_domain".
 *
 * The followings are the available columns in table 'dns_domain':
 * @property string $id
 * @property string $name
 * @property string $user_id
 * @property string $master
 * @property string $mail
 * @property string $date_support
 * @property string $template
 *
 * The followings are the available model relations:
 * @property User $user
 */
class DnsDomain extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DnsDomain the static model class
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
		return 'dns_domain';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, mail, date_support', 'required'),
			array('name', 'length', 'max'=>255),
			array('user_id', 'length', 'max'=>10),
			array('master', 'length', 'max'=>15),
			array('mail', 'length', 'max'=>128),
			array('mail','email'),
			array('template', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, user_id, master, mail, date_support, template', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Название домена',
			'user_id' => 'Пользователь',
			'master' => 'Мастер Сервер',
			'mail' => 'Администратор',
			'date_support' => 'Дата окончания',
			'template' => 'Шаблон',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('master',$this->master,true);
		$criteria->compare('mail',$this->mail,true);
		$criteria->compare('date_support',$this->date_support,true);
		$criteria->compare('template',$this->template,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getRowCssClass()
	{
		return '';
	}
}