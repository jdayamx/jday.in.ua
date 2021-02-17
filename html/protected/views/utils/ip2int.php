<?php

$this->breadcrumbs=array(
	'Утилиты'=>array('/utils'),
	'Ip утилиты',
);

$form=$this->beginWidget('CActiveForm', array(
	'id'=>'maps-download-form',
	'enableAjaxValidation'=>true,
)); 
?>
<table class="table-choc border">
	<tr>
		<td class="header" colspan="2">Ip утилиты
		</td>
		
	</tr>
	<tr>
		<td class="row" width="200"><label>Ip Адрес</label>
			<input name='ip' type="text" value="<?=$_SERVER['REMOTE_ADDR']?>" id="ip" style="width:96%">
			<label>Ip Адрес INT</label>
			<input name='ipi' type="text" value="<?=ip2long($_SERVER['REMOTE_ADDR'])?>" id="ipi" style="width:96%"><?php echo CHtml::Button('Calc',array('onclick'=>'send1();')); ?>
		</td>
		<td id="calc"><?php $this->actionip2int('calc');?></td>
	</tr>
	<tr>
		<td class="footer" colspan="2"><?php echo CHtml::Button('Calc',array('onclick'=>'send();')); ?></td>
	</tr>
</table>

<?php $this->endWidget(); ?>

<script type="text/javascript">



function send()
 {

   var data=$("#maps-download-form").serialize();


  $.ajax({
   type: 'POST',
    url: '<?php echo Yii::app()->createUrl("utils/ip2int",array('do'=>'calc')); ?>',
   data:data,
   beforeSend : function (){
                 $("#calc").html("<image src='/img/loading.gif'>");
            },
	success:function(data){
            //alert(data.list);
            $("#calc").html(data.list);
              },
 	 dataType:'json'
  });

}

function send1()
 {

   var data=$("#maps-download-form").serialize();


  $.ajax({
   type: 'POST',
    url: '<?php echo Yii::app()->createUrl("utils/ip2int",array('do'=>'calc')); ?>',
   data:data,
   beforeSend : function (){
                 $("#iptable").html("<image src='/img/loading.gif'>");
            },
	success:function(data){
            //alert(data.list);
            $("#ip").val(data.l2i);
              },
 	 dataType:'json'
  });

}

</script>