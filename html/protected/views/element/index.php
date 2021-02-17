<?php
$this->breadcrumbs=array(
	'Elements'=>array('index'),
	'Список',
);

?>

<table class="table-choc border">
	<tr>
		<td class="header">
			Elements
		</td>
	</tr>
	<tr>
		<td width="30%" class="row_in">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'element-grid',
	'htmlOptions'=>array('class'=>'table-choc'),
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'ajaxUpdate'=>false,
	'columns'=>array(
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}'
		),
	array(
		'name'=>'id',
		'type'=>'raw',
       	'value'=>'$data->id',
		'htmlOptions'=>array('width'=>30),
    ),
	array(
		'name'=>'name',
		'type'=>'raw',
       	'value'=>'CHtml::link($data->name,array("view","id"=>$data->id))',
    ),
	array(
		'name'=>'letter',
		'type'=>'raw',
       	'value'=>'$data->letter',
    ),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{delete}'
		),
	),
)); ?>

		</td>
	</tr>
	<tr>
		<td class="footer">
			<?php echo CHtml::link(' Новая запись ', array('create'), array('class'=>'bbcode')); ?>
		</td>
	</tr>
</table>
