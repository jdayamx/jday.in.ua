<?php

/**
 * This is the model class for table "m_item".
 *
 * The followings are the available columns in table 'm_item':
 * @property string $id
 * @property string $name
 * @property string $reg_proc
 * @property string $timetoget
 * @property string $cost_by_craft
 * @property string $cost
 * @property string $count
 */
class MItem extends CActiveRecord
{
	public $item_money = array(
			4654=>68719476736,
			4653=>1073741824,
			4652=>16777216,
			4651=>262144,
			4650=>4096,
			4649=>64,
			4648=>1,
	);
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'm_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, name, reg_proc, timetoget, cost', 'required'),
			array('id', 'length', 'max'=>16),
			array('name', 'length', 'max'=>32),
			array('reg_proc, timetoget, cost_by_craft, cost, count', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, category_id, type_id, reg_proc, timetoget, cost_by_craft, cost, count', 'safe', 'on'=>'search'),
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
			'craft' => array(self::BELONGS_TO, 'MCraft', 'cost_by_craft'),
			'category' => array(self::BELONGS_TO, 'MItemCategory', 'category_id'),
			'type' => array(self::BELONGS_TO, 'MItemType', 'type_id'),
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
			'reg_proc' => 'Reg Proc',
			'timetoget' => 'Timetoget',
			'cost_by_craft' => 'Cost By Craft',
			'cost' => 'Cost',
			'count' => 'Count',
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
        $criteria->compare('category_id',$this->category_id);
        $criteria->compare('type_id',$this->type_id);
        $criteria->compare('reg_proc',$this->reg_proc,true);
        $criteria->compare('timetoget',$this->timetoget,true);
        $criteria->compare('cost_by_craft',$this->cost_by_craft,true);
        $criteria->compare('cost',$this->cost,true);
        $criteria->compare('count',$this->count,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>100,
			),
			'sort'=>array(
				'defaultOrder'=>'id+0',
			),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MItem the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getCalcCost() {
		$id = 'item_'.$this->id.'_calccost';
		$ret = Yii::app()->cache->get($id);
		if($ret===false)
		{
		    if($this->craft) {
				$sum = round($this->craft->CalcAll/$this->count,2);
				$sum += $this->craft->itemtable->MadeCost;
	           	$ret = $sum+($sum/100*$this->type->nalog_bye);
			} else {
				$ret = round($this->Cost,2);
			}
			Yii::app()->cache->set($id,$ret);
		}

		return $ret;
	}

	public function getCost() {
		return round($this->cost/$this->count, 2);
	}

	public function getVisualCost($nalog=0) {
		$ret = array();
		$sum =  intval($this->CalcCost);
		if($nalog>0) {
			$sum =  floor(intval($this->CalcCost)-(intval($this->CalcCost)/100*$nalog));
		} else {
			$sum =  intval($this->CalcCost);
		}
		$item_money = $this->item_money;
		foreach($item_money as $item=>$money) {
			$cost = intval($sum/$money);
			$sum = $sum-($cost*$money);
			//$money = (float) $money;
			if($cost>=1) {
				$ret[] = CHtml::image('/img/minecraft/item/'.$item.'.png','').$cost;
			}
		}
		return ''.implode('',$ret).'';
	}

	public function getMadeCost() {
		if($this->craft) {
			if(!in_array($this->craft->item_table_id,array('58'))) {
				return $this->craft->itemtable->CalcCost;
			} else {
				return 0;
			}
			//$sum = $this->craft->itemtable->CalcCost;
			/*switch($this->craft->item_table_id) {
				case '204-1':
				return 800;
				case '203-4':
				case '204-8':
				return 1100;
				case '202-3':
				case '202-5':
				return 500;
           		default:
           		return 200;
           	}*/
		}
		//$count = $this->count;
		return 0;
	}

	public function getCraft() {
		if($this->cost_by_craft)  {
			switch($this->craft->item_table_id) {
				case '204-1':
					$table = '<table width="110" border="1" style="min-width:110px;max-width:110px;table-layout: fixed;padding:0;margin:0;border-collapse: separate;background:#C6C6C6 url(/img/minecraft/item/dp.png) no-repeat right center;" cellspacing="0.5">
							<tr height="32" style="max-height:32px;">
								<td width="32" style="border-style: solid;border-color: #373737 #ffffff #ffffff #373737;background:#8B8B8B;max-width:32px;padding:0;margin:0;">'.($this->craft->item1?CHtml::image('/img/minecraft/item/'.$this->craft->item1->id.'.png',''):'').'</td>
								<td width="32" style="background:transparent;border:0;max-width:32px;padding:0;margin:0;"></td>
								<td width="32" style="background:transparent;border:0;max-width:32px;padding:0;margin:0;"></td>
							</tr>
							<tr height="32" style="max-height:32px;">
								<td width="32" style="background:transparent;border:0;max-width:32px;padding:0;margin:0;">'.CHtml::link(CHtml::image('/img/minecraft/item/'.$this->craft->item_table_id.'.png','',array('title'=>$this->craft->item_table_id.' ('.$this->craft->itemtable->name.')','style'=>'opacity: 0.5;')),array('/minecraft/items/index','#'=>'item'.$this->craft->item_table_id)).'</td>
								<td width="32" style="background:transparent;border:0;max-width:32px;padding:0;margin:0;"></td>
								<td width="32" style="background:transparent;border:0;max-width:32px;padding:0;margin:0;"></td>
							</tr>
							<tr height="32" style="max-height:32px;">
								<td style="border-style: solid;border-color: #373737 #ffffff #ffffff #373737;background:#8B8B8B;padding:0;margin:0;">'.($this->craft->item2?CHtml::image('/img/minecraft/item/'.$this->craft->item2->id.'.png',''):'').'</td>
								<td style="border:0;background:transparent;max-height:32px;padding:0;margin:0;"></td>
								<td style="border:0;background:transparent;padding:0;margin:0;"></td>
							</tr>
						</table>';
				break;
				case '202-3':
				case '203-4':
				case '202-5':
				case '204-8':
				$table = '<table width="100" border="1" style="max-width:100px;table-layout: fixed;padding:0;margin:0;border-collapse: separate;" cellspacing="0.5">
							<tr height="32" style="max-height:32px;">
								<td width="32" style="border:0;background:#C6C6C6;max-width:32px;padding:0;margin:0;"></td>
								<td width="32" style="border-style: solid;border-color: #373737 #ffffff #ffffff #373737;background:#8B8B8B;max-width:32px;padding:0;margin:0;">'.($this->craft->item1?CHtml::image('/img/minecraft/item/'.$this->craft->item1->id.'.png',''):'').'</td>
								<td width="32" style="border:0;background:#C6C6C6;max-width:32px;padding:0;margin:0;">'.CHtml::link(CHtml::image('/img/minecraft/item/'.$this->craft->item_table_id.'.png','',array('title'=>$this->craft->item_table_id.' ('.$this->craft->itemtable->name.')','style'=>'opacity: 0.5;')),array('/minecraft/items/index','#'=>'item'.$this->craft->item_table_id)).'</td>
							</tr>
							<tr height="32" style="max-height:32px;">
								<td colspan="3" style="border:0;background:#C6C6C6;max-height:32px;padding:0;margin:0;">'.CHtml::image('/img/minecraft/item/energy.png','').'</td>
							</tr>
							<tr height="32" style="max-height:32px;">
								<td style="border:0;background:#C6C6C6;max-height:32px;padding:0;margin:0;"></td>
								<td style="border-style: solid;border-color: #373737 #ffffff #ffffff #373737;background:#8B8B8B;padding:0;margin:0;">'.($this->craft->item2?CHtml::image('/img/minecraft/item/'.$this->craft->item2->id.'.png',''):'').'</td>
								<td style="border:0;background:#C6C6C6;padding:0;margin:0;"></td>
							</tr>
						</table>';
				break;
				case 61:
				$table = '<table width="100" border="1" style="max-width:100px;table-layout: fixed;padding:0;margin:0;border-collapse: separate;" cellspacing="0.5">
							<tr height="32" style="max-height:32px;">
								<td width="32" style="border:0;background:#C6C6C6;max-width:32px;padding:0;margin:0;"></td>
								<td width="32" style="border-style: solid;border-color: #373737 #ffffff #ffffff #373737;background:#8B8B8B;max-width:32px;padding:0;margin:0;">'.($this->craft->item1?CHtml::image('/img/minecraft/item/'.$this->craft->item1->id.'.png',''):'').'</td>
								<td width="32" style="border:0;background:#C6C6C6;max-width:32px;padding:0;margin:0;"></td>
							</tr>
							<tr height="32" style="max-height:32px;">
								<td colspan="3" style="border:0;background:#C6C6C6;max-height:32px;padding:0;margin:0;">'.CHtml::image('/img/minecraft/item/fire.png','').'</td>
							</tr>
							<tr height="32" style="max-height:32px;">
								<td style="border:0;background:#C6C6C6;max-height:32px;padding:0;margin:0;"></td>
								<td style="border-style: solid;border-color: #373737 #ffffff #ffffff #373737;background:#8B8B8B;padding:0;margin:0;">'.($this->craft->item2?CHtml::image('/img/minecraft/item/'.$this->craft->item2->id.'.png',''):'').'</td>
								<td style="border:0;background:#C6C6C6;padding:0;margin:0;"></td>
							</tr>
						</table>';
				break;                                                                                                            //CHtml::link(CHtml::image('/img/minecraft/item/'.$this->craft->item_table_id.'.png','',array('title'=>$this->craft->item_table_id.' ('.$this->craft->itemtable->name.')','style'=>'opacity: 0.5;')),array('/minecraft/items/index','#'=>'item'.$this->craft->item_table_id))
				default:
				$table = '<table width="96" border="1" style="max-width:100px;table-layout: fixed;padding:0;margin:0;border-collapse: separate;" cellspacing="0.5">
							<tr height="32" style="max-height:32px;">
								<td width="32" style="border-style: solid;border-color: #373737 #ffffff #ffffff #373737;background:#8B8B8B;max-width:32px;padding:0;margin:0;">'.($this->craft->item1?CHtml::link(CHtml::image('/img/minecraft/item/'.$this->craft->item1->id.'.png','',array('title'=>$this->craft->item_1.' ('.$this->craft->item1->name.')')),array('/minecraft/items/index','#'=>'item'.$this->craft->item_1)):'').'</td>
								<td width="32" style="border-style: solid;border-color: #373737 #ffffff #ffffff #373737;background:#8B8B8B;max-width:32px;padding:0;margin:0;">'.($this->craft->item2?CHtml::link(CHtml::image('/img/minecraft/item/'.$this->craft->item2->id.'.png','',array('title'=>$this->craft->item_2.' ('.$this->craft->item2->name.')')),array('/minecraft/items/index','#'=>'item'.$this->craft->item_2)):'').'</td>
								<td width="32" style="border-style: solid;border-color: #373737 #ffffff #ffffff #373737;background:#8B8B8B;max-width:32px;padding:0;margin:0;">'.($this->craft->item3?CHtml::link(CHtml::image('/img/minecraft/item/'.$this->craft->item3->id.'.png','',array('title'=>$this->craft->item_3.' ('.$this->craft->item3->name.')')),array('/minecraft/items/index','#'=>'item'.$this->craft->item_3)):'').'</td>
							</tr>
							<tr height="32" style="max-height:32px;">
								<td style="border-style: solid;border-color: #373737 #ffffff #ffffff #373737;background:#8B8B8B;max-height:32px;padding:0;margin:0;">'.($this->craft->item4?CHtml::link(CHtml::image('/img/minecraft/item/'.$this->craft->item4->id.'.png','',array('title'=>$this->craft->item_4.' ('.$this->craft->item4->name.')')),array('/minecraft/items/index','#'=>'item'.$this->craft->item_4)):'').'</td>
								<td style="border-style: solid;border-color: #373737 #ffffff #ffffff #373737;background:#8B8B8B;padding:0;margin:0;">'.($this->craft->item5?CHtml::link(CHtml::image('/img/minecraft/item/'.$this->craft->item5->id.'.png','',array('title'=>$this->craft->item_5.' ('.$this->craft->item5->name.')')),array('/minecraft/items/index','#'=>'item'.$this->craft->item_5)):'').'</td>
								<td style="border-style: solid;border-color: #373737 #ffffff #ffffff #373737;background:#8B8B8B;padding:0;margin:0;">'.($this->craft->item6?CHtml::link(CHtml::image('/img/minecraft/item/'.$this->craft->item6->id.'.png','',array('title'=>$this->craft->item_6.' ('.$this->craft->item6->name.')')),array('/minecraft/items/index','#'=>'item'.$this->craft->item_6)):'').'</td>
							</tr>
							<tr height="32" style="max-height:32px;">
								<td style="border-style: solid;border-color: #373737 #ffffff #ffffff #373737;background:#8B8B8B;max-height:32px;padding:0;margin:0;">'.($this->craft->item7?CHtml::link(CHtml::image('/img/minecraft/item/'.$this->craft->item7->id.'.png','',array('title'=>$this->craft->item_7.' ('.$this->craft->item7->name.')')),array('/minecraft/items/index','#'=>'item'.$this->craft->item_7)):'').'</td>
								<td style="border-style: solid;border-color: #373737 #ffffff #ffffff #373737;background:#8B8B8B;padding:0;margin:0;">'.($this->craft->item8?CHtml::link(CHtml::image('/img/minecraft/item/'.$this->craft->item8->id.'.png','',array('title'=>$this->craft->item_8.' ('.$this->craft->item8->name.')')),array('/minecraft/items/index','#'=>'item'.$this->craft->item_8)):'').'</td>
								<td style="border-style: solid;border-color: #373737 #ffffff #ffffff #373737;background:#8B8B8B;padding:0;margin:0;">'.($this->craft->item9?CHtml::link(CHtml::image('/img/minecraft/item/'.$this->craft->item9->id.'.png','',array('title'=>$this->craft->item_9.' ('.$this->craft->item9->name.')')),array('/minecraft/items/index','#'=>'item'.$this->craft->item_9)):'').'</td>
							</tr>
						</table>';
			}
			return $table;
		}
		return '';
	}
    public function getCalcItem() {

		$id = 'item_'.$this->id.'_calcitem';
		$res = Yii::app()->cache->get($id);
		if($res===false) {
	    	if($this->cost_by_craft)  {
	    		//if(!in_array($this->craft->item_table_id,array('58'))) {
	    			//$res = array_merge($res, $this->craft->CalcItems);
		    		foreach($this->craft->CalcItems as $item => $count) {
		    			$res[$item] += $count;
		    		}
	    		//}
	    	} else {
	    		$res[$this->id]++;
	    	}
	    	Yii::app()->cache->set($id,$res);
		}
    	//echo  $this->count.'<br>';
    	return $res;
    }

	public function getCalcItems() {
		return $this->craft->CalcItems;
	}

	public function CalcStack($n) {
	 	$stack_count = floor($n/64);
	 	$ostatok = $n - $stack_count*64;
		if( $stack_count>0 ) {
			return $stack_count.'/'.$ostatok;
		} else {
			return '0/'.$n;
		}
	}

	public function getCraftTree() {
		//
		$zz = -1 -1;
		return $zz;
	}


	public function getImage() {
		return CHtml::image('/img/minecraft/item/'.$this->id.'.png','');
	}

}
