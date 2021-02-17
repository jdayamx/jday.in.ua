<?php

class BrandController extends Controller
{
	public $layout = "//layouts/column1" ;
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('CarBrand',array(
			'pagination'=>array(
				'pageSize'=>1000,
			),
			'sort'=>array(
				'defaultOrder'=>'name_en'
			),
		));
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
	}
}