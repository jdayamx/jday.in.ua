<?php
	$this->breadcrumbs=array(
	'Пополнение бубликов ',
	);

?>
<table class="table-choc border shadow">
	<tr>
		<td class="header" colspan="2">
			Пополнение счета
		</td>
	</tr>
	<tr valign='top'>
		<td width='150' class='row'>
			<img src='/img/wmlogo_128.png'>
		</td>
		<td align='eft'>
			Портал jday.in.ua - принимает оплату в качестве перевода WM в валюту портала а так же доп. услуги по системе WebMoney.<br>
			Все переводы происходят полностью автоматически. Если у вас возникли проблемы с переводом, обратитесь к <a href='/user/JDay/'>ответсвенному</a> лицу.<br>
			<font color=red>Для совершения операций вы должны войти под своим логином.</font>
		</td>
	</tr>
</table>
<br>
<?php
echo CHtml::beginForm('https://merchant.webmoney.ru/lmi/payment.asp','POST',array('class'=>'pull-right'));
echo CHtml::hiddenField('LMI_SIM_MODE','0');
echo CHtml::hiddenField('LMI_PAYMENT_DESC', 'Popolnenie scheta dlya '.Yii::app()->user->name);
echo CHtml::hiddenField('LMI_PAYEE_PURSE','U302623268401');
echo CHtml::hiddenField('LMI_PAYMENT_NO','1');
echo CHtml::hiddenField('USER_ID', Yii::app()->user->id);
?>
<table class="table-choc border shadow">
	<tr>
		<td colspan=2 class='header'>
			WMU кошелек
		</td>
	</tr>
	<tr>
		<td width='250' align='right'>
			Номер кошелька:
		</td>
		<td class='row'>
			<b>U302623268401</b>
		</td>
	</tr>
<?php
if (Yii::app()->user->id) {
?>
	<tr>
		<td class='row' width='250' align='right'>Сумма WM:</td>
		<td class='row2'>
			<select name='LMI_PAYMENT_AMOUNT'>
				<?php
					$r_buble = 50;
					$wmu = array(
						'1.0'=>$r_buble,
						'2.0'=>$r_buble*2,
						'5.0'=>($r_buble*5)+10,
						'10.0'=>($r_buble*10)+20,
						'20.0'=>($r_buble*20)+50,
						'50.0'=>($r_buble*50)+100,
						'100.0'=>($r_buble*100)+250,
						'200.0'=>($r_buble*200)+550,
						'300.0'=>($r_buble*300)+800,
						'500.0'=>($r_buble*500)+1500,
					);
					foreach($wmu as $summ=>$bubles) {
						echo '<option value='.$summ.'>'.round($summ).' WMU ('.Yii::t('','{n} бублик|{n} бублика|{n} бубликов|{n} бублика',$bubles).')</option>';
					}
				?>
			</select>
		</td>
	</tr>
	<tr>
		<td class='row' width='250' align='right'>&nbsp;</td>
		<td class='row2'>
			<input value=' Далее ' type='submit' class='btn'>
		</td>
	</tr>
<?php
}
?>
</table>
<?php echo CHtml::endForm();?>
<br>

<?php
echo CHtml::beginForm('https://merchant.webmoney.ru/lmi/payment.asp','POST',array('class'=>'pull-right'));
echo CHtml::hiddenField('LMI_SIM_MODE','0');
echo CHtml::hiddenField('LMI_PAYMENT_DESC', 'Popolnenie scheta dlya '.Yii::app()->user->name);
echo CHtml::hiddenField('LMI_PAYEE_PURSE','R751058740061');
echo CHtml::hiddenField('LMI_PAYMENT_NO','1');
echo CHtml::hiddenField('USER_ID', Yii::app()->user->id);
?>
<table class="table-choc border shadow">
	<tr>
		<td colspan=2 class='header'>
			WMR кошелек
		</td>
	</tr>
	<tr>
		<td width='250' align='right'>
			Номер кошелька:
		</td>
		<td class='row'>
			<b>R751058740061</b>
		</td>
	</tr>
<?php
if (Yii::app()->user->id) {
?>
	<tr>
		<td class='row' width='250' align='right'>Сумма WM:</td>
		<td class='row2'>
			<select name='LMI_PAYMENT_AMOUNT'>
				<?php
					$r_buble = 13;
					$wmr = array(
						'1.0'=>$r_buble,
						'2.0'=>$r_buble*2,
						'5.0'=>($r_buble*5)+10,
						'10.0'=>($r_buble*10)+20,
						'20.0'=>($r_buble*20)+50,
						'50.0'=>($r_buble*50)+100,
						'100.0'=>($r_buble*100)+250,
						'200.0'=>($r_buble*200)+550,
						'300.0'=>($r_buble*300)+800,
						'500.0'=>($r_buble*500)+1500,
						'1000.0'=>($r_buble*1000)+2300,
					);
					foreach($wmr as $summ=>$bubles) {
						echo '<option value='.$summ.'>'.round($summ).' WMR ('.Yii::t('','{n} бублик|{n} бублика|{n} бубликов|{n} бублика',$bubles).')</option>';
					}
				?>
			</select>
		</td>
	</tr>
	<tr>
		<td class='row' width='250' align='right'>&nbsp;</td>
		<td class='row2'>
			<input value=' Далее ' type='submit' class='btn'>
		</td>
	</tr>
<?php
}
?>
</table>
<?php echo CHtml::endForm();?>
<br>

<?php
echo CHtml::beginForm('https://merchant.webmoney.ru/lmi/payment.asp','POST',array('class'=>'pull-right'));
echo CHtml::hiddenField('LMI_SIM_MODE','0');
echo CHtml::hiddenField('LMI_PAYMENT_DESC', 'Popolnenie scheta dlya '.Yii::app()->user->name);
echo CHtml::hiddenField('LMI_PAYEE_PURSE','Z815568006056');
echo CHtml::hiddenField('LMI_PAYMENT_NO','1');
echo CHtml::hiddenField('USER_ID', Yii::app()->user->id);
?>
<table class="table-choc border shadow">
	<tr>
		<td colspan=2 class='header'>
			WMZ кошелек
		</td>
	</tr>
	<tr>
		<td width='250' align='right'>
			Номер кошелька:
		</td>
		<td class='row'>
			<b>Z815568006056</b>
		</td>
	</tr>
<?php
if (Yii::app()->user->id) {
?>
	<tr>
		<td class='row' width='250' align='right'>Сумма WM:</td>
		<td class='row2'>
			<select name='LMI_PAYMENT_AMOUNT'>
				<?php
					$r_buble = 400;
					$wmz = array(
						'1.0'=>$r_buble,
						'2.0'=>$r_buble*2,
						'5.0'=>($r_buble*5)+10,
						'10.0'=>($r_buble*10)+20,
						'20.0'=>($r_buble*20)+50,
						'50.0'=>($r_buble*50)+100,
						'100.0'=>($r_buble*100)+250,
						//'200.0'=>($r_buble*200)+550,
						//'300.0'=>($r_buble*300)+800,

					);
					foreach($wmz as $summ=>$bubles) {
						echo '<option value='.$summ.'>'.round($summ).' WMZ ('.Yii::t('','{n} бублик|{n} бублика|{n} бубликов|{n} бублика',$bubles).')</option>';
					}
				?>
			</select>
		</td>
	</tr>
	<tr>
		<td class='row' width='250' align='right'>&nbsp;</td>
		<td class='row2'>
			<input value=' Далее ' type='submit' class='btn'>
		</td>
	</tr>
<?php
}
?>
</table>
<?php echo CHtml::endForm();?>