<?php

class CarsMailruCommand extends CConsoleCommand
{
	public $url = 'http://cars.mail.ru';
	/*
	public $botid = 2;
	public function parse($id) {
		if(!$id) return false;
		require_once(dirname(__FILE__).'/../components/simple_html_dom.php');
		$content = file_get_html('http://cs.gamebanana.com/maps/'.$id);
		$info = array();
		if($content) {
			$tmp_info = array();
			foreach($content->find('#TitleBreadcrumb menu li a') as $element) {
				$tmp_info[] = $element->innertext;
			}

			foreach($content->find('#TrashNoticeModule h3') as $element) {
				$tmp_info[] = $element->innertext;
			}
			//print_r($tmp_info);
			if($tmp_info[1]) $info['gametype'] = $tmp_info[1];
			if($tmp_info[3]) $info['gamemod'] = $tmp_info[3];
			if($tmp_info[4]) $info['mapname'] = $tmp_info[4];
			if($tmp_info[5]&&$tmp_info[5]=='Trash Notice') $info['trash'] = true; else $info['trash'] = false;
			foreach($content->find('a.Screenshot img') as $element) {
				$info['image']['thmb'][] = $element->src;
			}
			foreach($content->find('a.Screenshot') as $element) {
				$info['image']['full'][] = $element->href;
			}
			$download_page = array();
			foreach($content->find('.Content footer a') as $element) {
				//echo $element->href .PHP_EOL;
				$download_page[] = $element->href;
			}
			if (count($download_page)==1) {
				$content = file_get_html($download_page[0]);
				foreach($content->find('td.Download a') as $element) {
					$info['downloads'][] = $element->href;
				}

			}
			if($info) return $info;
		}
		return false;
	}

	public function getScanId()
	{
		$find_ids = ScanIds::model()->find(array(
			'condition'=>'state = 1 AND (lastscan < DATE_SUB(NOW(), INTERVAL 2592000 SECOND) OR lastscan IS NULL) AND bot_id='.$this->botid,
			'order'=>'lastscan ASC',
			//'order'=>'id DESC',
			)
		);
		return $find_ids;
	}
    */
	public function run() {
        echo $this->url.PHP_EOL;
        require_once(dirname(__FILE__).'/../components/simple_html_dom.php');
		$content = file_get_html($this->url.'/catalog');
        $n=0;
		foreach($content->find('a.tile-pin') as $element) {
				$img_data = '';
				$base='';
				$sleep = 2;
				//$tmp_info[$n]['data'] = $element->innertext;
				$tmp_info[$n]['img_short'] = $element->find('img.tile-pin__pic')[0]->src;
				$tmp_info[$n]['name_en'] = strip_tags($element->find('span.tile-pin__text')[0]->innertext);
				$tmp_info[$n]['href'] = $element->href;
				$content_tool = file_get_html($this->url.$element->href);
				foreach($content_tool->find('div.catalog-intro') as $el) {
					//$tmp_info[$n]['text'] = $el->innertext;
					$tmp_info[$n]['img'] =  $el->find('img.catalog-intro__pic')[0]->src;
					$tmp_info[$n]['name_ru'] =  str_replace(array('(',')'),'',$el->find('span.catalog-intro__title__note')[0]->innertext);
					$tmp_info[$n]['description'] =  trim(str_replace('Читать далее','',strip_tags($el->find('div.catalog-intro__text')[0]->innertext)));
					$tmp_info[$n]['url'] =  $el->find('div.catalog-intro__note a')[0]->href;
				}

				$find_brand = CarBrand::model()->findByAttributes(array('name_en'=>$tmp_info[$n]['name_en'],'name_ru'=>$tmp_info[$n]['name_ru']));
				if($find_brand) {
					echo 'Пропускаем '.$tmp_info[$n]['name_en'].PHP_EOL;
					$sleep = 0;

				} else {
					echo 'Добавляем '.$tmp_info[$n]['name_en'];
					$base = base64_encode(file_get_contents($tmp_info[$n]['img']));
					$img_data = 'data:image/png;base64,'.$base;
					if($base) {
						$find_brand = New CarBrand;
						$find_brand->name_en = $tmp_info[$n]['name_en'];
						$find_brand->name_ru = $tmp_info[$n]['name_ru'];
						$find_brand->description = $tmp_info[$n]['description'];
						$find_brand->logo = $img_data;
						$find_brand->url =  $tmp_info[$n]['url'];
						$find_brand->save(false);
					} else {
						echo ' !!!!ERROR LOGO!!!!';
					}
					echo PHP_EOL;
				}

				$car_i = 0;
				foreach($content_tool->find('div.catalog-generation__card') as $el) {
					//$tmp_info[$n]['cars'][$car_i]['data'] = $el->innertext;
					$tmp_info[$n]['cars'][$car_i]['url'] = trim($el->find('a.catalog-generation__card__title')[0]->href).'specifications/';

					$content_car = file_get_html($this->url.$tmp_info[$n]['cars'][$car_i]['url']);
					echo 'Открываем '.$this->url.$tmp_info[$n]['cars'][$car_i]['url'].' ';
					echo '.';sleep(1);echo '.';sleep(1);echo '.';
					if($content_car) {
						foreach($content_car->find('div.catalog-model') as $car) {
							$model = preg_replace('/<span[^>]*>(.*)<\/span>/Ui', '', $car->find('h1.catalog-model__title')[0]->innertext);
							$model = trim(str_replace($find_brand->name_en ,'',$model));
							$tmp_info[$n]['cars'][$car_i]['model'] = $model;
							$img = trim(str_replace(array('background-image:url(',');') ,'',$car->find('span.catalog-model__pic')[0]->style));
							$tmp_info[$n]['cars'][$car_i]['img'] = $img;
							//$param = 0;
							foreach($content_car->find('div.catalog-age__feat__type') as $parms) {
								$param = trim($parms->find('span.catalog-age__feat__title__text')[0]->innertext);
								//$tmp_info[$n]['cars'][$car_i]['params'][$param]['data'] = $parms->innertext;
								//$tmp_info[$n]['cars'][$car_i]['params'][$param]['head'] = trim($parms->find('span.catalog-age__feat__title__text')[0]->innertext);
								foreach($parms->find('div.catalog-age__feat__item') as $list) {
									$tmp_info[$n]['cars'][$car_i]['params'][$param][trim(strip_tags($list->find('div.catalog-age__feat__item__name')[0]->innertext))] = trim(strip_tags($list->find('div.catalog-age__feat__item__text')[0]->innertext));
								}


								//catalog-age__feat__item__name"

								//$param++;
							}
						}
						unset($content_car);
						$find_type_text = '';
						$find_type = null;
						$find_type_text = $tmp_info[$n]['cars'][$car_i]['params']['Кузов']['Тип'];
						$find_type_text = trim(preg_replace('/\((.*)\)/Ui', '', $find_type_text));
						$find_type = CarBodyType::model()->find(array('condition'=>'name LIKE "'.$find_type_text.'%'.$tmp_info[$n]['cars'][$car_i]['params']['Кузов']['Количество дверей'].'%"'));
						if(!$find_type) $find_type = CarBodyType::model()->find(array('condition'=>'name LIKE "%'.$find_type_text.'%"'));
						echo '('.$tmp_info[$n]['cars'][$car_i]['params']['Кузов']['Тип'].'='.($find_type?$find_type->name:'-Не найден-').')';

						if($find_type&&$find_brand) {
							$find_car = Car::model()->findByAttributes(array('model'=>$tmp_info[$n]['cars'][$car_i]['model'],'brand_id'=>$find_brand->id,'body_type_id'=>$find_type->id));
							if(!$find_car) {
								$base = null;
								$base = base64_encode(file_get_contents($tmp_info[$n]['cars'][$car_i]['img']));
								$img_data = 'data:image/png;base64,'.$base;
								if($base) {
									echo '[Добавляем]';
									$find_car = new Car;
									$find_car->brand_id = $find_brand->id;
									$find_car->model = $tmp_info[$n]['cars'][$car_i]['model'];
									$find_car->body_type_id = $find_type->id;
									$find_car->logo = $img_data;
									$find_car->save(false);
								} else {
									echo '[Ошибка]';
								}

							} else {
								echo '[Пропускаем]';
							}
						}
                        print_r($tmp_info);
						//print_r($tmp_info[$n]['cars'][$car_i]['params']['Кузов']);
					} else {
						echo '[Ошибка]';
					}

					$car_i++;
					echo PHP_EOL;

					//break;
				}



				$n++;
				sleep($sleep);
				//break;
		}



		print_r($tmp_info);
	}

	public function is_url_exist($url) {
	    $ch = curl_init($url);
	    curl_setopt($ch, CURLOPT_NOBODY, true);
	    curl_exec($ch);
	    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

	    if($code == 200){
	       $status = true;
	    }else{
	      $status = false;
	    }
	    curl_close($ch);
	   return $status;
	}
}
?>