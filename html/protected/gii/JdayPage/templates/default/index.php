<?php echo "<?php\n"; ?>
<?php
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	'Список',
);\n";
?>

?>

<table class="table-choc border">
	<tr>
		<td class="header">
			<?php echo $this->pluralize($this->class2name($this->modelClass)).PHP_EOL; ?>
		</td>
	</tr>
	<tr>
		<td width="30%" class="row_in">
<?php

$columns = $this->tableSchema->columns;

echo "<?php"; ?> $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'<?php echo $this->class2id($this->modelClass); ?>-grid',
	'htmlOptions'=>array('class'=>'table-choc'),
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'ajaxUpdate'=>false,
	'columns'=>array(
		array(
			'class'=>'CButtonColumn',
			'template'=>'<?php echo (in_array('name',array_keys($columns))?'':'{view}');?>{update}'
		),
<?php
$count=0;
foreach($columns as $column)
{
	echo"	array(
		'name'=>'".$column->name."',
		'type'=>'raw',
       	'value'=>".('name'==$column->name?"'CHtml::link(\$data->".$column->name.",array(\"view\",\"id\"=>\$data->id))',":"'\$data->".$column->name."',").('id'==$column->name?"\n\t\t'htmlOptions'=>array('width'=>30),":"")."
    ),\n";
	//if(++$count==7)
	//	echo "\t\t/*\n";
//	echo "\t\t'".$column->name."',\n";
}
//if($count>=7)
//	echo "\t\t*/\n";
?>
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
			<?php echo '<?php echo CHtml::link(\' Новая запись \', array(\'create\'), array(\'class\'=>\'bbcode\')); ?>'.PHP_EOL; ?>
		</td>
	</tr>
</table>
