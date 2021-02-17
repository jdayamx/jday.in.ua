<?php

class LostPassword extends CFormModel
{
	public $email;

	public function rules()
	{
		return array(
			array('email','length','max'=>256),
            array('email','email'),
            array('username', 'checkemail'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'email'=>'Почтовый ящик',
		);
	}

	public function checkemail()
        {
            if(!User::model()->exists('email=:email',array('email'=>$this->email)))
				$this->addError('email','Почтовый ящик не найден');
        }

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function send()
	{
		$tmp_user = User::model()->find('email=:email',array('email'=>$this->email));
		$email = Yii::app()->email;
		$email->from = Yii::app()->params['adminEmail'];
		$email->to = $this->email;
		$email->type = 'text/html';
		$email->subject = 'Password Recovery from '.Yii::app()->params['title'];
		$email->message = 'Привет '.$tmp_user->username.'!!!<br>';
		if (strlen(trim($tmp_user->code)) > 0 ) {
			$email->message .= 'Your password is "'.$tmp_user->Password_decode($tmp_user->code).'" without quotes<br>';
			$email->message .= 'Ваш пароль "'.$tmp_user->Password_decode($tmp_user->code).'" без кавычек.'.'<br>';
		} else {			$email->message .= 'К сожалению ваша учетная запись устарела, мы не смогли найти ваш пароль :(<br>';
			$email->message .= 'Но специально для Вас и только для <b>Вас</b> мы сгенерировали вам новый пароль<br>';
			$new_pass = $tmp_user->GenPassword;
			$tmp_user->password = md5(md5($new_pass));
			$tmp_user->code = $tmp_user->Password_encode($new_pass);
			$tmp_user->save(false);
			$email->message .= 'Your new password is "'.$new_pass.'" without quotes<br>';
			$email->message .= 'Ваш новый пароль "'.$new_pass.'" без кавычек.'.'<br>';		}
		$email->message .= '<b>Пароль был запрошен с IP-адреса:</b> '.$_SERVER['REMOTE_ADDR'].'<br>';
		$email->message .= '<b>Браузер пользователя:</b> '.$_SERVER["HTTP_USER_AGENT"].'<br>';

		if($email->send())
			return True;
		else
			return false;
	}
}
