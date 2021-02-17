<table class="table-choc">
<tr>
<td class="header red">Ошибка <?php  echo $code;?></td>
</tr>
<tr>
<td class="row2"><?=date('F j, Y');?></td>
</tr>
<tr>
<td class="row2 maximg">
<?php echo $message; ?>
</td>
</tr>
</table>

<br>

<?php
$this->pageTitle=Yii::app()->name . ' - Ошибка';
$this->breadcrumbs=array(
	'Панель управления'=>array('/admin/global/menu'),
	'Ошибка',
);
?>
<!--
<audio controls="controls" autoplay="autoplay" loop="loop" preload="auto" style="display:none;">
        <source src="/media/breakme.ogg" type="audio/ogg">
        <source src="/media/breakme.mp3" type="audio/mpeg">
</audio>
-->