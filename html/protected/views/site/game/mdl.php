<table class="table-choc border">
	<tr>
		<td class="header">
			Модель <?php echo $model->filename;?>
		</td>
	</tr>
	<tr>
		<td class="row_in" style="background:#6F7984;height:600px;color:#EEE;text-align:center;">
			тут когда-то будет отрисована модель
		</td>
	</tr>
	<tr>
		<td class="row">
			<?php
			$this->widget('CTabView', array(
				'htmlOptions'=>array('class'=>'tabs'),
				'tabs'=>array(
					array('title'=>'Render', 'content'=>$this->renderpartial('/site/game/_mdl_render',array('model'=>$model),true), 'active'=>true),
					array('title'=>'Sequence', 'content'=>$this->renderpartial('/site/game/_mdl_studioseq',array('model'=>$model),true)),
					array('title'=>'Body', 'content'=>$this->renderpartial('/site/game/_mdl_body',array('model'=>$model),true)),
					array('title'=>'Texture', 'content'=>$this->renderpartial('/site/game/_mdl_texture',array('model'=>$model),true)),
					//array('title'=>'QC', 'content'=>$this->renderpartial('/site/game/_mdl_qc',array('model'=>$model),true)),
				),
			));
			?>
		</td>
	</tr>
</table>