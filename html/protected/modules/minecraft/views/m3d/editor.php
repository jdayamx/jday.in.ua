<?php
$this->pageTitle=Yii::app()->name . ' - minecraft 3D editor';
$this->breadcrumbs=array(
    'minecraft'=>array('/minecraft'),
	'3D editor',
);

// http://cssdeck.com/labs/html5-canvas-3d-cubes
?>
<style>
.table-choc .m3dwindow {
	padding:0;
	font-size:8px;
	color:#FFF;
	background-color:#222;
}
.table-choc .m3dwindow div {
	position:relative;
	background-color:#222;
	height:100%;
	//width:400px;

}

.table-choc .m3dwindow div img {
	width:10px;
}
.table-choc .m3dwindow canvas {
	background:#222;
	width:100%;
	height:100%;
	min-height:320px;
	margin:0;
}
</style>
<table class="table-choc border shadow">
	<tr class="head">
		<th colspan="2">3D objects editor</th>
	</tr>
	<tr>
		<td class="footer" colspan="2"><?php echo $this->buttons;?></td>
	</tr>
	<tr>
		<td class="m3dwindow c2 c3 c4" id="w1"><div><img src="/img/icons/television-icon.png" style="position:absolute;top:2px;left:2px;" onclick="FullScreen('w1', 'c1', 'canvas1');"><canvas id="canvas1">HTML5 CANVAS</canvas></div></td>
		<td class="m3dwindow c1 c3 c4" id="w2"><div><img src="/img/icons/television-icon.png" style="position:absolute;top:2px;left:2px;" onclick="FullScreen('w2', 'c2', 'canvas2');"><canvas id="canvas2">HTML5 CANVAS</canvas></div></td>
	</tr>
	<tr>
		<td class="m3dwindow c1 c2 c4" id="w3"><div><img src="/img/icons/television-icon.png" style="position:absolute;top:2px;left:2px;" onclick="FullScreen('w3', 'c3', 'canvas3');"><canvas id="canvas3">HTML5 CANVAS</canvas></div></td>
		<td class="m3dwindow c1 c2 c3" id="w4"><div><img src="/img/icons/television-icon.png" style="position:absolute;top:2px;left:2px;" onclick="FullScreen('w4', 'c4', 'canvas4');"><canvas id="canvas4">HTML5 CANVAS</canvas></div></td>
	</tr>
	<tr>
		<td colspan="2">
		Tests:
		<pre>
			<?php
				print_r($canvas);
			?>
		</pre>
		</td>
	</tr>
</table>

<script>


	var c1=document.getElementById('canvas1');
	c1.width  = 482;
	c1.height = 323;
	var ctx1=c1.getContext('2d');
	ctx1.font='22px Arial';
	ctx1.fillStyle = 'rgba(255,200,255,0.5)';

	ctx1.fillText('c1',20,20);

	var c2=document.getElementById('canvas2');
	c2.width  = 482;
	c2.height = 323;
	var ctx2=c2.getContext('2d');
	ctx2.font='22px Arial';
	ctx2.fillStyle = 'rgba(255,255,255,0.5)';
	ctx2.fillText('c2 Привет',20,20);

	var c3=document.getElementById('canvas3');
	c3.width  = 482;
	c3.height = 323;
	var ctx3=c3.getContext('2d');
	ctx3.font='22px Arial';
	ctx3.fillStyle = 'rgba(255,255,00,0.5)';
	ctx3.fillText('c3',20,20);

	var c4=document.getElementById('canvas4');
	c4.width  = 482;
	c4.height = 323;
	var ctx4=c4.getContext('2d');
	ctx4.font='22px Arial';
	ctx4.fillStyle = 'rgba(200,255,255,0.5)';
	ctx4.fillText('c4 Привет',20,20);

	function FullScreen(window, obj, canvas) {
		$('.'+obj).toggle();
		var c=document.getElementById(canvas);

		//var win=document.getElementById(window);

		//c.width = $('#'+window).innerWidth();
  		//c.height = $('#'+window).innerHeight();
       	if($('.'+obj).css('display') == 'none') {
       		c.width  = 965;
       		c.height  = 648;
       	} else {
       		c.width  = 482;
       		c.height  = 323;
       	}

		//c.height = 965;
		var ctx=c.getContext('2d');
		ctx.font='22px Arial';
		var r = Math.floor((Math.random() * 255) + 1);
		var g = Math.floor((Math.random() * 255) + 1);
		var b = Math.floor((Math.random() * 255) + 1);
		ctx.fillStyle = 'rgba('+r+','+g+','+b+',0.5)';
		ctx.fillText(obj+ ' [x:'+ $('#'+window).innerWidth()+', y:'+$('#'+window).innerHeight()+']',20,20);
		//alert($('#'+window).innerWidth());

	}

</script>