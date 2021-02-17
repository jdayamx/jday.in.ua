<?php
$this->breadcrumbs=array(
	'Список игровых карт'=>array('index'),
	$model->mapname,
);

$this->widget('application.extensions.fancybox.EFancyBox', array(
    'target'=>'a[rel=gallery]',
    'config'=>array(),
    )
);
$this->widget('application.extensions.fancybox.EFancyBox', array(
    'target'=>'a[rel=screen]',
    'config'=>array(),
    )
);

$this->pageKeywords = 'Детали карты '.$model->mapname.', скачать карту '.$model->mapname.', сервер '.$model->gamename.', мод '.$model->gamemod.', '.$model->size;
$this->pageTitle= Yii::app()->name . ' - описание карты '.$model->mapname;
$this->pageDescription = 'Детали карты '.$model->mapname.' (описание, характеристики, скриншоты, текстуры)';

$this->layout='column2';
//$res =Yii::app()->db->createCommand('select gamename FROM `maps_download` group by gamename')->queryColumn();
$res = Yii::app()->cache->get('lmanu');
if ($res === false) {
	$res =Yii::app()->db->createCommand('select gamename,count(id) as count FROM `maps_download` where is_download = 1 group by gamename')->queryAll();
	Yii::app()->cache->set('lmanu', $res, 30);
}
$items = '';
$allmaps = 0;
foreach($res as $gm) {
		$gn = $gm['gamename'];
	$title='';
	if (mb_strlen($gn)>30) {
		$gn = mb_substr($gn,0,30).'..';
		$title = $gm['gamename'];
	}
	if(CHtml::encode($_GET['gamename'])==CHtml::encode($gm['gamename'])) {
		$items .= '<div style="font-size:10px;background:darkred;color:lightgray;">'.$gn.'<small style="color:lightgray;float:right;">('.$gm['count'].')</small></div>';
	} else {
		$items .= CHtml::link($gn.'<small style="color:darkred;float:right;">('.$gm['count'].')</small>',array('mapsd/index','MapsDownload[gamename]'=>$gm['gamename']),array('style'=>'font-size:10px;','title'=>$title));
	}
	$allmaps += $gm['count'];
}
$this->left_menu = '<table class="table-choc border">';
$this->left_menu .= '<tr><td class="header green">Игры (всего: '.$allmaps.' карт)</td></tr><tr><td class="menu">';

$this->left_menu .= $items;
$this->left_menu .= '</td></tr></table>';

$this->left_menu .='<br><div id="new_form"></div>';

$this->image = 'https://jday.in.ua'.$model->FirstImg;
?>
<div id="map<?=$model->id;?>">
<table class="table-choc border">
<tr>
<td class="header" colspan="2">Детали карты  <?php  echo $model->mapname;?></td>
</tr>
<tr>
	<td class="row" width="164" style="vertical-align:top;"><?=$model->CoverImage;?></td>
	<td class="row_in">
		<table>
			<tr>
				<td class="row" style="text-align:right;" width="120">Hазвание</td><td><?php  echo $model->mapname;?></td>
			</tr>
			<tr>
				<td class="row" style="text-align:right;" width="120">Игра</td><td ><?php  echo $model->gamename;?></td>
			</tr>
			<tr>
				<td class="row" style="text-align:right;" width="120">Мод</td><td ><?php  echo $model->gamemod;?></td>
			</tr>
			<tr>
				<td class="row" style="text-align:right;" width="120">Размер</td><td ><?php  echo  $model->size;?></td>
			</tr>
			<tr>
				<td class="row" style="text-align:right;" width="120">Скачать</td><td ><?php  echo  $model->download_file;?></td>
			</tr>
			<tr>
				<td class="row" style="text-align:right;" width="120">XML</td><td ><?php  echo  CHtml::Link($model->mapname.'.xml',array('mapsd/xml','id'=>$model->id));?></td>
			</tr>
		</table>
	</td>
</tr>
<tr>
	<td class="header" colspan="2">Скриншоты для карты <?php  echo $model->mapname;?></td>
</tr>
<tr>
	<td colspan="2"><?php  echo $model->Screens;?></td>
</tr>
<tr>
	<td class="header" colspan="2" >Информация о файле</td>
</tr>
<tr>
	<td colspan="2">
		<?
			echo $model->FileInfo;
		?>
	</td>
</tr>
<?php
	//----------------------------------CS Source-------------------------------
	if(in_array($model->gamename,array('CSPromod','Counter-Strike: Source','Day of Defeat: Source','Half-Life 2: Deathmatch','Half-Life 2','Zombie Panic: Source','Garry\'s Mod', 'Team Fortress 2'))) {
?>
<tr>
	<td colspan="2" class="footer" id="mapd<?=$model->id;?>">
		<?
			if(!$model->info) echo CHtml::ajaxButton('Обновить данные', array('mapsd/UpdateParams2','id'=>$model->id), array(
    			'update' => '#mapd'.$model->id,
    			'beforeSend' => 'function(){$("#overlay").addClass("loading");}',
    			'complete' => 'function(){$("#overlay").removeClass("loading");}',
				));

			if ($model->info) {				$this->renderpartial('_params2', array('data'=>unserialize(base64_decode($model->info))));
			} else {
				echo ' Нет данных';
			}
		?>
	</td>
</tr>

<?php
}
?>
<?php
	if(in_array($model->gamename,array('Natural Selection','Team Fortress Classic', 'Counter-Strike 1.6','Half-Life','Half-Life: Rally','Counter-Strike 1.5','Day of Defeat','Counter-Strike: Condition Zero','Deathmatch Classic','Half-Life: Opposing Force','BrainBread','Sven Coop'))) {
?>
<tr>
	<td colspan="2" class="row" id="mapd<?=$model->id;?>">
		<?
			if(!$model->info) echo CHtml::ajaxButton('Обновить данные', array('mapsd/UpdateParams','id'=>$model->id), array(
    			'update' => '#mapd'.$model->id,
    			'beforeSend' => 'function(){$("#overlay").addClass("loading");}',
    			'complete' => 'function(){$("#overlay").removeClass("loading");}',
				));

			if ($model->info) {
				$this->renderpartial('_params', array('model'=>$model,'data'=>unserialize(base64_decode($model->info))));
			} else {
				echo ' Нет данных';
			}
		?>
	</td>
</tr>

<?php
}
?>
</table>
<br>
<?php
if (Yii::app()->user->isAdmin) {	$managment = $model->managment;	if($managment) {
		$path_to_file = realpath('').DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'map'.DIRECTORY_SEPARATOR.'file'.DIRECTORY_SEPARATOR.$model->filename;
		$managment->LoadFile($path_to_file);
		echo '<pre>'.print_r($managment, true).'</pre>';
	}}

?>
</div>