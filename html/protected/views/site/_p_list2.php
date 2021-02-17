<?php

	$background = 'transparent url(/img/doska.png) no-repeat';
	$class = '';


echo '<div class="'.$class.'" style="background:'.$background.';width:6.6cm;height:5cm;float:left;margin-right:100px;margin-bottom:23px;position:relative;z-index:-2;">';
$font_size = 24;
$margin_top = 2.7;
if(mb_strlen($data->sname)>16) {
	$font_size = 18;
	$margin_top = 2.9;
}
echo '<div style="margin-top:'.$margin_top.'cm;text-align:center;font-size:'.$font_size.'px;z-index:2;">'.$data->fname.'<br>'.$data->sname.'</div>';

/*
echo '<pre>';
print_r($data->attributes);*/
echo '</div>';
?>
