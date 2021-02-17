<?php
class ImageSlicingForm extends CFormModel
{
	public $url = 'http://';
	public $width = 100;
	public $height = 100;

	public function rules()
	{
		return array(
			array('url, width, height', 'required'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'url'=>'Ссылка',
			'width'=>'Ширина',
			'height'=>'Высота',
		);
	}
}
