<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->name,
);
?>

<table class="table-choc border shadow">
	<tr>
		<td class="header">
			Временно
		</td>
	</tr>
	<tr>
		<td class="row">
			 <?php
				echo CHtml::link('Хотелка', array('/print3d/dev/my')).' ';
				echo CHtml::link('Прошивка Arduino', 'https://www.repetier.com/firmware/v092/').' ';
				echo CHtml::link('Статья', 'https://habrahabr.ru/company/masterkit/blog/253901/').' ';
				echo CHtml::link('Статья 2', 'http://mtbot.ru/blog/podklyuchenie_ramps_1-4_3d_printer').' ';



			?>
		</td>
	</tr>
	<tr>
		<td class="header">
			Ссылки
		</td>
	</tr>
	<tr>
		<td class="row">
			<ul class="icons">

			 <?php
				echo CHtml::tag('li',_,CHtml::link(CHtml::image('/uploads/3d/805533.jpg','Станочный профиль',array('title'=>'Станочный профиль')).CHtml::tag('span',_,'Профиль'), 'http://alu.kiev.ua/cat2/',array('target'=>'_blank')));
				echo CHtml::tag('li',_,CHtml::link(CHtml::image('/uploads/3d/electronika.jpg','Электроника',array('title'=>'Электроника')).CHtml::tag('span',_,'Электроника'), 'http://3d-printerok.in.ua/22-elektronika',array('target'=>'_blank')));
				echo CHtml::tag('li',_,CHtml::link(CHtml::image('/uploads/3d/pods.jpg','Подшипники',array('title'=>'Подшипники')).CHtml::tag('span',_,'Подшипники'), 'http://3d-printerok.in.ua/24-podshipniki',array('target'=>'_blank')));
				echo CHtml::tag('li',_,CHtml::link(CHtml::image('/uploads/3d/vint.jpg','Механика',array('title'=>'Механика')).CHtml::tag('span',_,'Механика'), 'http://3d-printerok.in.ua/23-mekhanika',array('target'=>'_blank')));
			?>

			</ul>
		</td>
	</tr>
	<tr>
		<td class="header">
			Расчет корпуса
		</td>
	</tr>
	<tr>
		<td class="row">
			<ul class="icons">
			 <?php
				echo CHtml::tag('li',_,CHtml::link(CHtml::image('/uploads/3d/rama.png','Рамный корпус из алюминия',array('title'=>'Рамный корпус из алюминия')).CHtml::tag('span',_,'Рамный'), array('/print3d/corpus/rama')));
			?>
			</ul>
		</td>
	</tr>
	<tr>
		<td class="header">
			Заказы с aliexpress (Не ссы)
		</td>
	</tr>
	<tr>
		<td class="row">
			<ul class="icons">
			 <?php
				echo CHtml::tag('li',_,CHtml::link(CHtml::image('/uploads/3d/map-icon.png','Искать по трекномеру в украине',array('title'=>'Искать по трекномеру в украине')).CHtml::tag('span',_,'Искать в украине'), 'http://services.ukrposhta.ua/bardcodesingle/Default.aspx'));
				echo CHtml::tag('li',_,CHtml::link(CHtml::image('/uploads/3d/CuraTAMIcon.png','Программа для печати',array('title'=>'Программа для печати')).CHtml::tag('span',_,'Софт для печати'), '/uploads/3d/cura.zip'));
			?>
			</ul>
		</td>
	</tr>
</table>
<?php
//echo base64_decode('rd6KvDjOQbZkJCpJs5em4rKNyQBXfbfJys9Px4GsYKDMOWnUCmxVstDxmD6XJyi3');
?>