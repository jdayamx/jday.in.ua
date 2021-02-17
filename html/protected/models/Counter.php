<?php

/**
 * This is the model class for table "counter".
 *
 * The followings are the available columns in table 'counter':
 * @property string $date
 * @property string $ip
 * @property string $click
 */
class Counter extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'counter';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date, ip, click', 'required'),
			array('ip', 'length', 'max'=>15),
			array('click', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('date, ip, click', 'safe', 'on'=>'search'),
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
			'date' => 'Date',
			'ip' => 'Ip',
			'click' => 'Click',
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

		$criteria->compare('date',$this->date,true);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('click',$this->click,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Counter the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function getInsert() {
		//Yii::app()->db->createCommand('INSERT IGNORE INTO counter (`date`, `ip`, `click`, `url`) VALUES ("'.date('Y-m-d').'", "'.$_SERVER['REMOTE_ADDR'].'", click + 1, "'.$_SERVER["REQUEST_URI"].'")')->execute();
		$find = Counter::model()->findByAttributes(
			array(
				'date'=>date('Y-m-d'),
				'ip'=>$_SERVER['REMOTE_ADDR'],
				'url'=>$_SERVER['REQUEST_URI']
			)
		);
		if($find) {
			$find->click++;
			$find->save(false);
		} else {
			$cc = new Counter;
			$cc->date = date('Y-m-d');
			$cc->ip = $_SERVER['REMOTE_ADDR'];
			$cc->url = $_SERVER['REQUEST_URI'];
			$cc->click++;
			$cc->save(false);
		}
	}
	//Counter
}
