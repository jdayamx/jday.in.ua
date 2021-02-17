<?php
class WorkerSendEmailCommand extends CConsoleCommand
{
    public function run() {
		# Создаем "воркера" и подключаемся к серверу задач
		$worker= new GearmanWorker();
		$worker->addServer('127.0.0.1');
		$worker->addFunction("SendEmail", 'WorkerSendEmailCommand::SendEmail');
		while (1)
		{
			echo date('Y-m-d H:i:s') . ' Waiting for job..';
			$ret= $worker->work();
			if ($worker->returnCode() != GEARMAN_SUCCESS)
			{
				echo 'Code['.$worker->returnCode().']: '.$worker->error ().PHP_EOL;
//				break;
			}
			Yii::app()->db->setActive(false); // отключаюсь от базы noc2
			Yii::app()->db_utm->setActive(false); // отключаюсь от базы биллинга
//			sleep (3);
		}

	}


	public function SendEmail($job) {
		$data = json_decode($job->workload());
	//	print_r($data);

		echo "\n" . date('Y-m-d H:i:s') . ' Got JOB: ' . $data->Subject . '..';

		$emails = $data->emails;

		$mailer = Yii::app()->mailer;

		$mailer->From = $data->From;
		$mailer->FromName = $data->FromName;
		$mailer->Subject = $data->Subject;
		$mailer->IsHTML();
		$mailer->IsSMTP();

		$mailer->Body = nl2br($data->Body);

//		$mailer->to = array();						// очищаю список емейлов
		$mailer->ClearAddresses();
		foreach ($emails as $email) {
			$mailer->AddAddress(trim($email));		// добавляю адресата к письму
		};

		$mailer->Send();							// отправляю письмо
		$mailer->SmtpClose();

		echo PHP_EOL.'-----------------------------------------------------'.PHP_EOL;
		return false;
	}


}

?>