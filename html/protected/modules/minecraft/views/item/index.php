<?php
$this->breadcrumbs=array(
	'Mitems'=>array('index'),
	'Список',
);

?>

<table class="table-choc border">
	<tr>
		<td class="header">
			Mitems
		</td>
	</tr>
	<tr>
		<td width="30%" class="row_in">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'mitem-grid',
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
		'htmlOptions'=>array('width'=>50),
    ),
    array(
		'type'=>'raw',
       	'value'=>'$data->Image',
		'htmlOptions'=>array('width'=>32),
    ),

	array(
		'name'=>'name',
		'type'=>'raw',
       	'value'=>'CHtml::link($data->name,array("view","id"=>$data->id))',
    ),
	array(
		'name'=>'category_id',
		'type'=>'raw',
       	'value'=>'$data->category->name',
       	'filter'=>CHtml::ListData(MItemCategory::model()->FindAll(),'id','name'),
    ),
	array(
		'name'=>'type_id',
		'type'=>'raw',
       	'value'=>'$data->type->name',
       	'filter'=>CHtml::ListData(MItemType::model()->FindAll(),'id','name'),
    ),
	array(
		'name'=>'reg_proc',
		'type'=>'raw',
       	'value'=>'$data->reg_proc',
    ),
	array(
		'name'=>'timetoget',
		'type'=>'raw',
       	'value'=>'$data->timetoget',
    ),
	array(
		'name'=>'cost_by_craft',
		'type'=>'raw',
       	'value'=>'$data->cost_by_craft',
    ),
	array(
		'name'=>'cost',
		'type'=>'raw',
       	'value'=>'$data->Cost',
    ),

    array(
		'header'=>'CalcCost',
		'type'=>'raw',
       	'value'=>'$data->CalcCost',
    ),

	array(
		'name'=>'count',
		'type'=>'raw',
       	'value'=>'$data->count',
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
