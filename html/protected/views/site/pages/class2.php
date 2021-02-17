<style>
* {
	font-family:Tahoma;
	font-size:26px;
}
</style>

<?php

$this->layout = 'clear';
echo '<center><b>Список 1-Б класу 2017/2018 рр.</b></center>';
foreach(SPeople::model()->findAll() as $p) {
	echo sprintf('%02s',($n+=1)).'. '.$p->sname.' '.$p->fname.' '.$p->mname.'<br>';
}

?>
