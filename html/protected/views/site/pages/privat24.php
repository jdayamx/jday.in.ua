<?
$order = 'jday-'.time();
$payment = 'amt=100&ccy=UAH&details=Поддержка портала !&ext_details=1&pay_way=privat24&order='.$order.'&merchant=108011';
$pass = 'XA2Qqfk124i95kPJjQyllf91G3s41S1r';
?>
<form id="p24f" action="https://api.privatbank.ua/p24api/ishop" method="POST" accept-charset="UTF-8">
<input type="hidden" name="merchant" value="108011" />
  <input type="hidden" name="order" value="<?php echo $order;?>" />
  <input type="hidden" name="details" value="Поддержка портала !" />
  <input type="hidden" name="ext_details" value="1" />
  <input type="hidden" name="ccy" value="UAH" />
  <input type="hidden" name="pay_way" value="privat24" />
  <input type="hidden" name="return_url" value="http://jday.in.ua/site/page?view=privat24" />
  <input type="hidden" name="server_url" value="http://jday.in.ua/site/page?view=privat24" />
  <input type="hidden" name="signature" value="<?php echo sha1(md5($payment.$pass));?>" />

<table class="table-choc border">
<tr>
	<td class="header" colspan="2">
		Поддержите портал через Приват Банк
	</td>
</tr>
<tr>
	<td class="row" width="200">Сумма:</td>
	<td>
		<input type="text" name="amt" value="100" readonly/>
	</td>
</tr>
<tr>
	<td class="footer" colspan="2">
		<input type="submit" value="Оплатить" />
	</td>
</tr>
</table>
</form>