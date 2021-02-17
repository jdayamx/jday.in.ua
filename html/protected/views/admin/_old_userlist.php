<tr>
	<td class="<?=$data->user?'row1':'row_yellow'?>"><?=$data->name;?></td>
	<td class="<?=$data->user?'row1':'row_red'?>">
		<?php
			echo $data->user?$data->user->username.' '.Chtml::Link('Обновить',array('/admin/oldupdate','id'=>$data->user_id,'url'=>Yii::app()->request->url),array('class'=>'bbcode')):'Нет в новой базе '.Chtml::Link('Добавить',array('/admin/oldadd','id'=>$data->user_id,'url'=>Yii::app()->request->url),array('class'=>'bbcode'));
		?>
	</td>
</tr>