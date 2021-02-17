<?php echo "<?php\n"; ?>

<?php
$nameColumn=$this->guessNameColumn($this->tableSchema->columns);
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	\$model->{$nameColumn}=>array('view','id'=>\$model->{$this->tableSchema->primaryKey}),
	'Правка',
);\n";
?>

?>
<table class="table-choc border">
	<tr>
		<td class="header">
			Правка <?php echo $this->modelClass." <?php echo \$model->{$this->tableSchema->primaryKey}; ?>"; ?>
		</td>
	</tr>
	<tr>
		<td width="30%" class="row_in">
<?php echo "<?php echo \$this->renderPartial('_form', array('model'=>\$model)); ?>"; ?>
		</td>
	</tr>
</table>