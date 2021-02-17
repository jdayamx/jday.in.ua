<?php
$this->pageTitle=Yii::app()->name . ' - About';
$this->breadcrumbs=array(
	'About',
);
?>
<h1>About</h1>
<form method="post" action="/site/page?view=about">
<div class="row">
<?
$this->widget('bootstrap.widgets.TbToggleButton', array(
'name'=>'info',
'enabledLabel' => 'Да',
'disabledLabel' => 'Нет',
'value'=>true,
//'width'=>200,
/*'enabledStyle'=>null,
'customEnabledStyle'=>array(
'background'=>'#FF00FF',
'gradient'=>'#D300D3',
'color'=>'#FFFFFF'
),
'customDisabledStyle'=>array(
'background'=> "#FFAA00",
'gradient'=> "#DD9900",
'color'=> "#333333"
)*/
));

$this->widget('bootstrap.widgets.TbToggleButton', array(
'name'=>'info2',
'enabledLabel' => 'Да',
'disabledLabel' => 'Нет',
'value'=>true,
//'width'=>200,
/*'enabledStyle'=>null,
'customEnabledStyle'=>array(
'background'=>'#FF00FF',
'gradient'=>'#D300D3',
'color'=>'#FFFFFF'
),
'customDisabledStyle'=>array(
'background'=> "#FFAA00",
'gradient'=> "#DD9900",
'color'=> "#333333"
)*/
));


?>
</div>
<div class="row">
<input type="submit" class="btn btn-primary" value="Отправить">
</div>
</form>
<?
if (isset($_POST))
{	echo '<pre>'.print_r($_POST,true).'</pre>';}
?>