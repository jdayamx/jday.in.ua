<?php
/* @var $this MapsdController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Список игровых карт'=>array('index'),
	//$gamename?('Все карты'=>array('index')):'Все карты',
	$gamename?$gamename:'Все',
);
foreach ($model as $data) {
	$maps[] = $data->mapname;
}
$this->pageKeywords = 'игровые карты, '.implode(', ',$maps);
$this->pageTitle= Yii::app()->name . ' - список карт для игр';
$this->pageDescription = 'Список игровых карт для скачивания, таких как: '.implode(', ',$maps);
$this->layout='column2';

$res = Yii::app()->cache->get('lmanu');
if ($res === false) {
	$res =Yii::app()->db->createCommand('select gamename,count(id) as count FROM `maps_download` where is_download = 1 group by gamename')->queryAll();
	Yii::app()->cache->set('lmanu', $res, 60);
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


$this->renderPartial('_search',array(
	'model'=>$model,
));

?>

<table class="table-choc border">
<tr>
<td class="header" colspan=3>Карты для игр</td>
</tr>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$model->search(),
	'itemsCssClass' => 'table-class',

	'itemView'=>'_view',
	'template'=>'<tr>
					<td class="row" style="text-align:center;">
						{pager}
					</td>
				</tr>
				<tr>
					<td style="text-align:center;padding:0px;">
						{items}
					</td>
				</tr>
				<tr>
					<td class="row" style="text-align:center;">
						{pager}
					</td>
				</tr>',
     'pager'=>array(
        'header'=>false,
        'htmlOptions'=>array('class'=>'pager'),
    ),
	));
 ?>
</table>
<br>
