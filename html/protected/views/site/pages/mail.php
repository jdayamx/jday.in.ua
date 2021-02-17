<?php
$this->layout = 'clear';

$msg = $this->renderpartial('_mail1',array(),true, true);
echo $msg;

		$mailer = Yii::app()->mailer;
		$mailer->Subject = 'Рассылка портала jday.in.ua';
		$mailer->to = array();						// очищаю список емейлов
		$mailer->AddAddress('jday@teedex.net');
		$mailer->IsSMTP();
		$mailer->IsHTML();
		$mailer->Body = $msg;
		$rs = $mailer->Send();							// отправляю письмо
		$mailer->SmtpClose();

?>