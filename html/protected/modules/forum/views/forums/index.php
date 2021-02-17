<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->Name,
);
?>
<table class="table-choc border">
	<tr>
		<td class="header" width="60"><?php echo $this->module->Name;?></td>
	</tr>
</table>

<?

foreach(ForumEmail::model()->findAll() as $t) {
	echo '<pre>'.print_r($t->attributes,true).'</pre>';
}

?>