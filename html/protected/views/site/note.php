<style>

</style>
<?php
$this->pageTitle=Yii::app()->name . ' - Обмен сообщениями Вики и Коли';
Yii::app()->clientScript->registerScript(
   'myHideEffect',
   '$(".info").animate({opacity: 1.0}, 3000).fadeOut("slow");



   ',
   CClientScript::POS_READY
);
$this->breadcrumbs=array(
	'Обмен сообщениями Вики и Коли',
);
?>
<form method="post">
<table class="table-choc border">
	<tr>
		<td class="header">
			Обмен сообщениями Вики и Коли
		</td>
	</tr>
	<tr>
		<td class="row">
			<?php if(Yii::app()->user->hasFlash('success')):?>
			    <div class="info green alert" style="margin-bottom:15px;">
			        <?php echo Yii::app()->user->getFlash('success'); ?>
			    </div>

			<?php endif; ?>
			 <textarea name="msg" style="width:99%;" rows="15"><?php echo $msg;?></textarea>
		</td>
	</tr>
	<tr>
		<td class="footer">
			<input type="submit" value="Отправить">
		</td>
	</tr>
</table>
</form>