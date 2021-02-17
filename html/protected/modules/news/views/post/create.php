<?php
/* @var $this PageController */
/* @var $model Page */
/* @var $form CActiveForm */

$this->breadcrumbs=array(
	Yii::app()->getModule('admin')->name=>array('/admin/global/index'),
	'Список категорий'=>array('/news/post/index'),
	'Добавление новости'
);

$this->renderpartial('_form',array('model'=>$model,'title'=>'Добавление новости'));

?>