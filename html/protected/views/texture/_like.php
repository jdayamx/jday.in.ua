<table class="table-choc border">
	<tr>
		<td class="header">Похожие текстуры </td>
	</tr>
	<tr >
		<td class="row" >
			<?php
				$search = $model->name;
				$search = preg_replace('/[\{\-\_0-9]/ui','%',$search);
				$search = preg_replace('/[\%]+/ui','%',$search);
				if(Yii::app()->user->id==1) {
					echo $search;
					echo '<hr>';
				}
				$z = 0;
				foreach(Texture::model()->findAll(array('order'=>'RAND()','condition'=>'name like "'.$search.'" AND id <> "'.$model->id.'" AND type="png" AND texture_category_id="'.$model->texture_category_id.'"','limit'=>5)) as $texture) {					echo $texture->name.'<br>';
					echo CHtml::link(CHtml::image($texture->filename,$texture->name,array('style'=>'max-width:200px;')),array('texture/view','id'=>$texture->id));
					echo '<hr>';
					$z++;				}
				if(!$z) echo 'Не удалось найти ничего.';
			?>
		</td>
	</tr>
</table>
<br>