<div id="texture_list">
<?php
/* @var $this TextureController */

$this->breadcrumbs=array(
	'Texture'=>array('index'),
	($cat?TextureCategory::model()->findByPk($cat)->name.($material?' ('.TextureMaterials::model()->findByPk($material)->name.')':''):'Все'.($material?' ('.TextureMaterials::model()->findByPk($material)->name.')':''))
);

$this->left_menu = $this->renderpartial('_filter', array('model'=>$model), true);
$this->left_menu .= $this->renderpartial('_category', array('material'=>intval($material),'cat'=>intval($cat),'model'=>TextureCategory::model()->findAll()), true);
$this->left_menu .= $this->renderpartial('_materials', array('material'=>intval($material),'cat'=>intval($cat),'model'=>TextureMaterials::model()->findAll(array('order'=>'name'))), true);

?>
<table class="table-choc border">
<tr>
<td class="header" colspan="2">Текстуры</td>
</tr>
<tr>
<td class="row_in">

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	                 'htmlOptions' => array('class' => 'table-choc'),
	                 'ajaxUpdate' => false,
		   			 'dataProvider'=>$model->search(),
					 'filter'=>$model,
					 'columns'=>array(
					 	array(
				        	'name'=>'name',
				        	'type'=>'raw',
				        	'value'=>'$data->filelink',
				        ),
						array(
				        	'name'=>'texture_category_id',
				        	'htmlOptions' => array('align' => 'center','width'=>130),
				        	'value'=>'$data->Category->name',
				        ),
		        		array(
				        	'name'=>'type',
				        	'htmlOptions' => array('align' => 'center','width'=>40),
				        ),
		        		array(
				        	'header'=>'К-тво текстур',
				        	'htmlOptions' => array('align' => 'center','width'=>80),
				        	'value'=>'$data->count',
				        ),
				        array(
				        	'header'=>'К-тво карт с текстурой',
				        	'htmlOptions' => array('align' => 'center','width'=>80),
				        	'value'=>'count($data->maps)',
				        ),

				    ),
					));
?>
</td>
</tr>
</table>
</div>