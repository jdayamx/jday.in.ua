<?php echo "<?php\n"; ?>
<?php
$nameColumn=$this->guessNameColumn($this->tableSchema->columns);
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	\$model->{$nameColumn},
);\n";
?>
?>

<table class="table-choc border">
	<tr>
		<td class="header">
			Просмотр <?php echo $this->modelClass." #<?php echo \$model->{$this->tableSchema->primaryKey}; ?>".PHP_EOL; ?>
		</td>
	</tr>
	<tr>
		<td width="30%" class="row_in">

<?php echo "<?php"; ?> $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
<?php
foreach($this->tableSchema->columns as $column)
	echo "\t\t'".$column->name."',\n";
?>
	),
)); ?>
</td>
	</tr>
</table>
