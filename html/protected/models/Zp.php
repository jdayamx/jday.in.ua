<?php

/**
 * This is the model class for table "zp".
 *
 * The followings are the available columns in table 'zp':
 * @property string $id
 * @property double $summ
 * @property integer $sign
 * @property string $opdate
 * @property string $actul_date
 * @property string $work
 */
class Zp extends CActiveRecord
{
	public $summs;
	public $works;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'zp';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('summ, sign, actual_date', 'required'),
			array('sign', 'numerical', 'integerOnly'=>true),
			array('summ', 'numerical'),
			array('work', 'length', 'max'=>64),
			array('opdate', 'safe'),
			array('id, summ, sign, opdate, actual_date, work', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
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
			'summ' => 'Сумма',
			'sign' => 'Признак',
			'opdate' => 'Дата операции',
			'actual_date' => 'Месяц',
			'work' => 'Работа',
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
	public function search($merge=null)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('summ',$this->summ);
		$criteria->compare('sign',$this->sign);
		$criteria->compare('opdate',$this->opdate,true);
		$criteria->compare('actual_date',$this->actual_date,true);
		$criteria->compare('work',$this->work,true);
        if($merge!==null) $criteria->mergeWith($merge);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Zp the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	//opdate

	protected function beforeSave()
	{
        if($this->isNewRecord) {
            $this->opdate = date('Y-m-d H:i:s');
        }
        return parent::beforeSave();
	}
}
