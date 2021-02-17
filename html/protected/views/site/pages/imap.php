<?php
//require_once "Imap.php";
Yii::import("application.components.MailSo.MailSo", true);

//$mailbox = 'mail.sunline.net.ua';
//$username = 'jday@sunline.net.ua';
//$password = 'voodoo';
//$mailbox = 'mail.proline.net.ua';
//$username = 'noc2@proline.net.ua';
//$password = 'Kw67KLAI';
//$encryption = 'tls'; // or ssl or ''

//	include '../lib/MailSo/MailSo.php';

	$oLogger = \MailSo\Log\Logger::SingletonInstance()->Add(\MailSo\Log\Drivers\Inline::NewInstance("\r\n", true));

	$oData = null;
	try
	{
		$oMailClient = \MailSo\Mail\MailClient::NewInstance()/*->SetLogger($oLogger)*/;
		$oData = $oMailClient->Connect('mail.proline.net.ua', 143, \MailSo\Net\Enumerations\ConnectionSecurityType::AUTO_DETECT)
			->Login('noc2@proline.net.ua', 'Kw67KLAI')->MessageList('INBOX',0,50);


	}
	catch (Exception $e)
	{
		var_dump($e);
	}

    echo '<table class="table">';
	         //Message($sFolderName, $iIndex,
	foreach($oData->GetAsArray() as $d) {		$to_users = array();		//echo '<pre>';
		//echo $d[sFolder:MailSo\Mail\Message];
		echo '<tr>';
		echo '<th colspan="4">[Uid:'.$d->Uid().'] '.$d->Subject().'</th>';
		echo '</tr>';

		echo '<tr>';
		foreach($d->To()->ToArray() as $too) {			$to_users[] =  $too[1];		}
		echo '<td width="220">'.$d->From()->ToArray()[0][1].' ---> '.implode(', ',$to_users)./*''.(($cc = $d->Cc())?','.$cc->ToArray()[0][1]:'').print_r($d->to(),true).*/'</td>';
		echo '<td>'.date('Y-m-d H:i',$d->HeaderTimeStampInUTC()).'</td>';
		//echo '<td>'.$d->ContentType().'</td>';
		echo '<td>';
		$msg = $oMailClient->Message($d->Folder(),$d->Uid());
		$txt = $msg->Html();
		if(!$txt) {			$txt = '<pre>'.$msg->Plain().'</pre>';		} else {			$txt = '<pre>'.preg_replace('/[\r\n]+/u',"\r",strip_tags(preg_replace('|<style\b[^>]*>(.*?)</style>|s','',str_replace(array('<br>','<br/>','<br />'),"\r\n",$txt)))).'</pre>';		}

		echo $txt;		//print_r($d->Uid());
		echo '</td>';
		echo '</tr>';	}
	echo '</table>';
	$oMailClient->LogoutAndDisconnect();
