<?php

class coords {
	public $x;
	public $y;
	public $z;
}

class M3dController extends Controller {

	public $layout='//layouts/column2';
	public $dimention = 1;
	private $dimentions = array(
		0=>'5x5x5',
		1=>'5x5x10',
		2=>'10x10x10',
		3=>'10x20',
		4=>'20x20',
		5=>'20x40',
		6=>'40x40',
		7=>'60x60',
	);

	public function init() {
		$this->dimention = 2;
		return parent::init();
	}

	public function filters()
	{
		return array(
			'accessControl',
			'ajaxOnly + updateDimantion',
		);
	}

	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('updateDimantion'),
				'users'=>array('*'),
			),

		);
	}

	public function actionEditor()
	{
		$canvas = new coords;
		switch($this->dimention) {
			case '2':
				$canvas->x = 10;
				$canvas->y = 10;
				$canvas->z = 10;
			break;
			default:
				$canvas->x = 0;
				$canvas->y = 0;
				$canvas->z = 0;

		}

		$this->render('editor', array('canvas'=>$canvas));
	}

	public function actionUpdateDimantion()
	{
		echo 123;
	}

	public function getButtons() {
		$ret = '-';
		$ret = CHtml::dropDownList('Editor[dimention]',$this->dimention, $this->dimentions, array('empty'=>'--canvas Size --'));
		return $ret;
	}
}
?>