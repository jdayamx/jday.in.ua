<?php

class User extends CActiveRecord
{	public $password2 = '';
	public $verifyCode;
	/**
	 * The followings are the available columns in table 'tbl_user':
	 * @var integer $id
	 * @var string $username
	 * @var string $password
	 * @var string $salt
	 * @var string $email
	 * @var string $profile
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, password2, email, phone', 'required'),
			array('username, password, salt, email', 'length', 'max'=>128),
			array('username', 'match', 'not' => true, 'pattern' => '/[^0-9a-zA-Z\-]/','message' => 'Допустимы только латинские буквы, цифры и -'),
			array('username', 'length', 'min'=>5),
			array('email','email'),
			array('email', 'checkemail'),
			array('password2', 'compare', 'compareAttribute'=>'password'),
			array('username', 'validateUsername'),
			array('profile, password2, icq, phone, code', 'safe'),
			array('verifyCode', 'captcha', 'allowEmpty'=>!extension_loaded('gd')),
		);
	}

	 public function validateUsername()
     {
		if(User::model()->exists('username=:username',array('username'=>$this->username)))
			$this->addError('username','Выберите другой логин, этот уже занят');
     }

     public function checkemail()
        {
            if(User::model()->exists('email=:email',array('email'=>$this->email)))
				$this->addError('email','Выберите другой почтовый адрес');
        }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'posts' => array(self::HAS_MANY, 'Post', 'author_id'),
			'domains' => array(self::HAS_MANY, 'DnsDomain', 'user_id'),
			'group' => array(self::BELONGS_TO, 'Group', 'group_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'username' => 'Имя пользователя',
			'password' => 'Пароль',
			'password2' => 'Пароль повторно',
			'salt' => 'Salt',
			'email' => 'Почта',
			'profile' => 'Profile',
			'verifyCode' => 'Код защиты',

		);
	}

	/**
	 * Checks if the given password is correct.
	 * @param string the password to be validated
	 * @return boolean whether the password is valid
	 */
	public function validatePassword($password)
	{
		return $this->hashPassword($password,$this->salt)===$this->password;
	}

	/**
	 * Generates the password hash.
	 * @param string password
	 * @param string salt
	 * @return string hash
	 */
	public function hashPassword($password,$salt)
	{
		return md5($salt.$password);
	}

	/**
	 * Generates a salt that can be used to generate a password hash.
	 * @return string the salt
	 */
	protected function generateSalt()
	{
		return uniqid('',true);
	}


	public static function Password_encode($text)
	{		return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($_SERVER["HTTP_HOST"].$_SERVER["SERVER_ADMIN"]), trim($text), MCRYPT_MODE_ECB));	}

	public static function Password_decode($code)
	{		return  trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($_SERVER["HTTP_HOST"].$_SERVER["SERVER_ADMIN"]), base64_decode($code), MCRYPT_MODE_ECB));
	}

	public function beforeSave() {		if($this->isNewRecord){
			$this->code = $this->Password_encode($this->password);
			$this->password = md5($this->password);
			$this->regdate = date('Y-m-d H:i:s');
		}
    	return parent::beforeSave();
	}

	/*
	$key = 'SuperSecretKey';

//To Encrypt:
$encrypted = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, 'I want to encrypt this', MCRYPT_MODE_ECB);

//To Decrypt:
$decrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $encrypted, MCRYPT_MODE_ECB);
	*/
	public function getGenPassword()
	{
		$chars="qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";
		$max=10;
		$size=StrLen($chars)-1;
		$password=null;
	    while($max--) {
	    	$password.=$chars[rand(0,$size)];
	    }
	    return $password;
	}

	public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('username',$this->username,true);
        $criteria->compare('password',$this->password,true);
        $criteria->compare('email',$this->email,true);
        $criteria->compare('profile',$this->profile,true);
        $criteria->compare('group_id',$this->group_id);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

}