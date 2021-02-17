<?php

/**
 * This is the model class for table "audio".
 *
 * The followings are the available columns in table 'audio':
 * @property string $id
 * @property string $name
 * @property string $link
 * @property string $date
 * @property string $format
 * @property string $hash
 * @property string $hash_link
 */
class Audio extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'audio';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, link, date, format, hash, hash_link', 'required'),
			array('name', 'length', 'max'=>128),
			array('format', 'length', 'max'=>5),
			array('hash, hash_link', 'length', 'max'=>34),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('type, channels, samplerate, bytespersec, alignment, bits', 'safe'),
			array('id, name, link, date, format, hash, hash_link', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'link' => 'Link',
			'date' => 'Date',
			'format' => 'Format',
			'hash' => 'Hash',
			'hash_link' => 'Hash Link',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('format',$this->format,true);
		$criteria->compare('hash',$this->hash,true);
		$criteria->compare('hash_link',$this->hash_link,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pagesize'=>100,
			),
			'sort'=>array(
				'defaultOrder'=>'id DESC'
			),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Audio the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getName() {
		return wordwrap($this->name, 20, "<br />\n");
	}

	public function getPlayer() {
		return '<audio width="100%" src="'.$this->link.'" type="audio/x-wav" controls><p>Your browser does not support the audio element </p>source src="'.$this->link.'"/></audio>';
	}
}
