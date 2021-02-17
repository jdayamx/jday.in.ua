<?php
$this->breadcrumbs=array(
	$this->module->name=>array('/admin/global/menu'),
	'Логи'
);

?>
<table class="table-choc border">
<tr>
<td class="header">Логи</td>
</tr>
<tr>
<td class="row_in">
<?php
	$content = $this->widget('zii.widgets.grid.CGridView',
        array(
        	'htmlOptions' => array('class' => 'table-choc'),
            'id'=>'Logs',
            'template' => '<table><tr><td class="row1"style="text-align:center;">{pager}</td></tr><tr><td class="row_in" style="text-align:center;">{items}</td></tr><tr><td class="row1" style="text-align:center;">{pager}</td></tr></table>',
            'summaryText'=>false,
            //'ajaxUrl'=>CController::createUrl("/admin/partnersStat/fillModel/"),
            'ajaxUpdate' => false,
            'dataProvider'=>$model->search(),
            'filter'=>$model,
            'nullDisplay'=>'-',
            'pager'=>array(
      		  'header'=>false,
		        'htmlOptions'=>array('class'=>'pager'),
		    ),
             'columns'=>array(
            // 'id',
             array(
             	'name'=>'text',
             	'type'=>'html',
             	'htmlOptions'=>array('style'=>'text-align:left;'),
             ),
             'username',
             'ip',
             'adddate',
  //           	array(
//				     'header'=>'№',
//				     'value'=>'$row+1',
//				     'cssClassExpression'=>'$data->RowStyle($row+1)',
//				),

//             	array(
                  //  'name'=>'name',
                  //  'header'=>'Номер акции',
                //    'type'=>'html',
                  //  'filter'=>false,
                  //  'value' =>'$data->BanDate',
//                    'cssClassExpression'=>'$data->RowStyle',
              //      'htmlOptions'=>array('width'=>'150'),
            //    ),
          //      'rounds',
        //        'frags',
      //          'deaths',
    //            'hhead',
  //              'generic',
//                array(
               // 	'name'=>'min',
             //   	'cssClassExpression'=>'row',
           //     )
             ),
),true);

	$tabs = array();
	foreach ($model->groups as $id=>$group)
	{		$tabs['tab'.$id] = array(
				            'title'=>$group,
				            'url'=>'/admin/global/logs?type='.$id,
				            'content'=>$content
		);	}

	$this->widget('CTabView',array(
    'activeTab'=>'tab'.($_GET['type']?intval($_GET['type']):0),
    'tabs'=>$tabs,
    'htmlOptions'=>array(
        'style'=>'width:100%;background:#EEE;',
        'class'=>'tabs',
    )
));


?>
</td>
</tr>
</table>