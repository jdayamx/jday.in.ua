<script src="https://api-maps.yandex.ru/1.1/index.xml?onerror=apifault" type="text/javascript"></script>

<?php

$this->breadcrumbs=array(
	'Список школ'=>array('child/school'),
	$model->name
);

$this->image = $model->image;
$this->pageTitle = $model->name;
$this->pageDescription = 'Как отправить ребёнка в школу '.$model->name;

$geocode_home = Yii::app()->cache->get('geocode_home');
if($geocode_home===false)
{
    $geocode_home = file_get_contents("https://geocode-maps.yandex.ru/1.x/?format=json&geocode=".urlencode('улица Архитектора Вербицкого, 14В, Украина, Киев'));
    Yii::app()->cache->set('geocode_home', $geocode_home);
}
$geo_home = json_decode($geocode_home);
$GeoObject_home = $geo_home->response->GeoObjectCollection->featureMember[0]->GeoObject;


$geocode = Yii::app()->cache->get('geocode_'.$model->id);
if($geocode===false)
{
    $geocode = file_get_contents("https://geocode-maps.yandex.ru/1.x/?format=json&geocode=".urlencode($model->address));
    Yii::app()->cache->set('geocode_'.$model->id, $geocode);
}
$geo = json_decode($geocode);
$GeoObject = $geo->response->GeoObjectCollection->featureMember[0]->GeoObject;
//echo '<pre>'.print_r($GeoObject->Point->pos, 1).'</pre>';

?>
<table class="table-choc border">
	<tr>
		<td class="header" colspan="2"><?php echo $model->name;?></td>
	</tr>
	<tr>
		<td class="row" width="20%" rowspan=5>
			<?php echo CHtml::image($model->image,$model->name,array("width"=>"220","height"=>"160"))?>
		</td>
		<td>
			<?php echo "<b>".CHtml::activeLabel($model,'address').":</b> ".$model->address;?>
		</td>
	</tr>
	<tr>
		<td>
		<?php echo "<b>".CHtml::activeLabel($model,'phone').":</b> ".$model->phone;?>
		</td>
	</tr>
	<tr>

		<td>
		<?php echo "<b>".CHtml::activeLabel($model,'url').":</b> ".CHtml::link($model->url,$model->url) ;?>
		</td>
	</tr>

	<tr>

		<td>
		<?php
		echo CHtml::link('от дома до школы ','https://yandex.ua/maps/143/kyiv/?origin=jsapi&ll='.urlencode(implode(',',explode(' ',$GeoObject_home->Point->pos))).'&z=17&l=map&mode=routes&rtext='.urlencode('улица Архитектора Вербицкого, 14В, Украина, Киев').'~'.urlencode($model->address).'&rtt=pd').$model->distance.'м, время пешком '.$model->time_togo .'мин.';?>
		</td>
	</tr>
	<tr>

		<td>
		<?php echo "<b>GPS:</b> ".$GeoObject->Point->pos ;?>
		</td>
	</tr>

	<tr>

		<td colspan=2>


				<script>
				YMaps.jQuery(function () {
	                // Создание экземпляра карты и его привязка к созданному контейнеру
	                var map = new YMaps.Map(YMaps.jQuery("#YMapsID")[0]);

	                var router = new YMaps.Router(
					       // Список точек, которые необходимо посетить
					       ['вулиця Архітектора Вербицького, 14В','<?php echo $GeoObject->Point->pos;?>'],
					       {
					       	viewAutoApply: true,
					       	strictBounds: true
					       }
					   );
					map.addOverlay(router);

	                // Установка для карты ее центра и масштаба
	                map.setCenter(new YMaps.GeoPoint(<?php echo implode(', ',explode(' ',$GeoObject->Point->pos))?>), 17);
	            });
				</script>
			<div id="YMapsID" style="width:100%;height:500px;background:#ccc"></div>
			</div>
		</td>
	</tr>
</table>