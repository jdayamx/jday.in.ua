<?php //echo CHtml::beginForm('',array('method'=>'get',));

?>

<?php $form=$this->beginWidget('CActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
    'enableAjaxValidation'=>false,
)); ?>

<table class="table-choc border" id="texturec">
	<tr>
		<td class="header">Фильтр</td>
	</tr>
	<tr>
		<td class="footer">
			<?php echo CHtml::submitButton('Поиск'); ?>
		</td>
	</tr>

	<tr>
		<td>
			<label>Категории:</label><br>
			<?php

			echo $form->CheckboxList($model,'category_id',CHtml::listData(ModelCategory::model()->findAll(), 'id','name'),
				array(
				/*
					//'id'=> 'texture_category',
					'ajax'=>array(
						'type'=>'GET', //request type
	                    'url'=>  array('model/index'),
	                    'dataType'=>'text',
	                    'data'=> "js:$(this).serialize()",
	                    'beforeSend' => 'js:function(){
	                    	 $("#texturec").toggle();
	                    }',
	                    'success' => 'js:function(data){
	                            //if (vals == 0) { $(this).removeAttr("checked"); }
	                            //else if (vals == 1 ) { $(this).attr("checked","checked"); }

	                           // $(this).attr("checked","checked");
	                           //alert(data);
	                           $("#texture_list").html(data);
	                            $("#texturec").toggle();
	                    }',
	                    'error'=>'function (xhr, ajaxOptions, thrownError){
	                            alert(xhr.statusText);
	                            alert(thrownError);}',

					), */
				)
			);
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
<?php //echo CHtml::endForm();
?>
<?php $this->endWidget(); ?>
<br>