<?php

$this->widget('CTabView', array(
	'htmlOptions'=>array('class'=>'tabs'),
    'tabs'=>array(
        'tab1'=>array(
            'title'=>'Текстура',
            'view'=>'_png_texture',
            'data'=>array('model'=>$model),
        ),
        'tab3'=>array(
            'title'=>'Просмотр',
            'view'=>'_png_view',
            'data'=>array('model'=>$model),
        ),
    ),
));



//echo CHtml::image($model->filename,$model->name);
$this->renderpartial('_like_material',array('model'=>$model));
$this->left_menu .= $this->renderpartial('_like',array('model'=>$model),true);
?>