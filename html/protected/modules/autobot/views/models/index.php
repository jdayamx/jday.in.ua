<style>
.car {
	display: table;
	width:210px;
	text-align:center;
	height:165px;
	float:left;
	margin:9px;
	padding:5px;
	background:#fff;
	border:1px solid #999;
	border-radius:3px;
	box-shadow: 0 0 3px rgba(0,0,0,0.5);
}
.info {
	display:table-cell;
	vertical-align:middle;
}
</style>
<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	'Бренды автомобилей'=>array('/autobot/brand'),
	'Модели автомобилей'
);

$find_types = Yii::app()->db->createCommand('SELECT body_type_id FROM car WHERE brand_id = "'.$brand_id.'" GROUP BY body_type_id')->queryColumn();

$this->renderpartial('/brand/_view_detail',array('model'=>CarBrand::model()->findByPk($brand_id)));

foreach ($find_types as $type) {
    $ctype = CarBodyType::model()->findByPk($type);
    echo '<h3 style="border-bottom:2px solid #888;">'.$ctype->name.'</h3>';
	$dataProvider=new CActiveDataProvider('Car',array(
				'criteria'=>array(
					'condition'=>'brand_id="'.$brand_id.'" AND body_type_id="'.$type.'"'
				),
				'pagination'=>array(
					'pageSize'=>1000,
				),
				'sort'=>array(
					'defaultOrder'=>'body_type_id, model, year DESC'
				),
			));

	$this->widget('zii.widgets.CListView', array(
	    'dataProvider'=>$dataProvider,
	    'template'=>'{items}<div style="clear:both;"></div>',
	    'itemView'=>'_view',
	));
}

if(!count($find_types)) echo 'Нет никаких данных';

?>