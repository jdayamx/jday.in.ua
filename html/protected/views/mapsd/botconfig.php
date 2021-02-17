<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'maps-download-form',
	'enableAjaxValidation'=>false,
)); ?>
<table class="table-choc border">
	<tr>
		<td class="header" colspan=2>
			BOT Конфигуратор
		</td>
	</tr>
	<tr>
		<td width="200" class="row">
			Max id from Maps Table:
		</td>
		<td id="maxidt">
			<?php
				$fids = Yii::app()->db->createCommand('SELECT max(id) as maxid FROM maps_download')->queryAll();
				echo $fids[0]['maxid'];
            ?>
		</td>
	</tr>
	<tr>
		<td width="200" class="row">
			Max id from Scan Table:
		</td>
		<td id="maxids">
			<?php
				$fids = Yii::app()->db->createCommand('SELECT max(id) as maxid FROM scan_ids')->queryAll();
				print_r($fids[0]['maxid']);
            ?>
		</td>
	</tr>
	<tr>
		<td class="row" colspan=2>
			<?php echo CHtml::dropDownList('dbi',null,array(10=>'10 записей',100=>'100 записей',1000=>'1000 записей',10000=>'10000 записей'));?>
			<?php
			//echo CHtml::submitButton('Добавить для скана');
				echo CHtml::ajaxButton('Добавить для скана', array('mapsd/botconfig','act'=>'addtoscan'), array(
					    			'update' => '#maxids',
					    			'type' =>'POST',
    								'beforeSend' => 'function(){$("#overlay").addClass("loading");}',
					    			'complete' => 'function(){$("#overlay").removeClass("loading");}',
								));
			?>
		</td>
	</tr>
</table>
<?php $this->endWidget(); ?>