<table>
	<tr>
		<td class="header">
			Похожие материалы
		</td>
	</tr>
	<tr>
		<td>
			<?php
				$mid = '0';
				foreach($model->Materials as $material) {					//echo '<pre>'.print_r($material->attributes,true).'</pre>';
					$mm[] = $material->id;
					//break;				}
				if($mm) $mid = implode(',',$mm);
				//echo $mid;
				$ids = '0';
				$ret = Yii::app()->db->createCommand('SELECT DISTINCT texture_id as id FROM texture_materials_link WHERE material_id IN ('.$mid.') AND texture_id <> "'.$model->id.'" ORDER BY RAND() LIMIT 50')->queryColumn();
				if ($ret) $ids = implode(',',$ret);

				//echo '<pre>'.print_r($ret,true).'</pre>';
				foreach(Texture::model()->findAll(array('order'=>'name DESC','condition'=>'id IN ('.$ids.') AND texture_category_id = "'.$model->texture_category_id.'"')) as $texture) {
					echo '<div style="text-align:center;max-width:128px;float:left;margin:3px;">'.$texture->name.'<br>';
					echo CHtml::link(CHtml::image($texture->filename,$texture->name,array('style'=>'max-width:128px;')),array('texture/view','id'=>$texture->id));
					$pr = $model->imagediff($texture->imageid);
					echo '<span title=\'Совпадение\'>'.$pr.'</span></div>';
					$z++;
				}
			?>
		</td>
	</tr>
</table>