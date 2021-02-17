<?php echo CHtml::beginForm(); ?>
<table class="table-choc border" id="texturec">
	<tr>
		<td class="header">Фильтр</td>
	</tr>
	<tr>
		<td>
			<label>Категории:</label><br>
			<?php
			foreach(TextureCategory::model()->findAll(array('order'=>'name')) as $cat) {				echo '<input value="" name="categories[]" type="checkbox"> <label for="texture_materials_id_19">'.$cat->name.' <i style="color:#999;">('.$cat->textures_count.')</i></label><br>';			}

           /*
			echo CHtml::CheckboxList('texture_category_id',1,CHtml::listData(TextureCategory::model()->findAll(), 'id','name'),
				array(
					//'id'=> 'texture_category',
					'ajax'=>array(
						'type'=>'GET', //request type
	                    'url'=>  array('texture/index'),
	                    'dataType'=>'text',
	                    'data'=> "js:$(this).serialize()",
	                    'beforeSend' => 'js:function(){	                    	 $("#texturec").toggle();	                    }',
	                    'success' => 'js:function(data){
	                            //if (vals == 0) { $(this).removeAttr("checked"); }
	                            //else if (vals == 1 ) { $(this).attr("checked","checked"); }

	                           // $(this).attr("checked","checked");
	                           //alert($(this).attr("checked","checked"));
	                           $("#texture_list").html(data);
	                            $("#texturec").toggle();
	                    }',
	                    'error'=>'function (xhr, ajaxOptions, thrownError){
	                            alert(xhr.statusText);
	                            alert(thrownError);}',

					),
				)
			);  */
			?>
			<br>
			<label>Материалы:</label><br>
			<?php

			foreach(TextureMaterials::model()->findAll(array('order'=>'name')) as $cat) {
				$cc = count($cat->textures);
				echo '<input '.(!$cc?'disabled':'').' value="" name="materials[]" type="checkbox"> <label>'.$cat->name.' <i style="color:#999;">('.$cc.')</i></label><br>';
			}

            /*
			echo CHtml::CheckboxList('texture_materials_id',1,CHtml::listData(TextureMaterials::model()->findAll(), 'id','name'),
				array(
					//'id'=> 'texture_category',
					'ajax'=>array(
						'type'=>'GET', //request type
	                    'url'=>  array('texture/index'),
	                    'dataType'=>'text',
	                    'data'=> "js:$(this).serialize()",
	                    'beforeSend' => 'js:function(){
	                    	 $("#texturec").toggle();
	                    }',
	                    'success' => 'js:function(data){
	                            //if (vals == 0) { $(this).removeAttr("checked"); }
	                            //else if (vals == 1 ) { $(this).attr("checked","checked"); }
	                           // $(this).attr("checked","checked");
	                           //alert($(this).attr("checked","checked"));
	                           $("#texture_list").html(data);
	                            $("#texturec").toggle();
	                    }',
	                    'error'=>'function (xhr, ajaxOptions, thrownError){
	                            alert(xhr.statusText);
	                            alert(thrownError);}',

					),
				)
			);  */



			//foreach ($model as $id=>$cat)
			//{
				//print_r($tex);
			//	$col = '#555';
			//	if($cat==$cat->id) $col = '#F55555';
			//	echo '<div style="border-bottom:1px dashed '.$col.';color:'.$col.';">'.CHtml::link($cat->name,array('texture/index','cat'=>$cat->id,'material'=>($material?$material:0)),array('style'=>'text-decoration:none;color:'.$col.';')).'<span style="float:right;">'.$cat->Count.'<span></div>';
			//}
			?>
		</td>
	</tr>
</table>
<?php echo CHtml::endForm(); ?>
<br>