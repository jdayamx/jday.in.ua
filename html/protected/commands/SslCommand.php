<?php
/*******************************************************************************
*							SSL Checker Console App v.1.00					   *
*******************************************************************************/
class SslCommand extends CConsoleCommand {
	private $version = '1.0.0';
	// ./certbot-auto --no-self-upgrade --noninteractive --nginx -d phpma1.jday.in.ua
	private $self_domains = [		
        'jday.in.ua',
        'tasks.teedex.net',
	];

	function getIsNeedUpdate($date) {
		if(strtotime($date)<=strtotime('NOW - 1 day')) 
			return true;
		return false;
	}

	public function actionCheck() {
		//$url = "https://www.google.com";
		//$url = "https://test.cabinet.globalcredit.ua";
		//$url = "https://jday.in.ua";
		//$url = "https://noc.jday.in.ua";
		//$url = "https://abook.jday.in.ua";
		echo 'Start check: '.date('Y-m-d H:i:s').PHP_EOL;
		foreach($this->self_domains as $domain) {
			$url = 'https://'.$domain;
			echo $url.' - ';
			$orignal_parse = parse_url($url, PHP_URL_HOST);
	    	$get = stream_context_create(array("ssl" => array("capture_peer_cert" => TRUE)));
	    	$read = stream_socket_client("ssl://".$orignal_parse.":443", $errno, $errstr, 30, STREAM_CLIENT_CONNECT, $get);
	    	$cert = stream_context_get_params($read);
			$certinfo = openssl_x509_parse($cert['options']['ssl']['peer_certificate']);
			$valid_to = date('Y-m-d',$certinfo['validTo_time_t']);
			$_needstoupdate = $this->getIsNeedUpdate($valid_to);
			echo 'valid to: '.$valid_to.', need update: '. ($_needstoupdate?'Yes':'No');
			if($_needstoupdate) {
				exec('/home/certbot-auto --no-self-upgrade --noninteractive --nginx -d '.$domain);
			}
			echo PHP_EOL;
		}
	    //print_R($certinfo);
	}
}