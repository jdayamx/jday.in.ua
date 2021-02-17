<?php
$this->breadcrumbs=array(
	'Schemes'=>array('index'),
	'Список',
);

?>

<table class="table-choc border">
	<tr>
		<td class="header">
			Schemes
		</td>
	</tr>
	<tr>
		<td width="30%" class="row_in">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'scheme-grid',
	'htmlOptions'=>array('class'=>'table-choc'),
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'ajaxUpdate'=>false,
	'columns'=>array(
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}',
			'visible'=>Yii::app()->user->isAllow('scheme/update'),
		),

	    array(
			'name'=>'logo',
			'type'=>'raw',
	       	'value'=>'($data->logo?CHtml::image($data->logo,"-"):CHtml::image("/img/no-scheme.png","-"))',
	       	'filter'=>'',
	       	'htmlOptions'=>array(
	       		'width'=>128,
	       		'class'=>'row',
	       	),
	    ),
		array(
			'name'=>'name',
			'type'=>'raw',
	       	'value'=>'CHtml::link($data->name,array("view","id"=>$data->id))',
	    ),


		array(
			'class'=>'CButtonColumn',
			'template'=>'{delete}',
			'visible'=>Yii::app()->user->isAllow('scheme/delete'),
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
