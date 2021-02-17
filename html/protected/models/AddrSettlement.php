<?php

/**
 * This is the model class for table "addr_settlement".
 *
 * The followings are the available columns in table 'addr_settlement':
 * @property string $id
 * @property string $district_id
 * @property string $name_en
 * @property string $name_ru
 * @property string $name_uk
 * @property string $postal_code
 */
class AddrSettlement extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'addr_settlement';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('district_id, name_en, name_ru, name_uk', 'required'),
			array('district_id', 'length', 'max'=>10),
			array('name_en, name_ru, name_uk', 'length', 'max'=>64),
			array('postal_code', 'length', 'max'=>5),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, district_id, name_en, name_ru, name_uk, postal_code', 'safe', 'on'=>'search'),
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
			'id' => '№',
			'district_id' => 'Связь с районом',
			'name_en' => 'Название (EN)',
			'name_ru' => 'Название (RU)',
			'name_uk' => 'Название (UK)',
			'postal_code' => 'Почтовый индекс',
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
		$criteria->compare('district_id',$this->district_id,true);
		$criteria->compare('name_en',$this->name_en,true);
		$criteria->compare('name_ru',$this->name_ru,true);
		$criteria->compare('name_uk',$this->name_uk,true);
		$criteria->compare('postal_code',$this->postal_code,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AddrSettlement the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
