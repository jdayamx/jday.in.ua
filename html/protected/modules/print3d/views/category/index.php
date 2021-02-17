<style>
.my-class ul{
	background: transparent;
}
</style>
<?php
$this->breadcrumbs=array(
	'Pcategories'=>array('index'),
	'Список',
);

?>

<table class="table-choc border">
	<tr>
		<td class="header">
			Pcategories
		</td>
	</tr>
<!--	<tr>
		<td width="30%" class="row_in">
<?php
/*
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pcategory-grid',
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
		'name'=>'pid',
		'type'=>'raw',
       	'value'=>'$data->parent->name',
    ),
	array(
		'name'=>'name',
		'type'=>'raw',
       	'value'=>'CHtml::link($data->name,array("view","id"=>$data->id))',
    ),
	array(
		'name'=>'description',
		'type'=>'raw',
       	'value'=>'$data->description',
    ),
	array(
		'name'=>'enabled',
		'type'=>'raw',
       	'value'=>'$data->yesno[$data->enabled]',
    ),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{delete}'
		),
	),
)); */
?>

		</td>
	</tr>-->
	<tr>
		<td class="footer">
			<?php echo CHtml::link(' Новая запись ', array('create'), array('class'=>'bbcode')); ?>
		</td>
	</tr>
	<tr>
		<td class="row">

			<?php
				echo CHtml::link(CHtml::image('/img/icons/bullet-add-icon.png','+'),array('/print3d/category/create'));
				$this->widget(
					'CTreeView',
					array(
						'data' => $model->tree,
						'htmlOptions' => array(
							'class' => 'my-class'
						)
					)
				);
				//print_r($model->tree);
			 ?>

		</td>
	</tr>


</table>
