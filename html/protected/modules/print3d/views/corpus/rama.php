<?
$this->breadcrumbs=array(
	$this->module->name=>array('/print3d/dev/index'),
	'Рамный корпус'
);

$data['width'] = 600;
$data['height'] = 600;
$data['depth'] = 600;
$data['profile']['low']['width'] = 30;
$data['profile']['low']['depth'] = 30;
$data['profile']['high']['width'] = 60;
$data['profile']['high']['depth'] = 30;

?>
<style>
	.renderArea {
		background: #000;
	}
</style>
<script type="text/javascript">
    function initWebGL() {
        var canvas = document.getElementById("renderArea");
	    initGL(canvas);
	    initTextureFramebuffer();
	    initShaders();
	    initBuffers();
	    initTextures();
	    loadLaptop();

	    gl.clearColor(0.0, 0.0, 0.0, 1.0);
	    gl.enable(gl.DEPTH_TEST);

	    tick();
    }
</script>


<table class="table-choc border shadow">
	<tr>
		<td class="header" colspan=3>
			Рамный корпус размером <?php echo $data['width'].'x'.$data['height'].'x'.$data['depth'];?>
		</td>
	</tr>
	<tr>
		<td width="200" style="text-align:center;">
			<img src="/uploads/3d/p30x60.jpg"><br>
			<?php echo '<a href="http://alu.kiev.ua/product651.html">Профиль</a> '.$data['profile']['high']['depth'].'x'.$data['profile']['high']['width'];?>
		</td>
		<td>

			<b>Отрезки:</b><br>
			<b>8</b>x<b><?php echo $data['height'];?></b> + <b>4</b>x<b><?php echo $data['width']-$data['profile']['low']['depth']*2;?></b><br>
			<b>Итого: </b><?php echo (8*$data['height']).'+'.(4*($data['width']-$data['profile']['low']['depth']*2)).'=<b>'.((8*$data['height'])+(4*($data['width']-$data['profile']['low']['depth']*2))).'</b>mm';?><br>
			<b>~Цена: </b> <?php echo sprintf('%10.2f',ceil(((8*$data['height'])+(4*($data['width']-$data['profile']['low']['depth']*2)))/1000)*266.40+(2*12/*порез*/)).'</b>грн (с порезом)';?>
		</td>
		<td width="128" style="text-align:center;" title="Уже купил !!!">
			<img src="/uploads/3d/shopping-cart-accept-icon.png"><br>
		</td>
	</tr>
	<tr>
		<td width="200" style="text-align:center;">
			<img src="/uploads/3d/p30x30.jpg"><br>
			<?php echo '<a href="http://alu.kiev.ua/product649.html">Профиль</a> '.$data['profile']['low']['depth'].'x'.$data['profile']['low']['width'];?>
		</td>
		<td>
			<b>Отрезки:</b><br>
			<b>5</b>x<b><?php echo ($data['width']-$data['profile']['high']['width']*2);?></b> + <b>2</b>x<b><?php echo ($data['width']-$data['profile']['high']['width']*2-$data['profile']['low']['width']*2);?></b><br>
			<b>Итого: </b><?php echo 5*($data['width']-$data['profile']['high']['width']*2).'+'.(2*($data['width']-$data['profile']['high']['width']*2-$data['profile']['low']['width']*2)).'=<b>'.(5*($data['width']-$data['profile']['high']['width']*2)+(2*($data['width']-$data['profile']['high']['width']*2-$data['profile']['low']['width']*2))).'</b>mm';?><br>
			<b>~Цена: </b> <?php echo sprintf('%10.2f',ceil((5*($data['width']-$data['profile']['high']['width']*2)+(2*($data['width']-$data['profile']['high']['width']*2-$data['profile']['low']['width']*2)))/1000)*153.00 +(2*7/*порез*/)).'</b>грн (с порезом)';?>
		</td>
		<td width="128" style="text-align:center;" title="Уже купил !!!">
			<img src="/uploads/3d/shopping-cart-accept-icon.png"><br>
		</td>
	</tr>
	<tr>
		<td width="200" style="text-align:center;">
			<img src="/uploads/3d/z30x30.jpg"><br>
			<a href="http://alu.kiev.ua/product214.html">Заглушки квадратные</a> внутренние <?php echo $data['profile']['low']['width'].'х'.$data['profile']['low']['depth'];?>
		</td>
		<td>
			<b>~Цена: </b> 4шт x 2,70грн = <?php echo sprintf('%10.2f',4*2.70).'</b>грн';?>
		</td>
		<td width="128" style="text-align:center;">
			<img src="/uploads/3d/search-icon.png"><br>
		</td>
	</tr>
	<tr>
		<td width="200" style="text-align:center;">
			<img src="/uploads/3d/z30x60.jpg"><br>
			<a href="http://alu.kiev.ua/product218.html">Заглушки прямоугольные</a> внутренние <?php echo $data['profile']['high']['depth'].'х'.$data['profile']['high']['width'];?>
		</td>
		<td>
			<b>~Цена: </b> 12шт x 8,55грн = <?php echo sprintf('%10.2f',12*8.55).'</b>грн';?>
		</td>
		<td width="128" style="text-align:center;">
			<img src="/uploads/3d/search-icon.png"><br>
		</td>
	</tr>
	<tr>
		<td width="200" style="text-align:center;">
			<img src="/uploads/3d/u30x30.jpg"><br>
			<a href="http://ntma.zakupka.com/p/5480904-ugolok-montazhniy-30h30/">Уголок монтажный</a> <?php echo $data['profile']['low']['depth'].'х'.$data['profile']['low']['width'];?>
		</td>
		<td>
			<b>~Цена: </b> 32шт x 15грн = <?php echo sprintf('%10.2f',32*15).'</b>грн';?>
		</td>
		<td width="128" style="text-align:center;">
			<img src="/uploads/3d/search-icon.png"><br>
		</td>
	</tr>
	<tr>
		<td width="200" style="text-align:center;">
			<img src="/uploads/3d/tg.jpg"><br>
			<a href="http://ntma.zakupka.com/p/5480909-t-obraznaya-gayka/">Т-образная гайка</a>
		</td>
		<td>
			<b>~Цена: </b> ~150шт x 6грн = <?php echo sprintf('%10.2f',150*6).'</b>грн';?>
		</td>
		<td width="128" style="text-align:center;">
			<img src="/uploads/3d/search-icon.png"><br>
		</td>
	</tr>
	<tr>
		<td width="200" style="text-align:center;">
			<img src="/uploads/3d/lpc.jpg"><br>
			<a href="http://voron.ua/catalog/023836">Линейный подшипниковый блок SC10UU</a>
		</td>
		<td>
			<b>~Цена: </b> ~4шт x 65,42грн = <?php echo sprintf('%10.2f',4*65.42).'</b>грн';?>
		</td>
		<td width="128" style="text-align:center;">
			<img src="/uploads/3d/shopping-cart-accept-icon.png"><br>
		</td>
	</tr>
	<tr>
		<td width="200" style="text-align:center;">
			<img src="/uploads/3d/op.jpg"><br>
			<a href="http://3d-printerok.in.ua/mekhanika/183-kronshtejn-opora-vala-sk10.html">Кронштейн опора вала SK10</a>
		</td>
		<td>
			<b>~Цена: </b> ~16шт x 40грн = <?php echo sprintf('%10.2f',16*40).'</b>грн';?>
		</td>
		<td width="128" style="text-align:center;">
			<img src="/uploads/3d/shopping-cart-accept-icon.png"><br>
		</td>
	</tr>

	<tr>
		<td width="200" style="text-align:center;">
			<img src="/uploads/3d/opv.jpg"><br>
			<a href="http://voron.ua/catalog/023852">Опора вала SHF-10</a>
		</td>
		<td>
			<b>~Цена: </b> ~12шт x 49грн = <?php echo sprintf('%10.2f',12*49).'</b>грн';?>
		</td>
		<td width="128" style="text-align:center;">         
			<img src="/uploads/3d/shopping-cart-accept-icon.png"><br>
		</td>
	</tr>

	<tr>
		<td width="200" style="text-align:center;">
			<img src="/uploads/3d/lp.jpg"><br>
			<a href="http://3d-printerok.in.ua/podshipniki/151-lm10uu.html">Линейный подшипник LM10UU</a>
		</td>
		<td>
			<b>~Цена: </b> ~16шт x 27грн = <?php echo sprintf('%10.2f',16*27).'</b>грн';?>
		</td>
		<td width="128" style="text-align:center;">
			<img src="/uploads/3d/shopping-cart-accept-icon.png"><br>
		</td>
	</tr>

	<tr>
		<td width="200" style="text-align:center;">
			<img src="/uploads/3d/ln.jpg"><br>
			<a href="http://www.777.lg.ua/index.php?content=prodline&name=lin_podsh">Линейные направляющие 10мм</a>
		</td>
		<td>
			<b>~Цена: </b> ~1000мм = 122грн<br>
			<b>Отрезки:</b><br>
			<b>4</b>x<b>580</b> + <b>4</b>x<b>475</b> + <b>4</b>x<b>500</b> = <b><?php echo sprintf('%10.2f',4*580+4*475+4*500).'мм';?></b><br>
			<b>~Цена итог: </b> ~<?php echo sprintf('%10.2f',4*580+4*475+4*500);?>мм = <?php echo sprintf('%10.2f',((4*580+4*475+4*500)/1000)*122);?>грн<br>
		</td>
		<td width="128" style="text-align:center;">
			<img src="/uploads/3d/shopping-cart-accept-icon.png"><br>
		</td>
	</tr>
	<tr>
		<td width="200" style="text-align:center;">
			<img src="/uploads/3d/sg.jpg"><br>
			<a href="http://at-group.com.ua/products/gayka-bronzovaya-s-flancem">ФЛАНЦЕВАЯ ГАЙКА 10мм шаг 2</a>
		</td>
		<td>
			<b>~Цена: </b> ~10шт x 280грн = <?php echo sprintf('%10.2f',10*280).'</b>грн';?>
		</td>
		<td width="128" style="text-align:center;">
			<img src="/uploads/3d/shopping-cart-accept-icon.png"><br>
		</td>
	</tr>
	<tr>
		<td width="200" style="text-align:center;">
			<img src="/uploads/3d/vt.jpg"><br>
			<a href="http://at-group.com.ua/vinty-trapeceidalnye">Трапецеидальные ходовые винты 10мм шаг 2</a>
		</td>
		<td>
			<b>~Цена: </b> ~6шт x 90грн = <?php echo sprintf('%10.2f',3.24*90).'</b>грн';?><br>
			<b>Отрезки:</b><br>
			<b>2</b>x<b>500</b> + <b>4</b>x<b>560</b> = 3240мм
		</td>
		<td width="128" style="text-align:center;">
			<img src="/uploads/3d/shopping-cart-accept-icon.png"><br>
		</td>
	</tr>
	<tr>
		<td width="200" style="text-align:center;">
			<img src="/uploads/3d/sa.jpg"><br>
			<a href="http://ru.aliexpress.com/wholesale?catId=0&initiative_id=SB_20160523123526&SearchText=GT2+16+%D0%B7%D1%83%D0%B1%D0%B0+10+%D0%BC%D0%BC+%D0%B4%D0%B8%D0%B0%D0%BC%D0%B5%D1%82%D1%80+">алюминиевый шкив 10мм и </a><a href="http://3d-printerok.in.ua/mekhanika/161-gt2-20-shkiv-alyuminievyj.html">5мм</a> <a href="http://ru.aliexpress.com/item/Hot-Sale-2016-New-5-Pcs-GT2-16-Tooth-5mm-Bore-Aluminum-Timing-Pulley-For-3D/32648507305.html?spm=2114.41010308.4.20.5WKMi2"> ??</a>
		</td>
		<td>
			<b>~Цена: </b> ~4 x 5мм + 6 x 10мм = <?php echo sprintf('%10.2f',2*0).'</b>грн';?>
		</td>
		<td width="128" style="text-align:center;">
			<img src="/uploads/3d/search-icon.png"><br>
		</td>
	</tr>
	<tr>
		<td width="200" style="text-align:center;">
			<img src="/uploads/3d/ohv.jpg"><br>
			<a href="http://www.r23d.ru/komplektuyuschie-dlya-3d-printera/mehanika-dlya-3d-printera/opory-hodovogo-dvigatelya/opora-hodovogo-vinta-M8-torttsevaya">Опора ходового винта М10</a>
		</td>
		<td>
			<b>~Цена: </b> ~12 x 108грн = <?php echo sprintf('%10.2f',12*108).'</b>грн';?>
		</td>
		<td width="128" style="text-align:center;">
			<img src="/uploads/3d/search-icon.png"><br>
		</td>
	</tr>

</table>
<script type="text/javascript">
    initWebGL();
</script>