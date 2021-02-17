<?php

/**
 * This is the model class for table "s_people".
 *
 * The followings are the available columns in table 's_people':
 * @property string $id
 * @property string $class_id
 * @property string $people_category_id
 * @property string $sex
 * @property string $sname
 * @property string $fname
 * @property string $mname
 * @property string $birthday
 * @property string $address
 * @property string $phones
 * @property string $parents
 */
class SPeople extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SPeople the static model class
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
		return 's_people';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('class_id, people_category_id, sex, sname, fname, mname, birthday, address, phones, parents', 'required'),
			array('class_id, people_category_id, sex', 'length', 'max'=>10),
			array('sname, fname, mname', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, class_id, people_category_id, sex, sname, fname, mname, birthday, address, phones, parents', 'safe', 'on'=>'search'),
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
			'class'=>array(SELF::BELONGS_TO,'SClass','class_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'class_id' => 'Class',
			'people_category_id' => 'People Category',
			'sex' => 'Sex',
			'sname' => 'Sname',
			'fname' => 'Fname',
			'mname' => 'Mname',
			'birthday' => 'Birthday',
			'address' => 'Address',
			'phones' => 'Phones',
			'parents' => 'Parents',
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
		$criteria->compare('class_id',$this->class_id,true);
		$criteria->compare('people_category_id',$this->people_category_id,true);
		$criteria->compare('sex',$this->sex,true);
		$criteria->compare('sname',$this->sname,true);
		$criteria->compare('fname',$this->fname,true);
		$criteria->compare('mname',$this->mname,true);
		$criteria->compare('birthday',$this->birthday,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('phones',$this->phones,true);
		$criteria->compare('parents',$this->parents,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}