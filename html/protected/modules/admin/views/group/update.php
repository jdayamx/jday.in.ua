<?php
/* @var $this PageController */
/* @var $model Page */
/* @var $form CActiveForm */

$this->breadcrumbs=array(
	Yii::app()->getModule('adm')->name=>array('/adm/general/index'),
	'Список групп пользователей'=>array('/users/group/index'),
	$model->name
);

$this->renderpartial('_form',array('model'=>$model,'title'=>'Редактирование группы: '.$model->colorname));

?>