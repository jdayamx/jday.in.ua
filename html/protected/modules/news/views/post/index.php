<?php
$this->breadcrumbs=array(
	Yii::app()->getModule('admin')->name=>array('/admin/global/index'),
	'Новости',
);
?>
<table class="table-choc border">
    <tr>
        <td class="header">Новости</td>
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
		       'title',
		         array(
		        	'name'=>'category.name',
		        	'filter'=>CHtml::dropDownList('Post[category_id]',$model->category_id,CHtml::ListData(Category::model()->findAll(), 'id', 'name'),array('empty'=>'-- все --')),
		        ),
		        array(
		        	'name'=>'visible',
		        	'value'=>'$data->visible?"Да":"Нет"',
		        	'filter'=>CHtml::dropDownList('Post[visible]',$model->visible,array(1=>'Да', 0=>'Нет'),array('empty'=>'-всё-')),
		        ),
		        //'status',
		        'created',
		        //'update_time',
		        //'author_id',
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
        <td class="footer"><?php echo Chtml::link('&nbsp;&nbsp;Добавить&nbsp;&nbsp;',array('/news/post/create'),array('class'=>'bbcode'));?></td>
    </tr>
</table>