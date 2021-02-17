<html>
<style>
	body {
		line-height: 0.9em;
		margin:0px;
	}
	html, body {
		line-height: 0.9em;
		font-family:arial;
		font-size:12px;
	}
    .tbl {
    	width:100%;
    }
	.tbl .items {
		border-collapse:collapse;
		font-size:10px;
		border:1px solid #000;
		width:100%;
	}

	.tbl .items td {
		border:1px solid #999;
		padding:2px;
		margin:0;
	}

</style>
<body>
<h1>Список школ</h1>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'htmlOptions'=>array(
		'class'=>'tbl',
	),
	'dataProvider'=>$model->search(),
	'template'=>'{items}',
//	'filter'=>$model,
	'columns'=>array(
		array(
			'name'=>'name',
		),
		array(
			'name'=>'address',
			'type'=>'html',
			'value'=>'CHtml::link($data->address,"https://www.google.com.ua/maps/search/".$data->address)',
		),
		//https://yandex.ua/maps/143/kyiv/?lang=ru&ll=30.646510%2C50.406190&z=17&rtext=50.407612%2C30.651590~50.406399%2C30.644756&rtt=pd&mode=routes
		'phone',
		'distance',
		'time_togo',
		array(
			'name'=>'url',
			'type'=>'html',
			'value'=>'CHtml::link($data->url, $data->url)',
		),
	),
));
?>
</body>
</html>