<?php
$this->breadcrumbs=array(
	Yii::app()->getModule('admin')->name=>array('/admin/global/index'),
	'Пользователи',
);
?>
<table class="table-choc border">
    <tr>
        <td class="header">Пользователи</td>
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
				    'template'=>'{edit}',
				    'buttons'=>array
				    (
				        'edit' => array
				        (
				            'label'=>'Изменить',
				            'imageUrl'=>Yii::app()->theme->baseUrl.'/img/admin/Pencil-icon.png',
				            'url'=>'Yii::app()->createUrl("/admin/user/update", array("id"=>$data->id))',
				        ),
				    ),
				),

             	array(
             		'name'=>'id',
             		'filter'=>false,
             	),
             	array(
             		'name'=>'username',
             		'type'=>'raw',
             		'value'=>'$data->username'
             	),
             	array(
             		'name'=>'group_id',
             		'type'=>'raw',
             		'value'=>'$data->group->Colorname',
             		'filter'=>CHtml::dropdownlist('User[group_id]',$model->group_id,CHtml::ListData(Group::model()->findall(),'id','name'),array('empty'=>'-- Все группы --')),
             	),
             	'email',


             	array(
				    'class'=>'CButtonColumn',
				    'template'=>'{delete}',
				    'buttons'=>array
				    (
				        'delete' => array
				        (
				            'imageUrl'=>Yii::app()->theme->baseUrl.'/img/admin/delete.png',
				            'visible'=>'$data->id!=1'
				        ),
				    ),
				),
           ),
));
?>
	</td>
</tr>
 	<tr>
        <td class="footer"><?php echo Chtml::link('&nbsp;&nbsp;Добавить&nbsp;&nbsp;',array('/admin/user/create'),array('class'=>'bbcode'));?></td>
    </tr>
</table>