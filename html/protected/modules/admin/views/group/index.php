<?php

$this->breadcrumbs=array(
	Yii::app()->getModule('admin')->name=>array('/admin/global/index'),
	'Список групп пользователей',
);
?>
<table class="table-choc border">
<tr>
<td class="header">Список групп пользователей</td>
</tr>
<tr>
<td class="row_in">
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'htmlOptions' => array('class' => 'table-choc'),
    'id'=>'page-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
    	array(
            'class'=>'CButtonColumn',
            'template'=>'{update}',
            'visible'=>Yii::app()->user->isAllow('admin/group/update'),
            'buttons'=>array
				    (
				        'update' => array
				        (
				           // 'label'=>'Изменить',
				            'imageUrl'=>Yii::app()->theme->baseUrl.'/img/admin/Pencil-icon.png',
				            //'url'=>'Yii::app()->createUrl("/admin/user/update", array("id"=>$data->id))',
				        ),
				    ),
        ),
    	array(
        	'name'=>'id',
        	'filter'=>false,
        ),
        array (
        	'name'=>'name',
        	'type'=>'raw',
        	'value'=>'$data->Colorname',
        ),
        array(
        	'header'=>'Пользователи',
        	'value'=>'count($data->users)',
        ),
        'description',
        array(
            'class'=>'CButtonColumn',
            'template'=>'{delete}',
            'visible'=>Yii::app()->user->isAllow('admin/group/delete')
        ),
    ),
)); ?>
</td>
</tr>
<tr>
<td class="footer"><?php echo Chtml::link('&nbsp;&nbsp;Добавить группу&nbsp;&nbsp;',array('/admin/group/create'),array('class'=>'bbcode'));?></td>
</tr>
</table>