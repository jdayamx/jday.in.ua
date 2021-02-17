<?php

/**
 * This is the model class for table "car_sale".
 *
 * The followings are the available columns in table 'car_sale':
 * @property string $id
 * @property string $source_id
 * @property string $source_url
 * @property string $title
 * @property string $car_id
 * @property string $from
 * @property integer $cost
 * @property string $currency
 * @property string $img_mini
 * @property string $text
 * @property integer $year
 * @property string $color
 * @property string $mileage
 * @property string $condition
 * @property string $displacement
 * @property string $created
 * @property string $detail
 */
class CarSale extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'car_sale';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('source_id, source_url, title, car_id, from, cost, currency, img_mini, text, year, color, mileage, condition, displacement, created, detail', 'required'),
			array('cost, year', 'numerical', 'integerOnly'=>true),
			array('source_id, car_id', 'length', 'max'=>10),
			array('source_url', 'length', 'max'=>250),
			array('title, from', 'length', 'max'=>128),
			array('currency', 'length', 'max'=>3),
			array('color', 'length', 'max'=>7),
			array('mileage, condition, displacement', 'length', 'max'=>32),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, source_id, source_url, title, car_id, from, cost, currency, img_mini, text, year, color, mileage, condition, displacement, created, detail', 'safe', 'on'=>'search'),
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
			'car' => array(self::BELONGS_TO, 'Car', 'car_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'source_id' => 'ID источника',
			'source_url' => 'Оригинальная ссылка',
			'title' => 'Заголовок',
			'car_id' => 'Car',
			'from' => 'From',
			'cost' => 'Cost',
			'currency' => 'Currency',
			'img_mini' => 'Img Mini',
			'text' => 'Text',
			'year' => 'Year',
			'color' => 'Color',
			'mileage' => 'Mileage',
			'condition' => 'Condition',
			'displacement' => 'Displacement',
			'created' => 'Created',
			'detail' => 'Detail',
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
		$criteria->compare('source_id',$this->source_id,true);
		$criteria->compare('source_url',$this->source_url,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('car_id',$this->car_id,true);
		$criteria->compare('from',$this->from,true);
		$criteria->compare('cost',$this->cost);
		$criteria->compare('currency',$this->currency,true);
		$criteria->compare('img_mini',$this->img_mini,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('year',$this->year);
		$criteria->compare('color',$this->color,true);
		$criteria->compare('mileage',$this->mileage,true);
		$criteria->compare('condition',$this->condition,true);
		$criteria->compare('displacement',$this->displacement,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('detail',$this->detail,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CarSale the static model class
	 */

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getSceenshots() {
		//$this->source_id
		$root_dir = Yii::getPathOfAlias('webroot');
		$db_dir = $root_dir.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'car'.DIRECTORY_SEPARATOR.mb_strtolower($this->car->brand->name_en).DIRECTORY_SEPARATOR.$this->year;
		$files = '';
		$n=0;
		//foreach( CFileHelper::findFiles($db_dir,array('fileTypes' => array($this->id.'*.jpg'))) as $f) {
		foreach (glob($db_dir.DIRECTORY_SEPARATOR.$this->id.'*.jpg') as $f) {
			$url = str_replace($root_dir,'', $f);
			$files .= CHtml::link(CHtml::image($url,'-',array('style'=>'max-width:100px;max-height:75px;border:0;margin:0;')),$url,array('rel'=>'screen'));
			//CHtml::image($url,'skreen',array('style'=>'width:100px;max-height:75px;border:0;margin:0;',array('rel'=>'screen')));
			//'<img src="'.$url.'" width="100" height="70">';
			$n++;
		}
		if (!$n) return false;

		$text  = '<div>'.$files;
		$text .= '</div>';
		return $text;
	}
}
