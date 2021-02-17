<?php

$this->breadcrumbs=array(
	$this->module->name,
);


$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_panels', // представление для одной записи
    'ajaxUpdate'=>false, // отключаем ajax поведение
//    'emptyText'=>'В данной категории нет товаров.',
    'summaryText'=>"{start}&mdash;{end} из {count}",
    'template'=>'{sorter} {items} {pager}',
    'sorterHeader'=>'Сортировать по:',
    // ключи, которые были описаны $sort->attributes
    // если не описывать $sort->attributes, можно использовать атрибуты модели
    // настройки CSort перекрывают настройки sortableAttributes
    'sortableAttributes'=>array('title', 'description', 'prio'),
));

?>