<?php
/* @var $this AdminController */

$this->breadcrumbs=array(
	'Админка',
);
?>
	<table class="table-choc border">
		<tr>
			<td class="header">adminka</td>
		</tr>
		<tr>
			<td class="row2">
				<ul class="icons">
					<?=Yii::app()->user->isAllow('admin/adminserver')?'<li>'.CHtml::link(CHtml::image('/images/admin/cs16.gif','Admin права').'<span>Игровые права</span>',array('admin/adminserver')).'</li>':''?>
					<?=Yii::app()->user->isAllow('site/access')?'<li>'.CHtml::link(CHtml::image('/images/admin/icon_friends.gif','Права доступа').'<span>Права доступа</span>',array('site/access')).'</li>':''?>
					<?=Yii::app()->user->isAllow('admin/userget')?'<li>'.CHtml::link(CHtml::image('/images/admin/icon_refresh.gif','Синхронизация юзеров').'<span>Синхронизация юзеров</span>',array('admin/userget')).'</li>':''?>
					<?=Yii::app()->user->isAllow('servers/admin')?'<li>'.CHtml::link(CHtml::image('/images/admin/icon_cs.gif','Управление серверами').'<span>Управление серверами</span>',array('servers/admin')).'</li>':''?>
					<?=Yii::app()->user->isAllow('static/admin')?'<li>'.CHtml::link(CHtml::image('/images/admin/slk.gif','Статические страницы').'<span>Статические страницы</span>',array('static/admin')).'</li>':''?>
					<?=Yii::app()->user->isAllow('shop/admin')?'<li>'.CHtml::link(CHtml::image('/images/admin/friend.gif','Управление магазином').'<span>Управление магазином</span>',array('shop/admin')).'</li>':''?>

				</ul>
			</td>
		</tr>
		<tr>
			<td class="header">Форум</td>
		</tr>
		<tr>
			<td class="row2 maximg">
				<ul class="icons">
					<?=Yii::app()->user->isAllow('forum/Access')?'<li>'.CHtml::link(CHtml::image('/images/admin/t.gif','Редактирование, сортировка категорий и форумов').'<span>Управление форумами</span>',array('forum/Access')).'</li>':''?>
				</ul>
			</td>
		</tr>
		<tr>
			<td class="header">Файлы</td>
		</tr>
		<tr>
			<td class="row2 maximg">
				<ul class="icons">
					<?=Yii::app()->user->isAllow('files/admincategory')?'<li>'.CHtml::link(CHtml::image('/images/admin/category.gif','Редактирование категорий').'<span>Категории файлов</span>',array('files/admincategory')).'</li>':''?>
					<?=Yii::app()->user->isAllow('files/admin')?'<li>'.CHtml::link(CHtml::image('/images/admin/files.gif','Редактирование файлов').'<span>Управление файлами</span>',array('files/admin')).'</li>':''?>
					<?=Yii::app()->user->isAllow('files/createcategory')?'<li>'.CHtml::link(CHtml::image('/images/admin/category_add.gif','Добавить категорию').'<span>Добавить категорию</span>',array('files/createcategory')).'</li>':''?>
					<?=Yii::app()->user->isAllow('files/create')?'<li>'.CHtml::link(CHtml::image('/images/admin/file.gif','Добавить файл').'<span>Добавить файл</span>',array('files/create')).'</li>':''?>
				</ul>
			</td>
		</tr>
	</table>