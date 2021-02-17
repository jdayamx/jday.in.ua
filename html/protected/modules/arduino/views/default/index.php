<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);
?>
<?php

	//echo CHtml::image('/img/full_arduino_nano_03.png','',array('style'=>'max-width:960px;'));

?>
<table class="table-choc border">
	<tr>
		<td class="header" colspan=2>
			Контроллеры Arduino
		</td>
	</tr>
<?php

foreach(ArdController::model()->findAll() as $ard) {
	$this->renderPartial('_ard_view',array('model'=>$ard));
}

?>
<!----------------------------------------------------------------------------->
</table>