<?php
/* @var $this ModelController */

$this->breadcrumbs=array(
	'Список моделей'=>array('/model'),
	'Просмотр '.$model->name,
);


$files = glob(realpath('uploads/model').DIRECTORY_SEPARATOR.$model->created.DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.$model->id.'_*.png');
$img = array();
$imgs = '';
foreach($files as $file) {
	$file = str_replace(realpath('uploads/model'),'/uploads/model',$file);
	$imgs .= CHtml::image($file,'screenshot '.$file);
	$img[] = $file;
}


$mdl = Yii::app()->mdl;
$mdl->Load($model->filename);

?>
<table class="table-choc border shadow">
	<tr>
		<td class="header" colspan="3">
			Модель <?php echo $model->name;?>
		</td>
	</tr>
	<tr valign="top">
		<td class="row_in" width="300" rowspan="9">
			<?php echo CHtml::image($img[0],'Модель '.$img[0],array('width'=>300));?>
		</td>
		<td class="row" width="200">
			Название:
		</td>
		<td>
			<?php echo $model->name;?>
		</td>
	</tr>
	<tr valign="top">
		<td class="row" width="200">
			Категория:
		</td>
		<td>
			<?php echo CHtml::link($model->Category->p->name,array('model/index','Model3d[category_id][]'=>$model->Category->p->id));?> -> <?php echo CHtml::link($model->Category->name,array('model/index','Model3d[category_id][]'=>$model->category_id));?>
		</td>
	</tr>
	<tr valign="top">
		<td class="row" width="200">
			Дата добавления:
		</td>
		<td>
			<?php echo $model->created;?>
		</td>
	</tr>
	<tr valign="top">
		<td class="row" width="200">
			Версия:
		</td>
		<td>
			<?php echo $mdl->header->version;?>
		</td>
	</tr>
	<tr valign="top">
		<td class="row" width="200">
			Кол-во текстур:
		</td>
		<td>
			<?php echo $mdl->header->numtextures;?>
		</td>
	</tr>
	<tr valign="top">
		<td class="row" width="200">
			Bones:
		</td>
		<td>
			<?php echo $mdl->header->numbones;?>
		</td>
	</tr>
	<tr valign="top">
		<td class="row" width="200">
			Bone Controllers:
		</td>
		<td>
			<?php echo $mdl->header->numbonecontrollers;?>
		</td>
	</tr>
	<tr valign="top">
		<td class="row" width="200">
			Hit Boxes:
		</td>
		<td>
			<?php echo $mdl->header->numhitboxes;?>
		</td>
	</tr>
	<tr valign="top">
		<td class="row" width="200">
			Sequences:
		</td>
		<td>
			<?php echo $mdl->header->numseq;?>
		</td>
	</tr>
	<tr valign="top">
		<td rowspan="5">
		<b>Скачать модель:</b><br>
			<?php
				echo CHtml::link($model->name,array('/model/download','id'=>$model->id));
			?>
			<br><br>
			Cкачиваний: <?php echo $model->downloads;?>
		</td>
		<td class="row" width="200">
			Sequence Groups:
		</td>
		<td>
			<?php echo $mdl->header->numseqgroups;?>
		</td>
	</tr>
	<tr valign="top">
		<td class="row" width="200">
			Skin Families:
		</td>
		<td>
			<?php echo $mdl->header->numskinfamilies;?>
		</td>
	</tr>
	<tr valign="top">
		<td class="row" width="200">
			Body Parts:
		</td>
		<td>
			<?php echo $mdl->header->numbodyparts;?>
		</td>
	</tr>
	<tr valign="top">
		<td class="row" width="200">
			Attachments:
		</td>
		<td>
			<?php echo $mdl->header->numattachments;?>
		</td>
	</tr>
	<tr valign="top">
		<td class="row" width="200">
			Transitions:
		</td>
		<td>
			<?php echo $mdl->header->numtransitions;?>
		</td>
	</tr>
	<tr>
		<td class="row" colspan="3">
			<?php
			$this->widget('CTabView', array(
				'htmlOptions'=>array('class'=>'tabs'),
				'tabs'=>array(
					array('title'=>'Скриншоты', 'content'=>'<div style="text-align:center;">'.$imgs.'</div>', 'active'=>true),
					array('title'=>'Просмотр', 'content'=>$this->renderpartial('_mdl_view',array('model'=>$model),true)),
					//array('title'=>'Sequence', 'content'=>$this->renderpartial('/site/game/_mdl_studioseq',array('model'=>$model),true)),
					//array('title'=>'Body', 'content'=>$this->renderpartial('/site/game/_mdl_body',array('model'=>$model),true)),
					//array('title'=>'Texture', 'content'=>$this->renderpartial('/site/game/_mdl_texture',array('model'=>$model),true)),
					//array('title'=>'QC', 'content'=>$this->renderpartial('/site/game/_mdl_qc',array('model'=>$model),true)),
				),
			));
			?>
		</td>
	</tr>
</table>
