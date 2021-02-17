<?php

require_once(dirname(__FILE__).'/../components/simple_html_dom.php');

class OlxCarsCommand extends CConsoleCommand
{
	public function actionIndex() {
		while(true) {
			$this->Cars;
			echo PHP_EOL;
			echo 'Спим 30 сек...';
			sleep(30);
			echo PHP_EOL;
		}
	}

	public function getCars() {
		$upload_path = realpath('..').DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'car'.DIRECTORY_SEPARATOR;
		$content = file_get_html('http://olx.ua/transport/legkovye-avtomobili/');
		foreach($content->find('table.fixed') as $k=>$element) {
			$tmp_info[$k]['title'] = $element->find('td h3 span')[0]->innertext;
			$model = $element->find('td p small')[0]->innertext;
			$model = preg_match('~»(.+)\s<span~ui',$model, $ret);
			$tmp_info[$k]['mark'] = trim($ret[1]);
			if(!$tmp_info[$k]['mark']) continue;
			$tmp_info[$k]['from'] = $element->find('td p small span')[0]->innertext;
			$cost = $element->find('td.wwnormal div p strong')[0]->innertext;
			$tmp_info[$k]['cost'] = preg_replace('~[^\d]~ui','',$cost);
			$tmp_info[$k]['valuta'] = substr_count($cost,'грн')?'UAH':'USD';
			$tmp_info[$k]['img'] = $element->find('td span.rel a.thumb img')[0]->src;
			$tmp_info[$k]['url'] = $element->find('td h3.large a')[0]->href;
			preg_match('~{id:(\d+)}~ui',$element->find('td.tcenter div.rel a')[0]->class,$a_id);
			$tmp_info[$k]['id'] = trim($a_id[1]);//159829617
			if($tmp_info[$k]['id']) {
				$find_sid = CarSale::model()->findByAttributes(array('source_id'=>$tmp_info[$k]['id']));
				$need_upload = false;
			    if(!$find_sid) {
			    	$need_upload = true;
			    	$find_sid = new CarSale;
			    	$find_sid->source_id = trim($tmp_info[$k]['id']);
			    	$find_sid->title = trim($tmp_info[$k]['title']);
			    	$find_sid->from = trim($tmp_info[$k]['from']);
			    	$find_sid->cost = trim($tmp_info[$k]['cost']);
			    	$find_sid->source_url = trim($tmp_info[$k]['url']);
			    	$find_sid->currency = trim($tmp_info[$k]['valuta']);
			    	$find_sid->img_mini = 'data:image/jpeg;base64,'.base64_encode(file_get_contents($tmp_info[$k]['img']));

					sleep(1);
					$detail = file_get_html($tmp_info[$k]['url']);
					$tmp_info[$k]['photo'] = trim($detail->find('div.photo-handler img.vtop')[0]->src);
					$tmp_info[$k]['text'] = trim($detail->find('#textContent p.pding10')[0]->innertext);
                   	$find_sid->text = trim($tmp_info[$k]['text']);

					foreach($detail->find('div.img-item') as $k1=>$eld) {
						$tmp_info[$k]['photos'][] = trim($eld->find('div.photo-glow img')[0]->src);
					}

					foreach($detail->find('table.details') as $k1=>$eld) {
						foreach( $eld->find('td div.pding5_10') as $k2=>$eld2) {
							preg_match('~(.+)<strong class~ui',$eld2->innertext,$label);
							$info = $eld2->find('strong a')[0];
							if(!$info) $info = $eld2->find('strong')[0];
							$tmp_info[$k]['detail'][trim($label[1])] = trim($info->innertext);
						}
					}
					$find_sid->year = $tmp_info[$k]['detail']['Год выпуска:'];
					$find_sid->color = $tmp_info[$k]['detail']['Цвет:'];
					$find_sid->mileage = $tmp_info[$k]['detail']['Пробег:'];
					$find_sid->condition = $tmp_info[$k]['detail']['Состояние машины:'];
					$find_sid->displacement = $tmp_info[$k]['detail']['Объем двигателя:'];
					$find_sid->detail = serialize($tmp_info[$k]['detail']);
					$find_sid->created = date('Y-m-d H:i:s');
					if(!$tmp_info[$k]['detail']['Марка:']) continue;
					$find_brand = CarBrand::model()->find(array('condition'=>'name_en = :nd OR name_ru = :nd','params'=>array(':nd'=>$tmp_info[$k]['detail']['Марка:'])));
					if(!$find_brand) {
						echo 'Нашли машину'.PHP_EOL;
						$find_brand = new CarBrand;
						$find_brand->name_en = trim($tmp_info[$k]['detail']['Марка:']);
						$find_brand->save(false);
					}
					if(!$tmp_info[$k]['detail']['Модель:']) continue;
					$find_car = Car::model()->find(array('condition'=>'year = :yy AND brand_id = :bid AND model = :nd','params'=>array(':yy'=>str_replace(' ','',trim($tmp_info[$k]['detail']['Год выпуска:'])),':bid'=>$find_brand->id,':nd'=>$tmp_info[$k]['detail']['Модель:'])));
					if(!$find_car) {
						echo 'Добавили новую машину'.PHP_EOL;
						$find_car = new Car;
						$find_car->brand_id = $find_brand->id;
						$find_car->model = trim($tmp_info[$k]['detail']['Модель:']);
						$find_car->year = str_replace(' ','',trim($tmp_info[$k]['detail']['Год выпуска:']));
						$find_car->save(false);
					}
					//print_r($find_car->attributes);
					$find_sid->car_id = $find_car->id;
				} else {
					//echo '['.$find_sid->Sceenshots.']';
					if(!$find_sid->Sceenshots) {
						sleep(1);
						$detail = file_get_html($tmp_info[$k]['url']);
						//$tmp_i['photos'] = trim($detail->find('div.photo-glow img.bigImage')[0]);
						foreach($detail->find('div.photo-glow img.bigImage') as $ph) {
							$tmp_info[$k]['photos'][] = $ph->src;
						}

						foreach($detail->find('table.details') as $k1=>$eld) {
							foreach( $eld->find('td div.pding5_10') as $k2=>$eld2) {
								preg_match('~(.+)<strong class~ui',$eld2->innertext,$label);
								$info = $eld2->find('strong a')[0];
								if(!$info) $info = $eld2->find('strong')[0];
								$tmp_info[$k]['detail'][trim($label[1])] = trim($info->innertext);
							}
						}

						$need_upload = true;
						$find_sid->created = date('Y-m-d H:i:s');
						//print_r($tmp_i);
						//
					}
				}
				echo '['.$find_sid->car_id.']'.PHP_EOL;
				$find_sid->save(false);
				if($need_upload) {
					$mdir = $upload_path.trim(mb_strtolower($tmp_info[$k]['detail']['Марка:']));

					if(!is_dir($mdir)) {
						mkdir($mdir);
					}

					$ydir = $mdir.DIRECTORY_SEPARATOR.str_replace(' ','',trim($tmp_info[$k]['detail']['Год выпуска:']));
					if(!is_dir($ydir)) {
						mkdir($ydir);
					}

					foreach($tmp_info[$k]['photos'] as $key=>$link) {
						$fname = $ydir.DIRECTORY_SEPARATOR.$find_sid->id.'_'.$key.'.jpg';
						file_put_contents($fname, file_get_contents($link));
						if(!filesize($fname)) unlink($fname);
						$tmp_info[$k]['photos'][$key] .='-->'.$fname;
					}
				}
			}
			print_r($tmp_info[$k]	);
		}

	}

}
?>