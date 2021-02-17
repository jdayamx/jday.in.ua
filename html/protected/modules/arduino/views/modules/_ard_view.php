<!----------------------------------------------------------------------------->
<tr>
	<td class="header yellow" colspan=2>
		<?php
			echo $model->name;
		?>
	</td>
</tr>
<tr valign="top">
	<td class="row" width="220">
		<img src="<?php echo $model->image;?>" width="100%">
	</td>
	<td>
		<?php
			$this->widget('CTabView', array(
				'id'=>'info_tb_'.$model->id,
				'htmlOptions'=>array(
					'class'=>'tabs',
				),
				'tabs'=>array(
					'to_'.$model->id=>array('title'=>'Описание', 'content'=>str_replace(PHP_EOL,'<br>',$model->description), 'active'=>true),
					'tp_'.$model->id=>array('title'=>'Параметры', 'content'=>str_replace(PHP_EOL,'<br>',$model->params),'visible'=>($model->params?true:false)),
				),
			));
		?>
	</td>
</tr>