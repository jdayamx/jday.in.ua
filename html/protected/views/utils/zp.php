<table class="table-choc border">
	<tr>
		<td class="header" colspan="2">Домашние финансы</td>
	</tr>
	<tr>
		<td class="row_in" colspan="2">
			<?php $this->widget('zii.widgets.grid.CGridView', array(
				'htmlOptions'=>array('class'=>'table-choc'),
			    'id'=>'zp-grid',
			    'dataProvider'=>$model->search(array('group'=>'actual_date','select'=>'*,SUM(summ) as summs,group_concat(work) as works')),
			    'filter'=>$model,
			    'columns'=>array(
			        array(
			        	'name'=>'summ',
			        	'type'=>'html',
			        	'value'=>'($data->sign?"<img src=\"/img/icons/add-icon.png\">":"<img src=\"/img/icons/minus-icon.png\">").$data->summs',
			        ),
			        array(
			        	'name'=>'actual_date',
			        	'value'=>'date("Y-m", strtotime($data->actual_date))',
			        ),
			        //'sign',
			        'opdate',
			        'works',/*
			        array(
			            'class'=>'CButtonColumn',
			        ),       */
			    ),
			)); ?>
		</td>
	</tr>
	<tr>
		<td class="row_in" colspan="2">
			<?php
				$this->renderpartial('zp_form',array('model'=>$new));
			?>
		</td>
	</tr>



</table>