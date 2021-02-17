<?php
$this->breadcrumbs=array(
	'Текстуры'=>array('index'),
	($cat?TextureCategory::model()->findByPk($cat)->name.($material?' ('.TextureMaterials::model()->findByPk($material)->name.')':''):'Все'.($material?' ('.TextureMaterials::model()->findByPk($material)->name.')':''))
);

$this->left_menu = $this->renderpartial('_filter', array('model'=>$data), true);

?>
<table class="table-choc border">
	<tr>
		<td class="header" colspan=3>Текстуры</td>
	</tr>
<?
$this->widget('zii.widgets.CListView', array(
	'htmlOptions'=>array(
		'id'=>'texture_list',
	),
    'dataProvider'=>$dataProvider,
    'template'=>'<tr>
					<td class="footer" style="text-align:center;">
						{pager}
					</td>
				</tr>
				<tr>
					<td style="text-align:center;padding:5px;">
						{items}
					</td>
				</tr>
				<tr>
					<td class="footer" style="text-align:center;">
						{pager}
					</td>
				</tr>',
    'itemView'=>'_view',
    'pager'=>array(
        'header'=>false,
        'htmlOptions'=>array('class'=>'pager'),
    ),
));

?>
</table>
<br>
