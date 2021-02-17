<?php
/* @var $this PageController */
/* @var $model Page */
/* @var $form CActiveForm */

$this->breadcrumbs=array(
	Yii::app()->getModule('admin')->name=>array('/admin/global/index'),
	'Список категорий'=>array('/news/category/index'),
	'Новая категория'
);

$this->renderpartial('_form',array('model'=>$model,'title'=>'Новая категория'));

?>