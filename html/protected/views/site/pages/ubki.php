<?php

foreach(Ubki::model()->findAll(array('condition')=>'DATE(created)>="2015-02-19"') as $ubki) {
	$reqid = (string) $_data->tech->sentdatainfo->{'@attributes'}->reqid;

?>