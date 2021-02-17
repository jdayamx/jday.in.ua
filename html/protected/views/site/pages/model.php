	<script type="text/javascript" src="/js/hl1/jquery.js"></script>
    <script type="text/javascript" src="/js/hl1/binFile.js"></script>
    <script type="text/javascript" src="/js/hl1/glMatrix.js"></script>
    <script type="text/javascript" src="/js/hl1/glUtil.js"></script>
    <script type="text/javascript" src="/js/hl1/js-struct.js"></script>
    <script type="text/javascript" src="/js/hl1/utils.js"></script>
    <script type="text/javascript" src="/js/hl1/hlmdl.js"></script>
	<script type="text/javascript" src="/js/hl1/model.js"></script>

   <!-- Shaders -->
    <script id="lightmap-vs" type="x-shader/x-vertex">
        #ifdef GL_ES
        precision highp float;
        #endif

        attribute vec3 position;
        attribute vec2 texCoord;
        attribute vec2 texCoord2;

        varying vec2 vTexCoord;
        varying vec2 vLightmapCoord;

        uniform mat4 modelViewMat;
        uniform mat4 projectionMat;

        void main(void) {
        vTexCoord = texCoord;
        vLightmapCoord = texCoord2;

        vec4 worldPosition = modelViewMat * vec4(position, 1.0);
        gl_Position = projectionMat * worldPosition;
        }
    </script>

    <script id="lightmap-fs" type="x-shader/x-fragment">
        #ifdef GL_ES
        precision highp float;
        #endif

        varying vec2 vTexCoord;
        varying vec2 vLightmapCoord;

        uniform float alpha;
        uniform sampler2D diffuse;
        uniform sampler2D lightmap;

        void main(void) {
        vec4 diffuseColor = texture2D(diffuse, vTexCoord.st);
        vec4 lightColor = texture2D(lightmap, vLightmapCoord.st);

        //gl_FragColor = vec4(diffuseColor.rgb * lightColor.rgb, diffuseColor.a * alpha);
        gl_FragColor = vec4(diffuseColor.rgb * lightColor.rgb, diffuseColor.a * alpha);
        }
    </script>

<table class="table-choc border shadow">
<tr>
<td class="header" colspan="2">
Демонстрация модели
</td>
</tr>
<tr valign="top">
<td class="row_in">
<canvas id="viewport"></canvas>
<div id = "screenshot"></div>
</td>
<td width="160">
<div id="log"></div><div id="info"></div>
<input onclick="m.zAngle=3.415;m.xAngle=0;m.yAngle=0;m.cameraPosition = [-109,-338,-55];" value="Left" type="button" style="width:140px;margin-bottom:5px;">
<input onclick="m.zAngle=0;m.xAngle=0;m.yAngle=0;m.cameraPosition = [109,338,-55];" value="Right" type="button" style="width:140px;margin-bottom:5px;">
<input onclick="m.zAngle=3.465;m.xAngle=1.545;m.yAngle=0;m.cameraPosition = [-9.33,2.35,-440];" value="Top" type="button" style="width:140px;margin-bottom:5px;">
<input onclick="m.zAngle=1.89;m.xAngle=0;m.yAngle=0;m.cameraPosition = [448,-186.42,-78.76];" value="Back" type="button" style="width:140px;margin-bottom:5px;">
<input onclick="m.zAngle=5;m.xAngle=0;m.yAngle=0;m.cameraPosition = [-448,186.42,-78.76];" value="Front" type="button" style="width:140px;margin-bottom:5px;">
<?php
echo CHtml::ajaxButton('Screentshot',Yii::app()->createUrl('site/makescreenshot'),
                    array(
                        'type'=>'POST',
                        'data'=> 'js:{"data": document.getElementById("viewport").toDataURL("image/png").slice(22)}',
                        'success'=>'js:function(string){ $("#screenshot").append(string); }'
                    ),array('style'=>'width:140px;margin-bottom:5px;',));
?>

</td>
</tr>
</table>

<script type="text/javascript">
		m = new Model_view();

		//m.model = new HLMDL("models/trash_benzovoz_zil_lod1.mdl");
		//m.model = new HLMDL("models/st_bus_crash.mdl");

		//m.model = new HLMDL("models/st_firetruck.mdl");

		//m.model = new HLMDL("models/BA3_2106.mdl");
		//m.model = new HLMDL("models/gaz_szp_001.mdl");
  		//m.model = new HLMDL("models/StalkerS/truck_russian-large.mdl");
		//m.model = new HLMDL("models/qloader.mdl");

		m.model = new HLMDL("models/forge_tree1.mdl");

		//m.model = new HLMDL("models/StalkerS/spawn/sp_travka1.mdl");
		//m.model = new HLMDL("models/zps_warehouse_shelfes2.mdl");
		//m.model = new HLMDL("models/props/humvee_jungle.mdl");
		//m.model = new HLMDL("models/props/blackhawk-downed-new.mdl");
		//m.model = new HLMDL("models/player/arctic/arctic.mdl");
		//m.model = new HLMDL("models/ship.mdl");
		//m.model = new HLMDL("models/t34gray-left.mdl");
		//m.model = new HLMDL("models/train_vagon_elektro.mdl");
		//m.model = new HLMDL("models/MI-8.mdl");
		//m.model = new HLMDL("models/player/zombie_source/zombie_source.mdl");
		//m.model = new HLMDL("models/player/goblin/goblin.mdl");
		//m.model = new HLMDL("models/player/predator/predator.mdl");
		//m.model = new HLMDL("models/player/zp_human1/zp_human1.mdl");
</script>
