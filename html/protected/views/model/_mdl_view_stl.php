<div style="text-align:center;">
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

	<script src="/js/stl/test.js"></script>
	<!-- render viewport -->
	<div id="solid-viewer" class="render-viewport" data-file="/uploads/model/<?php echo $model->created.'/'.$model->name;?>"></div>
	<!-- /render viewport -->
</div>