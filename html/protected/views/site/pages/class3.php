<style>
* {
	font-family:Cursive;
}

@media all {
	.page-break	{ display: none; }
}

@media print {
	.page-break	{ display: block; page-break-before: always; }
}

</style>
<?php

$this->layout = 'clear';
$n=1;
foreach(SPeople::model()->findAll() as $p) {
	$this->renderPartial('_p_list2', array('data'=>$p));
	$n++;
    if($n == 11) {
    	$n=1;
    	echo '<div class="page-break"></div><br>';
    }
}
/*
    //$dataProvider=new CActiveDataProvider('SPeople');
    $model=new SPeople('search');
     $model->unsetAttributes();  // clear any default values
    if(isset($_GET['SPeople']))
     $model->attributes=$_GET['SPeople'];
   // $dataProvider->setData($model->cs_ubki_crm_values_accords);
    //echo "<pre>".print_r($model->cs_ubki_crm_values_accords,1)."</pre>";
    $this->widget('zii.widgets.CListView', array(
	'id'=>'plist',
	'template'=>'{items}',
    'dataProvider'=>$model->search(),
    'itemView'=>'_p_list',
));        */

?>
