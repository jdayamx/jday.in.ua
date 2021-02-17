<?php
$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>

<table class="table-choc border">
	<tr>
		<td class="header">
			Error <?php echo $code; ?>
		</td>
	</tr>
	<tr>
		<td width="30%" class="row">
			 <?php echo CHtml::encode($message); ?>
		</td>
	</tr>
</table>
