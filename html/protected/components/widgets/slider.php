<?php

class slider extends CWidget
{
	public $images = array();
	public function init()
	{
		$baseUrl = Yii::app()->baseUrl;
		$cs = Yii::app()->getClientScript();
        $id = time();
		$cs->registerScriptFile($baseUrl.'/js/jquery.cycle.all.js');
		$cs->registerScript('clientinfo_'.$id, "$('.slider_".$id."').cycle({
			delay:  3000,
		    speed:  500,
		    prev:   '#prev_".$id."',
		    next:   '#next_".$id."',
		    pager:  '#slide_pages_".$id."',
		    slideExpr: 'img',
		    before: function () {
		    	$('#slide_title_".$id."').html(this.alt);
		    }
		 });");

		echo '<style>
#next_'.$id.', #prev_'.$id.' {
	cursor:pointer;
}
#next_'.$id.' {
	background:#E1BF4E url(/img/arrow-right-icon.png) no-repeat center center;
}

#prev_'.$id.' {
	background:#E1BF4E url(/img/arrow-left-icon.png) no-repeat center center;
}
#slide_pages_'.$id.' a {
	margin:2px;
	font-size:10px;
	text-decoration:none;
	background:url(/img/shape-square-icon.png) no-repeat center center;
	padding:4px;

}

#slide_pages_'.$id.' a.activeSlide {
	background:url(/img/shape-square-icon-hover.png) no-repeat center center;
}



div.slider_'.$id.' {
 	height:299px;
 }
div.slider_'.$id.' img{
 	max-width:800px;
 	width:100%;
 }
</style>';
		echo '<table class="table-choc border">
	<tr>
		<td class="header" id="slide_title_'.$id.'" colspan="3">
			Слайды
        </td>
	</tr>
	<tr>
		<td class="row_in" colspan="3">
			<div class="slider_'.$id.'">';
		foreach($this->images as $image)
		{
			if($image['url']) {
			    if(is_array($image['url'])) {
			    	$params = array();
					foreach($image['url'] as $key=>$val) {
						if($key == '0') {
							$url_first = $val;
						} else {
							$params[$key] = $val;
						}
					}
			    	$url = Yii::app()->createUrl($url_first,$params);
			    } else {
			    	$url = $image['url'];
			    }
				echo '<a href="'.$url.'"><img src="'.$baseUrl.$image['img'].'" alt="'.$image['title'].'" width="100%" height="100%" border="0"></a>';
			} else {
				echo '<img src="'.$baseUrl.$image['img'].'" alt="'.$image['title'].'" width="100%" height="100%" border="0">';
			}


		}
	echo '</div>
        </td>
	</tr>
	<tr height="28">
		<td width=22 class="row" id="prev_'.$id.'">

        </td>
        <td class="green" id="slide_pages_'.$id.'">
        </td>
        <td width=22 class="row" id="next_'.$id.'">

        </td>
	</tr>
</table>';
	}
}