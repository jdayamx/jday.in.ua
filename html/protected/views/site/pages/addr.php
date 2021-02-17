<table class="table-choc border">
	<tr>
		<td class="header" colspan=3>
			Выбор адреса (test)
		</td>
	</tr>
	<tr>
		<td width="30%" class="row">
			<label for="Region_id">Область:</label><br>
			 <?php echo CHtml::DropDownList('Region','',CHtml::ListData(AddrRegion::model()->findAll(),'id','name_ru'),array('empty'=>'-- Выберите регион --', 'id'=>'Region_id', 'ajax'=>array(

			 	'url'=> CController::createUrl('/site/AjaxAddr'),
			 	'type'=>'GET',
			 	'dataType'=>'json',
			 	'data'=>'js:{do:"reg",id:$("#Region_id").val()}',
			 	'success'=>'function(data) {			 		//alert(data.get);
			 		if(data.attr == 1) {			 			$("#District_id").html(data.val);
			 			$("#District_id").attr("disabled",false);
			 			$("#Settlement_id").html(data.val2);
						$("#Settlement_id").attr("disabled","disabled");
		 			} else {		 				$("#District_id").html(data.val);
						$("#District_id").attr("disabled","disabled");
						$("#Settlement_id").html(data.val2);
						$("#Settlement_id").attr("disabled","disabled");
					}
			 	}'

			 ))); ?>
		</td>
		<td width="33%" class="row">
			<label for="District_id">Район:</label><br>
			 <?php echo CHtml::DropDownList('District','',array(),array('empty'=>'-- Выберите область --', 'id'=>'District_id',  'disabled'=>'disabled', 'ajax'=>array(

			 	'url'=> CController::createUrl('/site/AjaxAddr'),
			 	'type'=>'GET',
			 	'dataType'=>'json',
			 	'data'=>'js:{do:"dis",id:$("#District_id").val()}',
			 	'success'=>'function(data) {
			 		//alert(data.get);
			 		if(data.attr == 1) {
			 			$("#Settlement_id").html(data.val);
			 			$("#Settlement_id").attr("disabled",false);
		 			} else {
						$("#Settlement_id").html(data.val);
						$("#Settlement_id").attr("disabled","disabled");
					}

			 	}'

			 ))); ?>
		</td>
		<td width="33%" class="row">
			  <label for="Settlement_id">Населений пункт:</label><br>
			  <?php echo CHtml::DropDownList('Settlement','',array(),array('empty'=>'-- населенный пункт --', 'id'=>'Settlement_id', 'disabled'=>'disabled')); ?>
		</td>
	</tr>
</table>