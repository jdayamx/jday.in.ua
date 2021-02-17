<?php
$this->breadcrumbs=array(
	Yii::app()->getModule('admin')->name=>array('/admin/global/index'),
	'Категории новостей',
);
?>
<table class="table-choc border">
    <tr>
        <td class="header">Категории новостей</td>
    </tr>
    <tr>
        <td class="row_in">
<?php
$this->widget('zii.widgets.grid.CGridView',
        array(
        	'htmlOptions' => array('class' => 'table-choc'),
            'id'=>'Group',
            //'template' => '{items}{pager}',
            //'summaryText'=>false,
            //'ajaxUrl'=>CController::createUrl("/admin/partnersStat/fillModel/"),
            'ajaxUpdate' => false,
            'dataProvider'=>$model->search(),
            'filter'=>$model,
            'nullDisplay'=>'-',
            'pager'=>array(
      		  'header'=>false,
		        'htmlOptions'=>array('class'=>'pager'),
		    ),
             'columns'=>array(
             	array(
				    'class'=>'CButtonColumn',
				    'template'=>'{update}',
				    'buttons'=>array
				    (
				        'update' => array
				        (
				            'imageUrl'=>Yii::app()->theme->baseUrl.'/img/admin/Pencil-icon.png',
				        ),
				    ),
				),
		        array(
		        	'name'=>'name',
		        	'htmlOptions'=>array(
		        		'style'=>'font-weight:bold;',
		        	),
		        ),
        		'description',
        		array(
		        	'name'=>'image',
		        	'type'=>'raw',
		        	'value'=>'CHtml::image($data->image,"Image-".$data->id,array("style"=>"max-width:100px;max-height:100px;"))',
		        	'htmlOptions'=>array(
		        		'style'=>'max-width:100px;',
		        	),
		        	'filter'=>'',
		        ),
             	array(
				    'class'=>'CButtonColumn',
				    'template'=>'{delete}',
				    'buttons'=>array
				    (
				        'delete' => array
				        (
				            'imageUrl'=>Yii::app()->theme->baseUrl.'/img/admin/delete.png',
				        ),
				    ),
				),
           ),
));
?>
		</td>
	</tr>
 	<tr>
        <td class="footer"><?php echo Chtml::link('&nbsp;&nbsp;Добавить&nbsp;&nbsp;',array('/news/category/create'),array('class'=>'bbcode'));?></td>
    </tr>
</table>