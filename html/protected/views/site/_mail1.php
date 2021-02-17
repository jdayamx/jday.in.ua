<html>
<header>
<style>

* {
	margin:0;
	width:100%;
	font-family:Tahoma;
}

</style>
</header>
<body>
	<div style="width:80%;margin:0 auto;margin-top:100px;padding:10px;">
		<h1 style="border-bottom: 2px solid #eeeeee;clear: both;">Популярные модели 3D</h1>
		<?php
			foreach(Model3d::model()->findAll(array('condition'=>'downloads>0 and mode=1','limit'=>20,'order'=>'RAND()')) as $model) {
				//echo '<pre>'.print_r($model->attributes,1).'</pre>';
				echo '<div style="float:left;border:2px solid #eeeeee;width:180px;height:150px;margin-top:10px;margin-right:10px;padding:10px;border-radius:5px;">'.$model->Logo.'</div>';
				//echo $model->Icon;
			}
		?>
		<h1 style="border-bottom: 2px solid #eeeeee;clear: both;">Популярные карты для игровых серверов</h1>
		<?php
			foreach(MapsDownload::model()->findAll(array('condition'=>'downloads>0','limit'=>20,'order'=>'RAND()')) as $model) {
			//	echo '<pre>'.print_r($model->attributes,1).'</pre>';
				echo '<div style="float:left;border:2px solid #eeeeee;width:180px;height:150px;margin-top:10px;margin-right:10px;padding:10px;border-radius:5px;">'.CHtml::image($model->FirstImg,'-',array('style'=>'width:172px;')).'</div>';
				//echo $model->Icon;
			}
		?>
	</div>
<body>
</html>