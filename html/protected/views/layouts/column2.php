<?php
	$this->beginContent('//layouts/main');
?>
<style>
div.info img {
	max-width:700px;

}
.mbox {
	margin:3px;
}
</style>
<div style="width:22%;float:left;margin:2px;">
<center>
<?
$order = 'jday-'.time();
?>
	<form method="POST" action="https://api.privatbank.ua/p24api/ishop">
<input type="hidden" name="amt" value="100.00" />
<input type="hidden" name="ccy" value="UAH" />
<input type="hidden" name="merchant" value="108011" />
<input type="hidden" name="order" value="<?php echo $order;?>" />
<input type="hidden" name="details" value="Поддержка портала jday.in.ua" />
<input type="hidden" name="ext_details" value="" />
<input type="hidden" name="pay_way" value="privat24" />
<input type="hidden" name="return_url" value="http://jday.in.ua/" />
<input type="hidden" name="server_url" value="http://jday.in.ua/" />
<button type="submit"><img src="/img/main_sprite.png" border="0" /></button>
</form>
</center>
	<?php
		echo $this->left_menu;
	?>
</div>
<div style="width:77%;float:left;margin:2px;" class="info">
<?php echo $content; ?>
</div>
<div style="clear:both;"></div>
<?php $this->endContent(); ?>