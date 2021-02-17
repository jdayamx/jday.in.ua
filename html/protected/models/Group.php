<?php

/**
 * This is the model class for table "group".
 *
 * The followings are the available columns in table 'group':
 * @property integer $id
 * @property string $name
 * @property string $color
 * @property string $description
 *
 * The followings are the available model relations:
 * @property User[] $users
 */
class Group extends CActiveRecord
{
	public $name = 'Гость';
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Group the static model class
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
		return 'group';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, color, description, rule_cs16', 'required'),
			array('name, rule_cs16', 'length', 'max'=>64),
			array('color', 'length', 'max'=>7),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('prio', 'safe', 'on'=>'update'),
			array('id, name, color, description, rule_cs16, prio', 'safe', 'on'=>'search'),
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
			'users' => array(self::HAS_MANY, 'User', 'group_id'),
			'acs' => array(self::HAS_MANY, 'Access', array('group_id'=>'id')),
			'access_link' => array(self::HAS_MANY, 'AccessGroup', array('group_id'=>'id')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Название',
			'color' => 'Цвет',
			'description' => 'Описание',
			'rule_cs16' => 'Права для CS 1.6',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('color',$this->color,true);
		$criteria->compare('description',$this->description,true);
		$criteria->order ='prio';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function getColorName()
	{
		return '<font color="'.$this->color.'"><b>'.$this->name.'</b></font>';
	}

	public function getButtons()
	{
		$ret = array();
		///$ret[] = CHtml::ajaxlink(CHtml::image('/img/admin/application-view-detail-icon.png','Просм.'),array('admin/pageview','id'=>$this->id),array('update'=>'#preview')).' ';
		$ret[] = CHtml::link(CHtml::image('/img/admin/Pencil-icon.png','Ред.'),array('/users/group/update','id'=>$this->id)).' ';
		if(!count($this->users)&&$this->id)$ret[] = CHtml::link(CHtml::image('/img/admin/delete.png','Ред.',array('title'=>'Редактировать')),array('/users/group/update','id'=>$this->id), array('confirm'=>'Вы уверены что хотите удалить группу "'.$this->name.'"?')).' ';
		$ret[] = CHtml::link(CHtml::image('/img/admin/access.png','Пр.',array('title'=>'Назначить права')),array('/adm/access/index','group'=>$this->id)).' ';
		return implode(' ',$ret);//CHtml::link('view',array('news/view','id'=>$this->id),array('target'=>'_blank')).' ';
	}
}