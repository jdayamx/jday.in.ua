<?php
/* @var $this ChildController */

$this->breadcrumbs=array(
	'Для детей'=>array('/child'),
	'Генератор раскрасок',
);
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerScript('print', "$('#print').printPage();");
$cs->registerScriptFile($baseUrl.'/js/jquery.printPage.js', CClientScript::POS_HEAD);
$blanks = array();
$blanks[1] = CHtml::image('/img/blank_1.png','Бланк 1');
$blanks[2] = CHtml::image('/img/blank_2.png','Бланк 2');
$blanks[4] = CHtml::image('/img/blank_3.png','Бланк 3');

?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'cf',
  //  'enableAjaxValidation'=>true,
)); ?>
<table class="table-choc border">
	<tr>
		<td class="header" colspan="2">Генератор раскрасок</td>
	</tr>
	<tr>
		<td class="footer" colspan="2">
			<?php
				echo '<span style="float:left;">'.(Yii::app()->user->isAllow('child/upload')?CHtml::Link('&nbsp;&nbsp;Загрузить&nbsp;&nbsp;',array('child/upload'),array('class'=>'bbcode')):'').'</span><span id="pp"></span> '.CHtml::Button('Генерировать',array('onclick'=>'send();'));
			?>
		</td>
	</tr>
	<tr>
		<td class="header green" width="250">
			Категории картинок
		</td>
		<td class="header yellow">
			Предварительный просмотр
		</td>
	</tr>
	<tr valign="top">
		<td class="row" width="220">
			<?php
				echo CHtml::checkBoxList('cat',2,CHtml::ListData(ChildColoringsCategory::model()->findAll(),'id','NameNums'));
				/*foreach(ChildColoringsCategory::model()->findAll() as $cat) {
					echo CHtml::
				}*/
			?>
			<hr>
			<?php
				echo CHtml::RadioButtonList('blank',1,$blanks);
				/*foreach(ChildColoringsCategory::model()->findAll() as $cat) {
					echo CHtml::
				}*/
			?>
		</td>
		<td id="List" class="row_in" style="background:#fff;height:850px;">

		</td>
	</tr>
</table>
<?php $this->endWidget(); ?>

<script type="text/javascript">

function send()
 {
  var data=$("#cf").serialize();
  $.ajax({type: 'POST', url: '<?php echo Yii::app()->createAbsoluteUrl("child/ajax"); ?>',
  	data:data,
   	beforeSend : function (){ $("#List").html("<img src='/img/loading.gif'>");},
	success:function(data){
            $("#List").html(data.page);
            $("#pp").html(data.print);

 	},
	dataType:'json'
  });

}

</script>