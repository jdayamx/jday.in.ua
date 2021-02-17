<?php

switch($data->sex) {
	case 1:
		$background = '#ceceff url(/img/latest.png) no-repeat;background-position: 1cm 0.8cm;';
		$class = 'boy';
	break;
	case 2:
		$background = '#ffcece url(/img/dasha1mini.png) no-repeat;background-position: 1cm 0.8cm;';
		$class = 'girl';
	break;
	default:
		$background = '';
		$class = '';
}

echo '<div class="'.$class.'" style="background:'.$background.';border:2px solid #000;width:8.7cm;height:5.3cm;float:left;margin-right:50px;margin-bottom:50px;position:relative;z-index:-2;">';

echo '<div style="margin-top:0.8cm;text-align:center;font-size:48px;z-index:2;">'.$data->class->name.'</div>';
echo '<div style="margin-top:0.2cm;text-align:center;font-size:48px;z-index:2;">'.$data->fname.'</div>';
echo '<img src="/img/4123935.png" style="position:absolute;top:0;left:0;width:8.7cm;height:5.3cm;z-index:-1;">';
/*
echo '<pre>';
print_r($data->attributes);*/
echo '</div>';
?>
