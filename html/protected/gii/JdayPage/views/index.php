<?php
$class=get_class($model);
Yii::app()->clientScript->registerScript('gii.crud',"
$('#{$class}_controller').change(function(){
	$(this).data('changed',$(this).val()!='');
});
$('#{$class}_model').bind('keyup change', function(){
	var controller=$('#{$class}_controller');
	if(!controller.data('changed')) {
		var id=new String($(this).val().match(/\\w*$/));
		if(id.length>0)
			id=id.substring(0,1).toLowerCase()+id.substring(1);
		controller.val(id);
	}
});
");


foreach(glob(Yii::getPathOfAlias('application.models').DIRECTORY_SEPARATOR.'*.php') as $filename){
    $info = pathinfo($filename);
    $models[$info['filename']] = $info['filename'];
}
ksort($models);

foreach(glob(Yii::getPathOfAlias('application.modules').DIRECTORY_SEPARATOR.'*') as $filename){
    $info = pathinfo($filename);
   // $modules[$info['dirname'].DIRECTORY_SEPARATOR. $info['filename'].DIRECTORY_SEPARATOR] = $info['filename'];
   $modules[$info['filename']] = $info['filename'];
   // echo '<pre>'.print_r($info,true).'</pre>';
    //echo $info['filename']."<br/>";
}

?>
<h1>JDay Theme page Generator 1.0</h1>

<p>Приблуда генерирует странички на сайт как мне надо.</p>

<?php $form=$this->beginWidget('CCodeForm', array('model'=>$model)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'module'); ?>
		<?php
			echo $form->dropDownList($model,'module',$modules,array('empty'=>'-- Пусто --'))
		//echo $form->textField($model,'model',array('size'=>65));
		?>
		<div class="tooltip">
			Список модулей автоматом подтягивается с <code>application.modules</code> не обязательный параметр, но если выберешь, то вся фигня сгенерится в этом модуле
		</div>
		<?php echo $form->error($model,'module'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'model'); ?>
		<?php
			echo $form->dropDownList($model,'model',$models,array('empty'=>'-- Пусто --'))
		//echo $form->textField($model,'model',array('size'=>65));
		?>
		<div class="tooltip">
			Список моделей автоматом подтягивается с <code>application.models</code>
		</div>
		<?php echo $form->error($model,'model'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'controller'); ?>
		<?php echo $form->textField($model,'controller',array('size'=>65)); ?>
		<div class="tooltip">
			Controller ID is case-sensitive. CRUD controllers are often named after
			the model class name that they are dealing with. Below are some examples:
			<ul>
				<li><code>post</code> generates <code>PostController.php</code></li>
				<li><code>postTag</code> generates <code>PostTagController.php</code></li>
				<li><code>admin/user</code> generates <code>admin/UserController.php</code>.
					If the application has an <code>admin</code> module enabled,
					it will generate <code>UserController</code> (and other CRUD code)
					within the module instead.
				</li>
			</ul>
		</div>
		<?php echo $form->error($model,'controller'); ?>
	</div>

	<div class="row sticky">
		<?php echo $form->labelEx($model,'baseControllerClass'); ?>
		<?php echo $form->textField($model,'baseControllerClass',array('size'=>65)); ?>
		<div class="tooltip">
			This is the class that the new CRUD controller class will extend from.
			Please make sure the class exists and can be autoloaded.
		</div>
		<?php echo $form->error($model,'baseControllerClass'); ?>
	</div>

<?php $this->endWidget(); ?>
