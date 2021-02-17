<?php

	$this->breadcrumbs=array(
		'Подберите себе хостинг',
	);


	$model = New WWWHosting;
	$model->Calc();

	$ajax = array(
			    	    'type' =>'POST',
                        'url' => Yii::app()->createUrl('site/test'),
                        'data'=>array(
                        	'hdd'=>'js:$("#hdd").val()',
                        	'period'=>'js:$("#period").val()',
                        	'php'=>'js:$("#php").val()',
                        	'mysql'=>'js:$("#mysql").val()',
                        	'ftp'=>'js:$("#ftp").val()',
                        	'mysql_dump'=>'js:$("#mysql_dump").val()',
                        	'www_dump'=>'js:$("#www_dump").val()',
                        	'phpmem'=>'js:$("#phpmem").val()',
                        ),
                        'dataType'=>'json',
                        'success'=>' function(data) {
                        	$("#price").html(data.price);
                        	if ($("#mysql").val() == 0) {
                        		$("#mysql_dump_f").hide();
                        	} else {
                        		$("#mysql_dump_f").show();
                        	}
                        	if ($("#php").val() == 0) {
                        		$("#phpmem_f").hide();
                        	} else {
                        		$("#phpmem_f").show();
                        	}
                        }',
				  );

?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'hosting-form',
	'enableAjaxValidation'=>false,
)); ?>
<table class="table-choc border">
	<tr>
		<td class="row_in" colspan=3>
			<table class="table-choc">
				<tr valign="center">
					<td align="center" width="150" class="row">
						<?=CHtml::image('/img/info.png','Обратите внимание !!!');?>
					</td>
					<td align="left">
						При подборе нужных параметров <b><STRIKE>Внимательно</STRIKE></b> <b>ВНИМАТЕЛЬНО</b> выбирайте то, что хотите заказать.<br>
						<font color="red">Неправильно выбранные параметры повлияют на качество работы</font>.
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td class="header" colspan=3>
			Подберите себе хостинг
		</td>
	</tr>
	<tr>
		<td width="30%" class="row">
			 <?php echo $form->labelEx($model,'hdd'); ?>
		</td>
		<td>
  			<?php
            	echo $form->dropDownList($model,'hdd',$model->hdd_values,array('id'=>'hdd', 'ajax' => $ajax,));
			?>
		</td>
		<td width="200" class="row center" rowspan=8 id="pr">
			<h1><span id="price"><?=$model->price;?></span>грн</h1>
		</td>
	</tr>
	<tr>
		<td width="30%" class="row">
			 <?php echo $form->labelEx($model,'period'); ?>
		</td>
		<td>
  			<?php
            	echo $form->dropDownList($model,'period',$model->Period_values,array('id'=>'period', 'ajax' => $ajax,));
			?>
		</td>
	</tr>
	<tr>
		<td width="30%" class="row">
			 <?php echo $form->labelEx($model,'php'); ?>
		</td>
		<td>
  			<?php
            	echo $form->dropDownList($model,'php',$model->Php_values,array('id'=>'php', 'ajax' => $ajax,));
			?>
		</td>
	</tr>
	<tr id="phpmem_f">
		<td width="30%" class="row">
			 <?php echo $form->labelEx($model,'phpmem'); ?>
		</td>
		<td>
  			<?php
            	echo $form->dropDownList($model,'phpmem',$model->phpmem_values,array('id'=>'phpmem', 'ajax' => $ajax,));
			?>
		</td>
	</tr>
	<tr>
		<td width="30%" class="row">
			 <?php echo $form->labelEx($model,'mysql'); ?>
		</td>
		<td>
  			<?php
            	echo $form->dropDownList($model,'mysql',$model->MySql_values,array('id'=>'mysql', 'ajax' => $ajax,));
			?>
		</td>
	</tr>
	<tr id="mysql_dump_f" style="display:none;">
		<td width="30%" class="row">
			 <?php echo $form->labelEx($model,'mysql_dump'); ?>
		</td>
		<td>
  			<?php
            	echo $form->dropDownList($model,'mysql_dump',$model->mysql_dump_values,array('id'=>'mysql_dump', 'ajax' => $ajax,));
			?>
		</td>
	</tr>
	<tr>
		<td width="30%" class="row">
			 <?php echo $form->labelEx($model,'www_dump'); ?>
		</td>
		<td>
  			<?php
            	echo $form->dropDownList($model,'www_dump',$model->Www_dump_values,array('id'=>'www_dump', 'ajax' => $ajax,));
			?>
		</td>
	</tr>
	<tr>
		<td width="30%" class="row">
			 <?php echo $form->labelEx($model,'ftp'); ?>
		</td>
		<td>
  			<?php
            	echo $form->dropDownList($model,'ftp',$model->Php_values,array('id'=>'ftp', 'ajax' => $ajax,));
			?>
		</td>
	</tr>
	<tr>
		<td class="row" colspan=3>
			<?php echo CHtml::submitButton('Заказать'); ?>
		</td>
	</tr>
	<tr>
		<td class="row_in" colspan=3>
			<table class="table-choc">
				<tr  valign="top">
					<td align="center" width="150" class="row">
						<?=CHtml::image('/img/help.png','Справка');?>
					</td>
					<td align="left">
						<b>PHP</b> (<i>англ. PHP: Hypertext Preprocessor</i> — «PHP: препроцессор гипертекста»; первоначально <i>Personal Home Page Tools</i> — «Инструменты для создания персональных веб-страниц»; произносится пи-эйч-пи) — скриптовый язык программирования общего назначения, интенсивно применяемый для разработки веб-приложений. В настоящее время поддерживается подавляющим большинством хостинг-провайдеров и является одним из лидеров среди языков программирования, применяющихся для создания динамических веб-сайтов
						<hr>
						<b>MySQL</b> - это система управления реляционными базами данных. В реляционной базе данных данные хранятся не все скопом, а в отдельных таблицах, благодаря чему достигается выигрыш в скорости и гибкости. Таблицы связываются между собой при помощи отношений, благодаря чему обеспечивается возможность объединять при выполнении запроса данные из нескольких таблиц. SQL как часть системы MySQL можно охарактеризовать как язык структурированных запросов плюс наиболее распространенный стандартный язык, используемый для доступа к базам данных.
						<hr>
						<b>FTP</b> (<i>англ. File Transfer Protocol</i> — протокол передачи файлов) — стандартный протокол, предназначенный для передачи файлов по TCP-сетям (например, Интернет). FTP часто используется для загрузки сетевых страниц и других документов с частного устройства разработки на открытые сервера хостинга.
						<hr>
						<b>Резервное копирование</b> (<i>англ. backup</i>) — процесс создания копии данных на носителе (жёстком диске, дискете и т. д.), предназначенном для восстановления данных в оригинальном или новом месте их расположения в случае их повреждения или разрушения.
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<?php $this->endWidget(); ?>