<?php
/* @var $this PageController */
/* @var $model Page */
/* @var $form CActiveForm */

$this->breadcrumbs=array(
	Yii::app()->getModule('admin')->name=>array('/admin/global/index'),
	'Список новостей'=>array('/news/post/index'),
	$model->title
);

$this->renderpartial('_form',array('model'=>$model,'title'=>'Редактирование новости: '.$model->title));

?>