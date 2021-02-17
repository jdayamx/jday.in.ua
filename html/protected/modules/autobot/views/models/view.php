<?php

//http://www.dearcars.com/catalog/kia/sportage

$this->breadcrumbs=array(
	'Бренды автомобилей'=>array('/autobot/brand'),
	'Модели автомобилей'
);

$this->widget('application.extensions.fancybox.EFancyBox', array(
	    'target'=>'a[rel=screen]',
	    'config'=>array(),
	    )
	);

?>
<table class="table-choc border">
	<tr>
		<td class="header" colspan="2">
			<?=$model->brand->name_en.' '.$model->model.' ('.$model->year.')';?>
			<div style="float:right;">
			<?php
				if(Yii::app()->user->isAllow('autobot/models/update')) echo CHtml::link('Правка',array('update','id'=>$model->id));
			?>
			</div>
		</td>
	</tr>
	<tr valign="top">
		<td class="row" width="314">
			<?php
				echo CHtml::image($model->logo,$model->model,array('width'=>320));
			?>
		</td>
		<td class="row_in">
			<table>
				<tr>
					<td class="row" title="Марка автомобиля" width="150">
						Марка:
					</td>
					<td>
						<?php
							echo $model->brand->name;
						?>
					</td>
				</tr>
				<tr>
					<td class="row" title="Марка автомобиля" width="150">
						Модель:
					</td>
					<td>
						<?php
							echo $model->model;
						?>
					</td>
				</tr>
				<tr>
					<td class="row" title="Марка автомобиля" width="150">
						Категория:
					</td>
					<td>
						<?php
							echo $model->type->category->name;
						?>
					</td>
				</tr>
				<tr>
					<td class="row" title="Марка автомобиля" width="150">
						Кузов:
					</td>
					<td>
						<?php
							echo $model->type->name;
						?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td class="header" colspan="2">
			Предложения из автоярмарок
		</td>
	</tr>
	<tr>
		<td class="row_in" colspan="2">
			<table>
			<?php
				$dataProvider=new CArrayDataProvider($model->carSales,array(
				'pagination'=>array(
					'pageSize'=>50,
				),
				'sort'=>array(
					'defaultOrder'=>'id DESC'
				),
			));

			$this->widget('zii.widgets.CListView', array(
			    'dataProvider'=>$dataProvider,
			    'template'=>'<tr><td colspan=2>{pager}</td></tr>{items}<tr><td colspan=2>{pager}</td></tr>',
			    'itemView'=>'_view_sales',
			));

			?>
			</table>
		</td>
	</tr>
</table>