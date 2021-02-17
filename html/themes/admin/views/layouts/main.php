<?php
	header("Content-type: text/html; charset=utf-8");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title><?php echo Yii::app()->settings->get('config', 'name');?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php
		$baseUrl = Yii::app()->baseUrl;
		$cs = Yii::app()->getClientScript();
		$cs->registerCoreScript( 'jquery' );
		$cs->registerCoreScript( 'jquery.ui' );
		$cs->registerCssFile(Yii::app()->theme->baseUrl.'/css/style.css');
		$cs->registerCssFile(Yii::app()->theme->baseUrl.'/css/ui.css');
		//}
		//$cs->registerCoreScript( 'jquery.ui' );
	?>
	<style>
		html,body {
		  	background:#ffffff url(<?php echo Yii::app()->theme->baseUrl;?>/img/abg.gif);

  		}
		.headmenu {			position:absolute;
			top:10px;
			left:10px;
			width:220px;
			height:70px;
			border:2px solid #EEE;
			border-radius:7px;
			background-color:#5ec5fb;
			padding-left:10px;
			padding-top:5px;
			font-size:12px;		}
		.headmenu ul li {
			border-radius: 7px;
  -webkit-border-radius: 7px;
  -moz-border-radius: 7px;
  -khtml-border-radius: 7px;
			margin-top:4px;
			padding-left:10px;
			border-left:2px solid #eee;
			border-right:1px solid #eee;
			background-color:#19aefc;
			width:90%;
		}
		.headmenu ul li.active {			background-color:#a6defb;
		}
		.headmenu ul li.active a {
			color:#FFA;
		}
		.headmenu ul li a {			color:#EEE;
			text-decoration:none;
			width:100%;		}

		.headmenu ul li:hover  {
			background-color:#a6defb;
		}

		.headmenuright {
			position:absolute;
			top:10px;
			right:10px;
			height:20px;
			border:1px solid #EEE;
			border-radius:7px;
			background-color:#cb6e6e;
			padding-left:10px;
			padding-top:5px;
			font-size:12px;
		}
		.headmenuright ul li a {
			color:#EEE;
			text-decoration:none;
		}
		.headmenuright ul li {
			display:inline;
			padding-left:5px;
			padding-right:5px;
		}

	</style>
</head>
<body>
	<div id="container">
		<div id="header">
			<img height="100" src="<?php echo Yii::app()->theme->baseUrl;?>/img/header.png" alt="logo" style="position:absolute;top:0px;left:0px;">
			<div class="headmenu">
				<?php
					$this->widget('zii.widgets.CMenu',
						array(
							//'htmlOptions'=>array('class'=>'icons'),
							'encodeLabel'=>false,
							'items'=>array(
								array('label'=>'Настройка системы', 'url'=>array('/admin/global/settings'),),
								array('label'=>'Управление новостями', 'url'=>array('/news/post/index'),),
								array('label'=>'Список всех разделов', 'url'=>array('/admin/global/menu')),
							),
						)
					);
				?>
			</div>
			<div class="headmenuright">
				<?php
					$this->widget('zii.widgets.CMenu',
						array(
							//'htmlOptions'=>array('class'=>'icons'),
							'encodeLabel'=>false,
							'items'=>array(
								array('label'=>'Просмотр сайта', 'url'=>'/','linkOptions'=>array('target'=>'_blank')),
								array('label'=>'Выход', 'url'=>array('/site/logout'),),
							),
						)
					);
				?>
			</div>
		</div>
		<?php
			$this->widget('zii.widgets.CBreadcrumbs', array(
					'links'=>$this->breadcrumbs,
					'htmlOptions'=>array('class'=>'breadcrumbs')
				)
			);
		?>
		<div id="content">
			<?php echo $content; ?>
		</div>
		<div id="footer">
			Copyright &copy; 2005-<?php echo date('Y'); ?> by <a href="http://jday.in.ua"><b>jday.in.ua</b></a>. Страница сформирована за <b><?=round(Yii::getLogger()->getExecutionTime(), 5)?></b> сек., <?='использовано памяти - <b>'.round(Yii::getLogger()->getMemoryUsage()/(1024*1024), 2)?></b> MB
			 <?php
			 	$sql_stats = YII::app()->db->getStats();
	           	if($sql_stats[0]) echo ', запитів до БД: <b>'. $sql_stats[0].'</b>';
	        ?>
		</div>
	</div>
</body>
</html>