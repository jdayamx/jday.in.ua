<?php
/* @var $this UtilsController */

$this->breadcrumbs=array(
	'Утилиты'=>array('/utils'),
	'Генератор IpTables',
);

$form=$this->beginWidget('CActiveForm', array(
	'id'=>'maps-download-form',
	'enableAjaxValidation'=>true,
)); ?>
<table class="table-choc border">
	<tr>
		<td class="header" colspan="2">Генератор IpTables</td>
	</tr>
	<tr>
		<td width="300" class="header yellow">Правила</td>
		<td class="header green">Результат</td>
	</tr>
	<tr valign="top">
		<td width="300">
		<label forid="sport" style="display:block;font-weight:bold;">Особые порты:</label>
		<table class="table-chock">
			<tr><td class="row"><input maxlength=5 type="text" value="8080" id="special" style="width:96%"></td><td><?php echo CHtml::Button('Добавить',array('onclick'=>'add();'));?></td</tr>
			<tr><td colspan=2 id="sport"></td</tr>
		</table>


		<label forid="ports" style="display:block;font-weight:bold;">Порты по умолчанию:</label>
		<table class="table-chock">
			<tr>
				<td colspan=2>
					<?php echo CHtml::checkBoxList('ports',
				        $saved_select,
        				CHtml::listData(Ports::model()->findAll(array('order'=>'number')),'number','description'/*,'taskGroup.title'*/),
		        		array('checkAll'=>'Все', 'checkAllLast'=>true)
				    ); ?>
				</td
			</tr>
		</table>
		</td>
		<td id="iptable" height="600"></td>
	</tr>
	<tr>
		<td class="footer" colspan="2"><?php echo CHtml::Button('Генерировать',array('onclick'=>'send();')); ?></td>
	</tr>

</table>
<?php $this->endWidget(); ?>

<script type="text/javascript">

var i = 0;
function add() {
	var newport = $("#special").val();
	var newid= newport+i;
	$("#sport").append('<div id="i'+newid+'"><input value="'+newport+'" id="ports_'+newport+'" name="ports[]" type="checkbox"> <label for="ports_'+newport+'">доп. порт '+newport+' <a href="javascript:remove_p('+newid+');" style=\'color:red;\'>x</a></label><br></div>');
	i++;
}

function remove_p(id)
{
		//alert('i'+id);
		$("#i"+id).remove();
}

function send()
 {

   var data=$("#maps-download-form").serialize();


  $.ajax({
   type: 'POST',
    url: '<?php echo Yii::app()->createUrl("utils/iptables2",array('do'=>'gen')); ?>',
   data:data,
   beforeSend : function (){
                 $("#iptable").html("<image src='/img/loading.gif'>");
            },
	success:function(data){
            //alert(data.list);
            $("#iptable").html(data.list);
              },
  dataType:'json'
  });

}

</script>