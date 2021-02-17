<?php
Yii::app()->getClientScript()->registerCoreScript( 'jquery' );
Yii::app()->getClientScript()->registerCoreScript( 'jquery.ui' );

$this->breadcrumbs=array(
	'Texture'=>array('/texture'),
	$model->name,
);
$this->layout='column2';
	if($model->texture_category_id==1) {
	$this->left_menu = $this->renderpartial('_menu', array('model'=>$model), true);
	$this->left_menu .= '<br>';
}

$t = Yii::app()->cache->get('textures');
$tx = '';
if($t!==false) $tx = $this->renderpartial('_textures', array('model'=>$t), true);

$this->left_menu .= $this->renderpartial('_menu_maps', array('model'=>$model), true);
$this->left_menu .='<br><div id="new_form">'.$tx.'</div>';


//echo '<pre>'.print_r($textures,true).'</pre>';

?>

<table class="table-choc border">
<tr>
<td class="header">Детали текстуры  <?php  echo $model->name;?><div style="float:right;"><?php if($t!==false&&count($t)>=2) echo CHtml::link('Создать поверхность',array('texture/mixer'))?></div></td>
</tr>
<tr >
<?php
	if(Yii::app()->user->id == 1 && $model->type=='wad') {
		?>
	<tr>
		<td class="footer" id="zd">
         	<?php
         	echo CHtml::ajaxlink('Добавить кучку текстур',array('texture/adddata','id'=>$model->id),array('update'=>'#zd'));
         	?>
		</td>
	</tr>
		<?php
	}
?>
<td class="row" >
<div style="max-width:730px;">
<?php
$this->renderpartial('_'.$model->type,array('model'=>$model));
?>
</div>
</td>
</tr>
<?php
 if($model->Materials) {
?>
<tr>
<td class="footer"><b>Материалы:</b>
<?php
	foreach($model->Materials as $mat) {
		$mm[] = $mat->name;
	}
	echo implode(', ',$mm);
?></td>
</tr>

<?php
 }
?>
</table>