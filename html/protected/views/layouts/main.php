<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<meta name="application-name" content="jday.in.ua" scheme="" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
 	<?php
      	$baseUrl = Yii::app()->baseUrl;
		$cs = Yii::app()->getClientScript();
		$cs->registerCoreScript( 'jquery' );
		$cs->registerCssFile('/css/style.css');
		$cs->registerMetaTag('en', 'language');
		$cs->registerMetaTag($this->pageKeywords, 'keywords');
		$cs->registerMetaTag($this->pageDescription, 'description');

/*		$this->widget('ext.widgets.googleAnalytics.EGoogleAnalyticsWidget',
	        array(
	        	'account'=>'UA-25958519-2',
	        	'domainName'=>'jday.in.ua',
	        )
		);
   */

	?>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<meta itemprop="name" content="<?php echo CHtml::encode($this->pageTitle); ?>"/>
	<meta itemprop="description" content="<?php echo CHtml::encode($this->pageDescription); ?>"/>

	<meta property="og:site_name" content="jday.in.ua"/>
	<meta property="og:title" content="<?php echo CHtml::encode($this->pageTitle); ?>" >
	<?php
		if($this->image) {
			echo '<meta property="og:image" content="'.$this->image.'">'.PHP_EOL."\t";
			echo '<meta itemprop="image" content="'.$this->image.'"/>'.PHP_EOL;
	}
	?>
	<meta property="og:description" content="<?php echo $this->pageDescription;?>">
	<?php

	if($this->background) {		echo '<style> html, body {			'.$this->background.'		}</style>';	}

	?>
</head>

<body>

<div id='overlay'></div>
<div id="container">

	<div id="header">
	<canvas id="hc" width="980" height="100"><img src="/img/logo1.png"></canvas>
    <script type="text/javascript">
		function randomIntFromInterval(min,max)
		{
		    return Math.floor(Math.random()*(max-min+1)+min);
		}

   		function zeroPad(nr,base){
  			var  len = (String(base).length - String(nr).length)+1;
  			return len > 0? new Array(len).join('0')+nr : nr;
		}
   		var hc  = document.getElementById('hc').getContext('2d');
   		var x = 100;
   		var y = 10;
   		var x_b = true;
   		var x_chance = 0;
   		//var i3 = 500;
   		var logo = new Image();
   		//var cloud2 = new Image();
   		var cloud = new Image();
   		var dd = new Date();
   		cloud.src = '/img/cloud.png';
   		//cloud2.src = '/img/cloud2.png';
   		logo.src = '/img/logo1.png';
   		var speed = randomIntFromInterval(16,64);


		 //hc.moveTo(x, y);
   		var interval = setInterval(function() {			dd = new Date();
  			var datetime = dd.getFullYear()+'-'+zeroPad((dd.getMonth()+1),10)+'-'+zeroPad(dd.getDate(),10);
  			datetime += ' '+zeroPad(dd.getHours(),10)+':'+zeroPad(dd.getMinutes(),10)+':'+zeroPad(dd.getSeconds(),10);
  			//datetime += format('%02d:%02d:%02d',[dd.getHours(),dd.getMinutes(),dd.getSeconds()]);            hc.clearRect(0, 0, 980, 230);
            //hc.clearRect(864,95, 	1000, 120);
			//hc.save();
   			hc.drawImage(logo,0,0);
   			hc.drawImage(cloud,x,y);
   			//hc.drawImage(cloud2,(i2 += 1.5),5);
   			//hc.drawImage(cloud,(i3 += 0.43123),0);
   			hc.fillStyle = 'rgba(255,255,225,100)';
   			hc.font = "bold 12px Arial";
   			hc.fillText(datetime,864,95);
   			//hc.beginPath();
   			//hc.lineTo(x+24,y+61);
   			//hc.strokeStyle = '#ff0000';
   			//hc.stroke();
   			//hc.strokeRect(x+24,y+58,1,1);
   			//hc.strokeText(datetime,864,95);
        	//hc.restore();
        	if(x_b) {x = x+1;} else {x = x-1;}
        	if (x == x_chance) {				y = randomIntFromInterval(y-1,y+1);
 		 		x_chance = randomIntFromInterval(100,500);
 		 		if(x < x_chance && !x_b) {x_b= !x_b;}
 		 		if(x > x_chance && x_b) {x_b= !x_b;}        	}
            if (x>500 || x < 100) {            	x_b= !x_b;
            	y = randomIntFromInterval(10,15);
            	x_chance = randomIntFromInterval(100,500);

            }
            hc.fillText(x_chance,1,10);
            hc.fillText("x:"+x,1,20);
            hc.fillText("y:"+y,1,30);
        	//if (i2>1000) i2= -300;
        	//if (i3>1000) i3= -120;



        }, 1000/speed);
	 </script>


		<div style="position:absolute;left:10px;top:80px;">
		<?php $this->widget('zii.widgets.CMenu',array(
			'htmlOptions'=>array('class'=>'hmenu'),
			'encodeLabel'=>false,
			'items'=>array(
				//array('label'=>'Пополнить счет', 'url'=>'/donat.html','linkOptions'=>array('style'=>'color:yellow;')),
				//array('label'=>'Портал', 'url'=>'http://test.jday.in.ua','linkOptions'=>array('style'=>'color:red;')),
				//array('label'=>'Мониторинг', 'url'=>'http://servers.my-gs.info','linkOptions'=>array('style'=>'color:orange;')),
			),
		)); ?>
		</div>
		<div style="position:absolute;right:0px;top:5px;">
		<?php $this->widget('zii.widgets.CMenu',array(
			'htmlOptions'=>array('class'=>'hmenu'),
			'encodeLabel'=>false,
			'items'=>array(
				array('label'=>'Админка', 'url'=>array('/admin/global/menu'), 'visible'=>Yii::app()->user->isAdmin,'linkOptions'=>array('style'=>'color:red;')),
				array('label'=>'Профиль', 'url'=>array('/site/profile','name'=>Yii::app()->user->name), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Регистрация', 'url'=>array('/site/register'), 'visible'=>Yii::app()->user->isGuest,'linkOptions'=>array('style'=>'color:Yellow;')),
				array('label'=>'Вход', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest,'htmlOptions'=>array('style'=>'float:right;')),
				array('label'=>Chtml::image('/img/exit.png','Выход'), 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),


			),
		)); ?>
		</div>


</div><!-- header -->

	<div id="topmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'id'=>'navmenu-h',
			'encodeLabel'=>false,
			'items'=>array(
				array('label'=>'Главная', 'url'=>'/'),
				array('label'=>'Хостинг сайтов', 'url'=>array('/hosting/index'),'visible'=>Yii::app()->user->isAllow('hosting/index')),
				//array('label'=>'Хостинг игр. серверов', 'url'=>array('/games/default/index')),
				array('label'=>'Карты', 'url'=>array('/mapsd/index'),'items'=>array(
					array('label'=>'BOT Конфигуратор', 'url'=>array('mapsd/botconfig'),'visible'=>Yii::app()->user->isAllow('mapsd/botconfig')),
				)),
				array('label'=>'Текстуры', 'url'=>array('/texture/index')),
				array('label'=>'Модели 3D', 'url'=>array('/model/index')),
				array('label'=>'Звуки', 'url'=>array('/audio/index'),'visible'=>Yii::app()->user->isAllow('audio/index')),
				array('label'=>'Утилиты', 'url'=>'','items'=>array(
					array('label'=>'Генератор IpTables', 'url'=>array('/utils/iptables')),
					array('label'=>'Генератор IpTables 2', 'url'=>array('/utils/iptables2')),
					array('label'=>'Нарезка изображения', 'url'=>array('/utils/imageslicing')),
					array('label'=>'Изображение в Base64 encoder', 'url'=>array('/utils/image64')),
					array('label'=>'Ip Утилиты', 'url'=>array('/utils/ip2int')),

					array('label'=>'Добавить компанию', 'url'=>array('/company/create'),'visible'=>Yii::app()->user->isAllow('company/create')),
					array('label'=>'Зарплата', 'url'=>array('/utils/zp'),'visible'=>Yii::app()->user->isAllow('utils/zp')),
					array('label'=>'Расписание электричек', 'url'=>'/site/page?view=electrichki'),
				)),
				array('label'=>'Файлы', 'url'=>array('/files/index'),'visible'=>Yii::app()->user->isAllow('files/index'),'items'=>array(
					array('label'=>'Галерея', 'url'=>array('/files/gallery'),'visible'=>Yii::app()->user->isAllow('files/gallery')),
					array('label'=>'Добавить файл', 'url'=>array('/files/addimage'),'visible'=>Yii::app()->user->isAllow('files/addimage')),
				)),
				array('label'=>'Для детей', 'url'=>array('/child/index'),'visible'=>Yii::app()->user->isAllow('child/index'),'items'=>array(
					array('label'=>'Генератор раскрасок', 'url'=>array('/child/colorings'),'visible'=>Yii::app()->user->isAllow('child/colorings')),
					array('label'=>'Школы', 'url'=>array('/child/school'),'visible'=>Yii::app()->user->isAllow('child/school')),
				)),
				array('label'=>'АвтоБОТ', 'url'=>array('/autobot/brand'),'visible'=>Yii::app()->user->isAllow('autobot/brand/index'),'items'=>array(
					//array('label'=>'Генератор раскрасок', 'url'=>array('/child/colorings'),'visible'=>Yii::app()->user->isAllow('child/colorings')),
				)),
				array('label'=>'Minecraft', 'url'=>array('/minecraft'),'visible'=>Yii::app()->user->isAllow('minecraft/items/index'),'items'=>array(
					array('label'=>'Добавить вещь', 'url'=>array('/minecraft/item/create'),'visible'=>Yii::app()->user->isAllow('minecraft/item/create')),
					array('label'=>'Категории вещей', 'url'=>array('/minecraft/ItemCategory/index'),'visible'=>Yii::app()->user->isAllow('minecraft/itemcategory/index')),
					array('label'=>'Типы вещей', 'url'=>array('/minecraft/ItemType/index'),'visible'=>Yii::app()->user->isAllow('minecraft/itemtype/index')),
					array('label'=>'Вещи', 'url'=>array('/minecraft/item/index'),'visible'=>Yii::app()->user->isAllow('minecraft/item/index')),
					array('label'=>'3D Строитель', 'url'=>array('/minecraft/m3d/editor'),'visible'=>Yii::app()->user->isAllow('minecraft/m3d/editor')),


				)),

				array('label'=>'3D Печать', 'url'=>array('/print3d/dev/index'),'visible'=>Yii::app()->user->isAllow('print3d/dev/index'),'items'=>array(
					array('label'=>'Категории', 'url'=>array('/print3d/category/index'),'visible'=>Yii::app()->user->isAllow('print3d/category/index')),
				)),

				array('label'=>'Arduino', 'url'=>array('/arduino/default/index'),'items'=>array(
					array('label'=>'Модули', 'url'=>array('/arduino/modules/index'),'visible'=>Yii::app()->user->isAllow('arduino/modules/index')),
					array('label'=>'Схемы', 'url'=>array('/arduino/scheme/index'),'visible'=>Yii::app()->user->isAllow('arduino/scheme/index')),
					array('label'=>'Эмулятор онлайн', 'url'=>'https://circuits.io'),
				)),

				array('label'=>'Радио схемы', 'url'=>array('/scheme/index'),'items'=>array(
					array('label'=>'Элементы', 'url'=>array('/element/index'),'visible'=>Yii::app()->user->isAllow('element/index')),
					//array('label'=>'Типы элементов', 'url'=>array('/arduino/scheme/index'),'visible'=>Yii::app()->user->isAllow('arduino/scheme/index')),
					//array('label'=>'Ýìóëÿòîð îíëàéí', 'url'=>'https://circuits.io'),
				)),
                                                 //http://csm.my-gs.info/files/addimage
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php
			$this->widget('zii.widgets.CBreadcrumbs', array(
					'links'=>$this->breadcrumbs,
					'htmlOptions'=>array('class'=>'breadcrumbs')
				)
			);
		?>

	<?php echo $content; ?>

	<div id="footer" style="vertical-align:middle;">
		Copyright &copy; 2005-<?php echo date('Y'); ?> by JDay.
		Страница сгенерирована за <b><?=round(Yii::getLogger()->getExecutionTime(), 5)?></b> сек., <?='использовано памяти - <b>'.round(Yii::getLogger()->getMemoryUsage()/(1024*1024), 2)?></b> MB
		 <?php
		 	$sql_stats = YII::app()->db->getStats();
           	if($sql_stats[0]) echo ', запросов к БД: <b>'. $sql_stats[0].'</b>';
        ?>
		<br>

&nbsp;<a href="http://cs-mapping.com.ua/" title="Создай свой Мир, свою Реальность. Будь Создателем, будь БОГОМ" target="_blank"><img src="/uploads/csm_88x31.gif" width="88" height="31" border="0" alt="cs-mapping.com.ua"/></a>

<!-- begin WebMoney Transfer : accept label -->
&nbsp;<a href="http://www.megastock.ru/" target="_blank"><img src="/uploads/grey_rus.gif" alt="www.megastock.ru" border="0"></a>
<!-- end WebMoney Transfer : accept label -->

<!-- begin WebMoney Transfer : attestation label -->
&nbsp;<a href="https://passport.webmoney.ru/asp/certview.asp?wmid=426334326267" target="_blank">
<img src="/uploads/1295341577_grey_rus.gif" alt="WMID:426334326267" border="0"></a>
<!-- end WebMoney Transfer : attestation label -->
<!--		<br>Copyright &copy; 2005-<?php echo date('Y'); ?> by JDay. <?php echo Yii::powered(); ?>-->

&nbsp;

<a href="https://jday.in.ua/Viberiphone.ipa">IPhone 2G Viber</a>
<?php

Counter::getInsert();

?>
	</div><!-- footer -->

</div><!-- page -->
</body>
</html>