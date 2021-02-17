<?php

foreach(Ubki::model()->findAll(array('condition')=>'DATE(created)>="2015-02-19"') as $ubki) {	$_data = json_decode(json_encode(simplexml_load_string($ubki->receive_data)));
	$reqid = (string) $_data->tech->sentdatainfo->{'@attributes'}->reqid;	echo $reqid.'<br>';}

?>