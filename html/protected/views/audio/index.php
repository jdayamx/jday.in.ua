<?php
$this->pageTitle=Yii::app()->name . ' - Звуки';
$this->breadcrumbs=array(
	'Звуки',
);
?>

<table class="table-choc border">
	<tr>
		<td class="header">
			Звуки
		</td>
	</tr>
	<tr>
		<td width="30%" class="row_in">
			 <?php $this->widget('zii.widgets.grid.CGridView', array(
			 	'htmlOptions'=>array('class'=>'table-choc'),
			    'id'=>'audio-grid',
			    'ajaxUpdate'=>false,
			    'dataProvider'=>$model->search(),
			    'filter'=>$model,
			    'columns'=>array(
			        //'id',
			        array(
						'name'=>'name',
						'type'=>'raw',
			        	'value'=>'$data->Name',
			        ),
			        array(
						'name'=>'link',
						'type'=>'raw',
			        	'value'=>'$data->Player',
			        ),
			      //  'date',
			        'format',

			        array(
						'header'=>'Инфо',
						'type'=>'raw',
			        	'value'=>'	"Тип: ".$data->type."<br>".
			        				"Каналы: ".$data->channels."<br>".
			        				"Рейт: ".$data->samplerate."<br>".
			        				"bytespersec: ".$data->bytespersec."<br>".
			        				"alignment: ".$data->alignment."<br>".
			        				"bits: ".$data->bits',
			   			'htmlOptions'=>array('style'=>'min-width:120px;'),
			        ),

			       // 'hash',
			        /*
			        'hash_link',
			        */
			        /*array(
			            'class'=>'CButtonColumn',
			        ),*/
			    ),
			)); ?>
		</td>
	</tr>
</table>
