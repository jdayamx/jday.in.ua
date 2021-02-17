<?php

/**
 * This is the model class for table "m_craft".
 *
 * The followings are the available columns in table 'm_craft':
 * @property integer $id
 * @property string $item_1
 * @property string $item_2
 * @property string $item_3
 * @property string $item_4
 * @property string $item_5
 * @property string $item_6
 * @property string $item_7
 * @property string $item_8
 * @property string $item_9
 * @property string $item_table_id
 */
class MCraft extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'm_craft';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, item_1, item_2, item_3, item_4, item_5, item_6, item_7, item_8, item_9, item_table_id', 'required'),
			array('id', 'numerical', 'integerOnly'=>true),
			array('item_1, item_2, item_3, item_4, item_5, item_6, item_7, item_8, item_9, item_table_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, item_1, item_2, item_3, item_4, item_5, item_6, item_7, item_8, item_9, item_table_id', 'safe', 'on'=>'search'),
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
			'item1' => array(self::BELONGS_TO, 'MItem', 'item_1'),
			'item2' => array(self::BELONGS_TO, 'MItem', 'item_2'),
			'item3' => array(self::BELONGS_TO, 'MItem', 'item_3'),
			'item4' => array(self::BELONGS_TO, 'MItem', 'item_4'),
			'item5' => array(self::BELONGS_TO, 'MItem', 'item_5'),
			'item6' => array(self::BELONGS_TO, 'MItem', 'item_6'),
			'item7' => array(self::BELONGS_TO, 'MItem', 'item_7'),
			'item8' => array(self::BELONGS_TO, 'MItem', 'item_8'),
			'item9' => array(self::BELONGS_TO, 'MItem', 'item_9'),
			'itemtable' => array(self::BELONGS_TO, 'MItem', 'item_table_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'item_1' => 'Item 1',
			'item_2' => 'Item 2',
			'item_3' => 'Item 3',
			'item_4' => 'Item 4',
			'item_5' => 'Item 5',
			'item_6' => 'Item 6',
			'item_7' => 'Item 7',
			'item_8' => 'Item 8',
			'item_9' => 'Item 9',
			'item_table_id' => 'Item Table',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('item_1',$this->item_1,true);
		$criteria->compare('item_2',$this->item_2,true);
		$criteria->compare('item_3',$this->item_3,true);
		$criteria->compare('item_4',$this->item_4,true);
		$criteria->compare('item_5',$this->item_5,true);
		$criteria->compare('item_6',$this->item_6,true);
		$criteria->compare('item_7',$this->item_7,true);
		$criteria->compare('item_8',$this->item_8,true);
		$criteria->compare('item_9',$this->item_9,true);
		$criteria->compare('item_table_id',$this->item_table_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MCraft the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getCalcAll() {
		$ret = 0;
		if($this->item1) $ret += $this->item1->CalcCost;
		if($this->item2) $ret += $this->item2->CalcCost;
		if($this->item3) $ret += $this->item3->CalcCost;
		if($this->item4) $ret += $this->item4->CalcCost;
		if($this->item5) $ret += $this->item5->CalcCost;
		if($this->item6) $ret += $this->item6->CalcCost;
		if($this->item7) $ret += $this->item7->CalcCost;
		if($this->item8) $ret += $this->item8->CalcCost;
		if($this->item9) $ret += $this->item9->CalcCost;
		//if($this->itemtable) $ret += $this->itemtable->MadeCost;

		return $ret;
	}

	public function getCalcItems() {
		$ret = array();
		//if($this->item1) $ret = array_merge($this->item1->CalcItem, $ret);
		//if($this->item2) $ret = array_merge($this->item2->CalcItem, $ret);
		if($this->item1  &&  in_array($this->item1->type_id, array(1,3))) {
			foreach($this->item1->CalcItem as $i=>$c) {
				$ret[$i] += $c;
			}
		}

		if($this->item2  &&  in_array($this->item2->type_id, array(1,3))) {
			foreach($this->item2->CalcItem as $i=>$c) {
				$ret[$i] += $c;
			}
		}
		if($this->item3 &&  in_array($this->item3->type_id, array(1,3))) {
			foreach($this->item3->CalcItem as $i=>$c) {
				$ret[$i] += $c;
			}
		}
		if($this->item4 &&  in_array($this->item4->type_id, array(1,3))) {
			foreach($this->item4->CalcItem as $i=>$c) {
				$ret[$i] += $c;
			}
		}
		if($this->item5 && in_array($this->item5->type_id, array(1,3))) {
			foreach($this->item5->CalcItem as $i=>$c) {
				$ret[$i] += $c;
			}
		}
		if($this->item6 && in_array($this->item6->type_id, array(1,3))) {
			foreach($this->item6->CalcItem as $i=>$c) {
				$ret[$i] += $c;
			}
		}
		if($this->item7 && in_array($this->item7->type_id, array(1,3))) {
			foreach($this->item7->CalcItem as $i=>$c) {
				$ret[$i] += $c;
			}
		}
		if($this->item8 && in_array($this->item8->type_id, array(1,3))) {
			foreach($this->item8->CalcItem as $i=>$c) {
				$ret[$i] += $c;
			}
		}
		if($this->item9 && in_array($this->item9->type_id, array(1,3))) {
			foreach($this->item9->CalcItem as $i=>$c) {
				$ret[$i] += $c;
			}
		}

		//$ret = $this->item1->CalcItem;
/*		if($this->item2) $ret += $this->item2->CalcItem;
		if($this->item3) $ret += $this->item3->CalcItem;
		if($this->item4) $ret += $this->item4->CalcItem;
		if($this->item5) $ret += $this->item5->CalcItem;
		if($this->item6) $ret += $this->item6->CalcItem;
		if($this->item7) $ret += $this->item7->CalcItem;
		if($this->item8) $ret += $this->item8->CalcItem;
		if($this->item9) $ret += $this->item9->CalcItem;
		/*
		if($this->item2) $ret = $this->item2->CalcItem;
		if($this->item3) $ret = $this->item3->CalcItem;
		if($this->item4) $ret = $this->item4->CalcItem;
		if($this->item5) $ret = $this->item5->CalcItem;
		if($this->item6) $ret = $this->item6->CalcItem;
		if($this->item7) $ret = $this->item7->CalcItem;    */
		//if($this->item6) $ret = array_merge($this->item8->CalcItem, $ret);
		//if($this->item9) $ret = array_merge($this->item9->CalcItem, $ret);
		//return $this->craft->CalcItem;
		//return array_merge($ret, $this->item9->CalcItem, $this->item6->CalcItem);
		return $ret;
	}
}
