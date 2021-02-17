<style>
* {	font-family:Cursive;
	color: yellow;
}

.boy {		text-shadow: 	3px 3px 0px #aeaeff,
					3px 0px 0px #aeaeff,
					0px 3px 0px #aeaeff,
					-3px 3px 0px #aeaeff,
					-3px 0px 0px #aeaeff,
					-3px -3px 0px #aeaeff,
					0px -3px 0px #aeaeff,
					3px -3px 0px #aeaeff
					;
}
.girl {
	text-shadow: 	3px 3px 0px #ffaeae,
					3px 0px 0px #ffaeae,
					0px 3px 0px #ffaeae,
					-3px 3px 0px #ffaeae,
					-3px 0px 0px #ffaeae,
					-3px -3px 0px #ffaeae,
					0px -3px 0px #ffaeae,
					3px -3px 0px #ffaeae
					;
}
</style>
<?php

$this->layout = 'clear';

foreach(SPeople::model()->findAll() as $p) {	$this->renderPartial('_p_list', array('data'=>$p));}
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
