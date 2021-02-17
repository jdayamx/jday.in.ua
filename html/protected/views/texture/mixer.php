<?php

$this->breadcrumbs=array(
	'Texture'=>array('/texture'),
	'Создать поверхность',
);

$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile('/js/lib.js', CClientScript::POS_HEAD);
$cs->registerScriptFile('/js/DragManager.js', CClientScript::POS_HEAD);

$t = Yii::app()->cache->get('textures');
$tx = '';
if($t!==false) $tx = $this->renderpartial('_textures', array('model'=>$t), true);

$this->left_menu .='<div id="new_form">'.$tx.'</div>';

?>

<script>
    dragManager.onDragCancel = function(dragObject) {
      dragObject.avatar.rollback();
    };

    dragManager.onDragEnd = function(dragObject, dropElem) {
      dropElem.src = dragObject.elem.src;
      dragObject.elem.style.display = 'none';
      /*setTimeout(function() { dropElem.className = 'computer'; }, 200);*/
    };
  </script>

<table class="table-choc border">
	<tr>
		<td class="header" colspan="2">Создать поверхность</td>
	</tr>
	<tr>
		<td>
			<img src="/img/mask/transparent.png" droppable style="width:128px;border:2px solid #777;" id="texture1">
			<img src="/img/mask/transparent.png" droppable style="width:128px;border:2px solid #777;" id="texture2">
		</td>
		<td width="256" rowspan="2" id="preview_texture" style="min-height:256px;">
			<img src="/img/mask/transparent.png" style="width:256px;">
		</td>
	</tr>
	<tr>
		<td>
            <?php

            	for($i=1;$i<=23;$i++) {            		echo CHtml::ajaxLink(
	            		CHtml::image('/img/mask/m'.$i.'.png','m'.$i,array('style'=>'width:32px;border:2px solid #777;margin:2px;',)),
	            		array('texture/maketexture','mask'=>$i),
		            	array(
		            		'type'=>'POST',
		            		'data'=>array('t1'=>'js:$("#texture1").attr("src")','t2'=>'js:$("#texture2").attr("src")'),
		      				'update'=>'#preview_texture',
		          		)
	            	);            	}

            	/*
            	echo CHtml::ajaxLink(
            		CHtml::image('/img/mask/m1.png','m1',array('style'=>'width:32px;border:2px solid #777;margin:2px;',)),
            		array('texture/maketexture','mask'=>1),
	            	array(
	            		'type'=>'POST',
	            		'data'=>array('t1'=>'js:$("#texture1").attr("src")','t2'=>'js:$("#texture2").attr("src")'),
	      				'update'=>'#preview_texture',
	          		)
            	);

            	echo CHtml::ajaxLink(
            		CHtml::image('/img/mask/m2.png','m2',array('style'=>'width:32px;border:2px solid #777;margin:2px;',)),
            		array('texture/maketexture','mask'=>2),
	            	array(
	            		'type'=>'POST',
	            		'data'=>array('t1'=>'js:$("#texture1").attr("src")','t2'=>'js:$("#texture2").attr("src")'),
	      				'update'=>'#preview_texture',
	          		)
            	);

            	echo CHtml::ajaxLink(
            		CHtml::image('/img/mask/m3.png','m3',array('style'=>'width:32px;border:2px solid #777;margin:2px;',)),
            		array('texture/maketexture','mask'=>3),
	            	array(
	            		'type'=>'POST',
	            		'data'=>array('t1'=>'js:$("#texture1").attr("src")','t2'=>'js:$("#texture2").attr("src")'),
	      				'update'=>'#preview_texture',
	          		)
            	);

            	echo CHtml::ajaxLink(
            		CHtml::image('/img/mask/m4.png','m4',array('style'=>'width:32px;border:2px solid #777;margin:2px;',)),
            		array('texture/maketexture','mask'=>4),
	            	array(
	            		'type'=>'POST',
	            		'data'=>array('t1'=>'js:$("#texture1").attr("src")','t2'=>'js:$("#texture2").attr("src")'),
	      				'update'=>'#preview_texture',
	          		)
            	);

            	echo CHtml::ajaxLink(
            		CHtml::image('/img/mask/m5.png','m5',array('style'=>'width:32px;border:2px solid #777;margin:2px;',)),
            		array('texture/maketexture','mask'=>5),
	            	array(
	            		'type'=>'POST',
	            		'data'=>array('t1'=>'js:$("#texture1").attr("src")','t2'=>'js:$("#texture2").attr("src")'),
	      				'update'=>'#preview_texture',
	          		)
            	);

            	echo CHtml::ajaxLink(
            		CHtml::image('/img/mask/m6.png','m6',array('style'=>'width:32px;border:2px solid #777;margin:2px;',)),
            		array('texture/maketexture','mask'=>6),
	            	array(
	            		'type'=>'POST',
	            		'data'=>array('t1'=>'js:$("#texture1").attr("src")','t2'=>'js:$("#texture2").attr("src")'),
	      				'update'=>'#preview_texture',
	          		)
            	);

            	echo CHtml::ajaxLink(
            		CHtml::image('/img/mask/m7.png','m7',array('style'=>'width:32px;border:2px solid #777;margin:2px;',)),
            		array('texture/maketexture','mask'=>7),
	            	array(
	            		'type'=>'POST',
	            		'data'=>array('t1'=>'js:$("#texture1").attr("src")','t2'=>'js:$("#texture2").attr("src")'),
	      				'update'=>'#preview_texture',
	          		)
            	);

            	echo CHtml::ajaxLink(
            		CHtml::image('/img/mask/m8.png','m8',array('style'=>'width:32px;border:2px solid #777;margin:2px;',)),
            		array('texture/maketexture','mask'=>8),
	            	array(
	            		'type'=>'POST',
	            		'data'=>array('t1'=>'js:$("#texture1").attr("src")','t2'=>'js:$("#texture2").attr("src")'),
	      				'update'=>'#preview_texture',
	          		)
            	);

            	echo CHtml::ajaxLink(
            		CHtml::image('/img/mask/m9.png','m9',array('style'=>'width:32px;border:2px solid #777;margin:2px;',)),
            		array('texture/maketexture','mask'=>9),
	            	array(
	            		'type'=>'POST',
	            		'data'=>array('t1'=>'js:$("#texture1").attr("src")','t2'=>'js:$("#texture2").attr("src")'),
	      				'update'=>'#preview_texture',
	          		)
            	);
            	echo CHtml::ajaxLink(
            		CHtml::image('/img/mask/m10.png','m10',array('style'=>'width:32px;border:2px solid #777;margin:2px;',)),
            		array('texture/maketexture','mask'=>10),
	            	array(
	            		'type'=>'POST',
	            		'data'=>array('t1'=>'js:$("#texture1").attr("src")','t2'=>'js:$("#texture2").attr("src")'),
	      				'update'=>'#preview_texture',
	          		)
            	);
            	echo CHtml::ajaxLink(
            		CHtml::image('/img/mask/m11.png','m11',array('style'=>'width:32px;border:2px solid #777;margin:2px;',)),
            		array('texture/maketexture','mask'=>11),
	            	array(
	            		'type'=>'POST',
	            		'data'=>array('t1'=>'js:$("#texture1").attr("src")','t2'=>'js:$("#texture2").attr("src")'),
	      				'update'=>'#preview_texture',
	          		)
            	);
            	echo CHtml::ajaxLink(
            		CHtml::image('/img/mask/m12.png','m12',array('style'=>'width:32px;border:2px solid #777;margin:2px;',)),
            		array('texture/maketexture','mask'=>12),
	            	array(
	            		'type'=>'POST',
	            		'data'=>array('t1'=>'js:$("#texture1").attr("src")','t2'=>'js:$("#texture2").attr("src")'),
	      				'update'=>'#preview_texture',
	          		)
            	); */

            ?>


		</td>
	</tr>
</table>