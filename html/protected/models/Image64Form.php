<?php
class Image64Form extends CFormModel
{
	public $url = 'http://';
	//public $width = 100;
	//public $height = 100;

	public function rules()
	{
		return array(
			array('url', 'required'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'url'=>'Ссылка',
			//'width'=>'Ширина',
			//'height'=>'Высота',
		);
	}
}
