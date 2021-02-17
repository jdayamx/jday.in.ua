<table class="table-choc border">
<tr>
<td class="header">Навигация по сайту</td>
</tr>
<tr >
<td class="row">
<?php $this->widget('zii.widgets.CMenu',array(
			'htmlOptions'=>array('class'=>'leftmenu'),
			'encodeLabel'=>false,
			'items'=>array(
				array('label'=>'Админцентр', 'url'=>array('/adm/general/index'),'visible'=>Yii::app()->user->isAllow('adm/general/index')),
				array('label'=>'Мой профиль', 'url'=>array('/site/profile','name'=>Yii::app()->user->name), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Игровые карты', 'url'=>array('/mapsd/index'),'visible'=>Yii::app()->user->isAllow('mapsd/index')),
				array('label'=>'Текстуры', 'url'=>array('/texture/index'),'visible'=>Yii::app()->user->isAllow('texture/index')),
				//array('label'=>'Добавить новости', 'url'=>array('/post/create'),'visible'=>Yii::app()->user->isAllow('post/create')),
				array('label'=>'Модели 3D', 'url'=>array('/model/index'),/*'visible'=>Yii::app()->user->isAllow('model/index')*/),
				array('label'=>'Добавить карту (38)', 'url'=>array('/maps/maps/create'),'visible'=>Yii::app()->user->isAllow('maps/maps/create')),
				array('label'=>'Добавить модель (180)', 'url'=>array('/post/index1'),'visible'=>Yii::app()->user->isAllow('model/create')),
				array('label'=>'Добавить текстуру (1068)', 'url'=>array('/post/index1'),'visible'=>Yii::app()->user->isAllow('textures/create')),
				array('label'=>'Добавить SkyBox (79)', 'url'=>array('/post/index1'),'visible'=>Yii::app()->user->isAllow('skybox/create')),
				array('label'=>'Статистика', 'url'=>array('/stats/index'),'visible'=>Yii::app()->user->isAllow('stats/index')),
				//array('label'=>'Непрочитанное', 'url'=>array('/post/index1')),

			),
		)); ?>
</td>
</tr>
	<tr>
		<td class="header yellow">
			Популярные карты
		</td>
	</tr>
	<tr >
		<td class="row_in">
		<?
			foreach(MapsDownload::model()->findAll(array('condition'=>'downloads>3','limit'=>4,'order'=>'downloads DESC')) as $map) {				$this->renderPartial('/mapsd/_view_main',array('data'=>$map));			}
		?>
		</td>
	</tr>
</table>