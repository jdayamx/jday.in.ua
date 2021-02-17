<style>
.wbox {
	display: table;
	width:130px;
	text-align:center;
	height:170px;
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
	'Бренды автомобилей',
);
?>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'template'=>'{items}<div style="clear:both;"></div>',
    'itemView'=>'_view',
)); ?>