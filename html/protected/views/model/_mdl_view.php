Клавиши управления: <b style="color:red;">A W D S СTRL Пробел + Мышка</b>
<div style="text-align:center;">
<script type="text/javascript" src="/js/hl1/binFile.js"></script>
    <script type="text/javascript" src="/js/hl1/glMatrix.js"></script>
    <script type="text/javascript" src="/js/hl1/glUtil.js"></script>
    <script type="text/javascript" src="/js/hl1/js-struct.js"></script>
    <script type="text/javascript" src="/js/hl1/utils.js"></script>
    <script type="text/javascript" src="/js/hl1/hlmdlw.js"></script>
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

        gl_FragColor = vec4(diffuseColor.rgb * lightColor.rgb, diffuseColor.a * alpha);
        }
    </script>

<canvas id="viewport"></canvas>
<script type="text/javascript">
		m = new Model_view();
		m.model = new HLMDL("model/<?php echo $model->created?>/<?php echo $model->name?>");
</script>
</div>