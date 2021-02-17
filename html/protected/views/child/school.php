<?php

$this->breadcrumbs=array(
	'Список школ',
);

$this->image = 'https://jday.in.ua/img/school.gif';
$this->pageTitle = 'Школы Дарницы г.Киев';
$this->pageDescription = 'Найди свою школу';
?>
<script type="text/javascript" src="/js/jquery.printPage.js"></script>
<script>
	$('#print').printPage();
</script>
<table class="table-choc border">
	<tr>
		<td class="header">Список школ</td>
	</tr>
	<tr>
		<td><?php echo CHtml::link('Версия для печати',array('/child/schoolprint'),array('id'=>'print'));?></td>
	</tr>
	<tr>
		<td class="row_in">
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'maps-download-grid',
	'htmlOptions'=>array(
		'class'=>'table-choc',
	),
	'dataProvider'=>$model->search(),
	'template'=>'{items}',
	'filter'=>$model,
	'columns'=>array(
		array(
			'name'=>'name',
			'type'=>'raw',
			'value'=>'CHtml::link($data->name,"https://www.google.com.ua/?gws_rd=ssl#q=".urlencode($data->name)."+%D0%BA%D0%B8%D0%B5%D0%B2").($data->image?"<br><center>".CHtml::link(CHtml::image($data->image,$data->name,array("width"=>"220","height"=>"160")),array("/child/school","id"=>$data->id))."</center>":"")',
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
)); ?>
</td>
</tr>
</table>