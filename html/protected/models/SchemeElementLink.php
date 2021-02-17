<?php

/**
 * This is the model class for table "scheme_element_link".
 *
 * The followings are the available columns in table 'scheme_element_link':
 * @property string $id
 * @property string $scheme_id
 * @property string $element_id
 * @property string $number
 * @property string $value
 */
class SchemeElementLink extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SchemeElementLink the static model class
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
		return 'scheme_element_link';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('scheme_id, element_id, element_type_id, number, value', 'required'),
			array('scheme_id, element_id', 'length', 'max'=>10),
			array('number', 'length', 'max'=>5),
			array('value', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, scheme_id, element_id, number, value, element_type_id', 'safe', 'on'=>'search'),
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
			'element' => array(self::BELONGS_TO, 'Element', 'element_id'),
			'type' => array(self::BELONGS_TO, 'ElementType', 'element_type_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'scheme_id' => 'Схема',
			'element_id' => 'Элемент',
			'number' => 'Номер',
			'value' => 'Значение',
			'element_type_id'=>'Тип элемента',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($condition = null)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('scheme_id',$this->scheme_id,true);
		$criteria->compare('element_id',$this->element_id,true);
		$criteria->compare('number',$this->number,true);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('element_type_id',$this->element_type_id);
        if($condition !== null) $criteria->addCondition($condition);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>5000,
			),
		));
	}
}