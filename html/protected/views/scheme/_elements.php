
<?php

if(Yii::app()->user->isAllow('schemeelementlink/create')) {
	echo CHtml::link('Добавить элемент',array('schemeElementLink/create','scheme_id'=>$model->id), array('class'=>'btn')). CHtml::link('Для покупки',array('scheme/elements','id'=>$model->id), array('class'=>'btn')).'<br><br>';
}

$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'scheme-element-link-grid',
    'htmlOptions'=>array('class'=>'table-choc'),
    'dataProvider'=>$elements->search(array('condition'=>'scheme_id='.$model->id)),
    'filter'=>$elements,
    'ajaxUpdate'=>false,
    'columns'=>array(
        array(
            'class'=>'CButtonColumn',
            'template'=>'{update}',
            'buttons'=>array(
            	'update'=>array(
            		'url'=>'Yii::app()->createUrl("schemeElementLink/update", array("id"=>$data->id))',
            		'click'=>"function(){
                                    $.fn.yiiGridView.update('scheme-element-link-grid', {
                                        type:'GET',
                                        url:$(this).attr('href'),
                                        success:function(data) {
                                              $('#AjFlash').html(data).fadeIn().animate({opacity: 1.0}, 3000).fadeOut('slow');

                                              $.fn.yiiGridView.update('scheme-element-link-grid');
                                        }
                                    })
                                    return false;
                              }
                     ",
            	),
            ),
        ),
    array(
        'name'=>'element_id',
        'type'=>'raw',
           'value'=>'$data->element->letter.$data->number',
    ),
    array(
        'name'=>'value',
        'type'=>'raw',
        'value'=>'$data->value',
    ),

    array(
        'name'=>'element_type_id',
        'type'=>'raw',
        'value'=>'$data->type->NameImage',
    ),

    array(
        'header'=>'Найти',
        'type'=>'raw',
        'value'=>'CHtml::link("Найти","https://www.rcscomponents.kiev.ua/modules.php?name=Asers_Shop&s_op=search&query=".$data->element->name." ".$data->type->name." ".$data->value,array("target"=>"_blank"))',
    ),

    //https://www.rcscomponents.kiev.ua/modules.php?name=Asers_Shop&s_op=search&query=SMD%200805%20uF

    ),
)); ?>
<div id='AjFlash'>123</div>
