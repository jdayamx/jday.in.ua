<?php
mb_internal_encoding('UTF-8');

require_once(dirname(__FILE__).'/../components/simple_html_dom.php');

class AutosAolCommand extends CConsoleCommand
{
	public function cars($brand, $url) {
		echo str_repeat('*',40).PHP_EOL;
		$con = file_get_html($url);
		$pages = strip_tags($con->find('.pagecount span')[1]);
		if(!$pages) $pages = 1;
		echo 'find '.$pages.' pages';
		echo PHP_EOL.str_repeat('=',40).PHP_EOL;

		$num = 1;
		$cars = array();
		for($i=1;$i<=$pages;$i++) {

			$con_p = file_get_html($url.'page-'.$i.'/');
			foreach($con_p->find('.entry') as $element) {
				//echo $element->innertext;
				$name = $element->find('.sub_title a')[0]->innertext;
				$image = $element->find('.img img')[0]->src;
				preg_match('/([0-9]{4})\s('.$brand.')\s(.*)/ui',$name, $out);
				list($musor, $year, $brand, $model) = $out;

				$find_Brand = CarBrand::model()->findByAttributes(array('name_en'=>$brand));
				if($find_Brand) {
					$find_car = Car::model()->findByAttributes(
						array(
							'brand_id'=>$find_Brand->id,
							'model'=>$model,
							'year'=>$year,
						)
					);
					if(!$find_car) {
						$base = base64_encode(file_get_contents($image));
						$find_car = new Car;
						$find_car->brand_id = $find_Brand->id;
						$find_car->model = $model;
						$find_car->year = $year;
						$find_car->body_type_id = 0;
						$find_car->logo = 'data:image/png;base64,'.$base;
						$find_car->save(false);
						$action = 'Добавляем'.(!$base?' - без лого':'');
					} else {
						$action = 'Пропускаем';
					}
				} else {
					$action = 'Бренд не найден';
				}

				//$cars[$brand][$model][$year]['url'] =  $element->find('.sub_title a')[0]->href;
				//$cars[$brand][$model][$year]['img'] =  $image;
				echo '['.$num.']['.$action.'] '.$name.' => '.$element->find('.sub_title a')[0]->href;

				echo PHP_EOL.str_repeat('-',40).PHP_EOL;
				$num++;
			}

			//break; // временно
		}
		echo PHP_EOL.str_repeat('=',40).PHP_EOL;
		//print_r($cars);
		//echo PHP_EOL.str_repeat('=',40).PHP_EOL;


		/*$old = array();
		foreach($content->find('.laidOff ul li a') as $element) {
			$name = $element->innertext;
			$old[$name] = 'http://www.cars.ru'.$element->href;
			echo $name;
			echo PHP_EOL.str_repeat('.',40).PHP_EOL;
		}
		print_r($old);*/
	}

	public function actionIndex() {

		$marks = array();

		$content = file_get_html('http://autos.aol.com/new-cars/');

		foreach($content->find('#ncm_specific_list ul li a') as $element) {
			$mark = $element->innertext;
			$mark_href = $element->href;
			$mark = $mark;
			$marks[$mark] = 'http://autos.aol.com'.$mark_href;
			$this->cars($mark,$marks[$mark]);
			$n+=1;
			//if($n==2)break;
		}

		print_r($marks);

       /*
		                                                                                                                   //&category_id=1                           //&checked_auto_ria=0
		$content = file_get_contents('http://auto.ria.com/ajax.php?target=auto&event=load_subcategory&marka_id=15&lang_id=2&is_hot=0&under_credit=0');
		$json = json_decode($content);

		print_r($content);

		foreach( $json->modelArr as $node) {

			$name = trim(preg_replace('/[^a-z^\s^\d]/ui','',$node->name));
			$node->name = ($name);  //trim(iconv(mb_detect_encoding($node->name, array('UTF-8', 'Windows-1251', 'KOI8-R', 'ISO-8859-5'), TRUE), 'UTF-8', $node->name));
			print_r($node);
			$n+=1;
			if($n==3) break;
        } */
	}
}
?>