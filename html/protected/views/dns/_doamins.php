<?php
$this->widget('zii.widgets.grid.CGridView',
      array(
        	'htmlOptions' => array('class' => 'table-choc'),
            'pager'=>array('maxButtonCount'=>20),
            'summaryText'=>false,
            //'ajaxUrl'=>CController::createUrl("/admin/partnersStat/fillModel/"),
            'ajaxUpdate' => false,
            'dataProvider'=>$dataProvider,
            'nullDisplay'=>'-',
            'rowCssClassExpression'=>'$data->RowCssClass',
            'pager'=>array(
      		  'header'=>false,
		     //   'htmlOptions'=>array('class'=>'pager'),
		    ),
             'columns'=>array(
             	'name',
             	'mail',
             	'date_support',
             	array(
	    			'visible'=>(Yii::app()->user->Profile->id==$model->id?true:false),
	        	    'class'=>'CButtonColumn',
	    	        'template'=>'{save}{delete}',
	    	        'buttons'=>array(
		                'save' => array(
		                	'imageUrl'=>Yii::app()->request->baseUrl.'/img/icons/edit.png',
	    	                'url'=>'array("dns/update", "id"=>$data->id)',
	    	               // 'click'=>$js_preview,
	                    ),
	                    'delete' => array(
		                	'imageUrl'=>Yii::app()->request->baseUrl.'/img/icons/delete.png',
	    	                'url'=>'array("dns/delete", "id"=>$data->id)',
	    	               	'confirm'=>'Удалить домен и все его записи ?',
	                    ),
	             	),

		        ),
             )
      )
);

?>