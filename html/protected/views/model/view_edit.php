<?

$mdl = Yii::app()->mdl;
$mdl->Load($model->filename);

//CHtml::listDAta(ModelCategory::Tree(0)

if($mdl->header->version==10) {
?>
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
<?
}
?>
<?php

$this->breadcrumbs=array(
	'Список моделей'=>array('/model'),
	'Предмодерация '.$model->name,
);

foreach(ModelCategory::model()->findAll() as $cat) {
		if($cat->preg&&preg_match('/'.$cat->preg.'/ui',$model->name)) {
			$model->category_id = $cat->id;
			break;
		}
	}

//print_r($mdl->header->version);
?>

<table class="table-choc border shadow">
<tr>
<td class="header" colspan="2">
Предмодерация
</td>
</tr>
<tr valign="top">
<td class="row_in">
<?
if($mdl->header->version!=10) {	echo 'Эта модел версии '.$mdl->header->version.', на данный момент поддерживается только 10<br>';}?>
<canvas id="viewport" style="border-bottom:1px dashed #777;"></canvas>
<div id = "screenshot">
<?php
$files = glob(realpath('uploads/model').DIRECTORY_SEPARATOR.$model->created.DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.$model->id.'_*.png');
foreach($files as $file) {	$file = str_replace(realpath('uploads/model'),'/uploads/model',$file);
	echo CHtml::image($file,'screenshot '.$file,array('width'=>200));}
?>
</div>
</td>
<td width="160">
<div id="log"></div><div id="info"></div>
<input onclick="m.zAngle=3.415;m.xAngle=0;m.yAngle=0;m.cameraPosition = [-109,-338,-55];" value="Left" type="button" style="width:140px;margin-bottom:5px;">
<input onclick="m.zAngle=0;m.xAngle=0;m.yAngle=0;m.cameraPosition = [109,338,-55];" value="Right" type="button" style="width:140px;margin-bottom:5px;">
<input onclick="m.zAngle=3.465;m.xAngle=1.545;m.yAngle=0;m.cameraPosition = [0,0,-200];" value="Top" type="button" style="width:140px;margin-bottom:5px;">
<input onclick="m.zAngle=1.89;m.xAngle=0;m.yAngle=0;m.cameraPosition = [448,-186.42,-78.76];" value="Back" type="button" style="width:140px;margin-bottom:5px;">
<input onclick="m.zAngle=5;m.xAngle=0;m.yAngle=0;m.cameraPosition = [-448,186.42,-78.76];" value="Front" type="button" style="width:140px;margin-bottom:5px;">
<input onclick="gl.enable(gl.DEPTH_TEST);" value="GL Test On" type="button" style="width:140px;margin-bottom:5px;">
<input onclick="gl.disable(gl.DEPTH_TEST);" value="GL Test Off" type="button" style="width:140px;margin-bottom:5px;">
<?php
echo $mdl->header->version==10?CHtml::ajaxButton('Screentshot',Yii::app()->createUrl('/site/makescreenshot'),
                    array(
                        'type'=>'POST',
                        'data'=> 'js:{"data": document.getElementById("viewport").toDataURL("image/png").slice(22),"date":"'.$model->created.'","id":"'.$model->id.'"}',
                        'success'=>'js:function(string){ $("#screenshot").append(string); }'
                    ),array('style'=>'width:140px;margin-bottom:5px;',)):'';
?>





<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'model3d-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>



    <?php echo $form->errorSummary($model); ?>



        <?php echo $form->labelEx($model,'category_id'); ?><br>
        <?php echo $form->dropDownList($model,'category_id',CHtml::listDAta(ModelCategory::model()->findAll(array('condition'=>'pid <> 0','order'=>'name')),'id','name','p.name'),array('empty'=>'-пусто-')); ?>
        <?php echo $form->error($model,'category_id'); ?> <br><br>





        <?php echo $mdl->header->version==10?CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('style'=>'width:140px;')):''; ?>

<?php $this->endWidget(); ?>




</td>
</tr>
</table>
<?
if($mdl->header->version==10) {
?>
<script type="text/javascript">
		m = new Model_view();
		m.model = new HLMDL("model/<?php echo $model->created?>/<?php echo $model->name?>");
</script>
<?
}
?>