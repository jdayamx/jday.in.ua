<?php
class UkrposhtaCommand extends CConsoleCommand
{
	public $cols = 80;
	public $name = 'Сканер регионов УкрПочта v.1.0';

	public function actionIndex() {
		$startMemory = memory_get_usage();
		$base_path = realpath(dirname(__FILE__).'/../data');
		$tmp_path = $base_path.DIRECTORY_SEPARATOR.'tmp';
		$file = $tmp_path.DIRECTORY_SEPARATOR.'Ukrposhta.rar';
		if(!is_dir($tmp_path)) mkdir($tmp_path);
		echo str_repeat('*',$this->cols).PHP_EOL;
		echo '*'.str_repeat(' ',($this->cols/2)-((mb_strlen($this->name)/2)+1)).$this->name.str_repeat(' ',(round($this->cols/2))-((mb_strlen($this->name)/2)+1)).'*'.PHP_EOL;
		echo str_repeat('*',$this->cols).PHP_EOL;
		if(!is_file($file)) {
			file_put_contents($file,file_get_contents('http://services.ukrposhta.com/postindex_new/upload/postindex.rar'));
		}
		$rar = Yii::app()->rar;
		$info = $rar->infosRar($file);
		$xls_file_name = array_keys($info)[0];
		$xls_file = $tmp_path.DIRECTORY_SEPARATOR.$xls_file_name;
		if(!is_file($xls_file)) {
			$rar->extractRar ($file, $tmp_path,array(array_keys($info)[0]));
		}
		$data = Yii::app()->xls;
		$data->Load($xls_file);
		$first_element = true;
		foreach ($data->_Excel_Reader->sheets[0]['cells'] as $id=>$cell) {
			if($first_element) {
				$first_element = false;
				continue;
			}

			$find_Region = AddrRegion::model()->find(array('condition'=>'name_en=:ne AND name_ru=:nr AND name_uk=:nk','params'=>array(':ne'=>$cell[5],':nr'=>$cell[8],':nk'=>$cell[1])));
			if(!$find_Region) {
				$find_Region = new AddrRegion;
				$find_Region->name_en = $cell[5];
				$find_Region->name_ru = $cell[8];
				$find_Region->name_uk = $cell[1];
				$find_Region->save();
			}

			$find_District = AddrDistrict::model()->find(array('condition'=>'name_en=:ne AND name_ru=:nr AND name_uk=:nk AND region_id=:rid','params'=>array(':ne'=>$cell[6],':nr'=>$cell[9],':nk'=>$cell[2],':rid'=>$find_Region->id)));
   			if(!$find_District) {
   				$find_District = new AddrDistrict;
   				$find_District->region_id = $find_Region->id;
   				$find_District->name_en = $cell[6];
   				$find_District->name_ru = $cell[9];
   				$find_District->name_uk = $cell[2];
   				$find_District->save();
   			}

   			$find_Settlement = AddrSettlement::model()->find(array('condition'=>'name_en=:ne AND name_ru=:nr AND name_uk=:nk AND district_id=:did AND postal_code=:pc','params'=>array(':ne'=>$cell[7],':nr'=>$cell[10],':nk'=>$cell[3],':did'=>$find_District->id,':pc'=>$cell[4])));
   			if(!$find_Settlement) {
   				$find_Settlement = new AddrSettlement;
    	        $find_Settlement->district_id = $find_District->id;
	            $find_Settlement->name_en = $cell[7];
            	$find_Settlement->name_ru = $cell[10];
        	    $find_Settlement->name_uk = $cell[3];
    	        $find_Settlement->postal_code = $cell[4];
	            $find_Settlement->save();
            }
			print_r($cell);
			//if($id>3) break;
		}

		//print_r(realpath('../uploads'));
//		dirname(__FILE__)
//		echo $xls_file;
//		print_r();
		//$rar->extractRar ($model->PathFile, realpath('uploads/map/tmp'),array($arch_file));
		//http://services.ukrposhta.com/postindex_new/upload/postindex.rar
		echo memory_get_usage() - $startMemory, ' bytes'.PHP_EOL;
	}

}
?>