<?php
class botclasnoCommand extends CConsoleCommand
{
	public $url = 'http://clasno.com.ua';
	//public $id= 77599;

	public function getScanIds()
	{
		$find_ids = Ids::model()->find(array(
			'condition'=>'state = 1 AND (lastscan < DATE_SUB(NOW(), INTERVAL 604800 SECOND) OR lastscan IS NULL)',
			//'order'=>'lastscan ASC',
			'order'=>'RAND()',
			)
		);
		return $find_ids;
	}

	public function scanId($id=0)
	{
		if(!$id) return false;
		require_once(dirname(__FILE__).'/../components/simple_html_dom.php');
		$content = file_get_html($this->url.'/products/'.$id);

		if(!$content) return false;
        //=======title=========================
		foreach($content->find('div.title h3') as $element) {
				$info_tmp[] = $element->innertext;
		}
		if($info_tmp[0]) $info['title'] = $info_tmp[0];unset($info_tmp);
		//========brand========================
		foreach($content->find('div.title dl dt') as $element) {
				$info_tmp[] = str_replace(':','',$element->innertext);
		}
		foreach($content->find('div.title dl dd a') as $element) {
				$info_tmp[] = $element->innertext;
		}
		if($info_tmp[0]&&$info_tmp[1]) {$info['brand']['title'] = $info_tmp[0];$info['brand']['name'] = $info_tmp[1];}unset($info_tmp);

		foreach($content->find('div.title dl dd a') as $element) {
				$info_tmp[] = $element->href;
		}
		if($info_tmp[0]) $info['brand']['id'] = trim(preg_replace('/[^0-9]/ui','\\1',$info_tmp[0]));unset($info_tmp);

        foreach($content->find('p.art') as $element) {
				$info_tmp[] = $element->innertext;
		}
		if($info_tmp[0]) $info['artikul'] = trim(preg_replace('/[^0-9]/ui','\\1',$info_tmp[0]));unset($info_tmp);

		foreach($content->find('div.info',0)->find('p') as $element) {
				$info_tmp[] = $element->innertext;
		}
		if(count($info_tmp)) $info['info'] = implode('<br>',$info_tmp);unset($info_tmp);
		foreach($content->find('div.info',0)->find('table',0)->find('tr') as $element) {
				foreach($element->find('td') as $td) {
					$info_tmp[] = $td->innertext;
				}
				$info['infos'][str_replace(':','',trim($info_tmp[0]))] = trim(str_replace('(как подобрать размер?)','',strip_tags($info_tmp[1])));
				unset($info_tmp);
		}

		foreach($content->find('div.price p b') as $element) {
				$info_tmp[] = $element->innertext;
		}
		if($info_tmp[0]) $info['price'] = $info_tmp[0];unset($info_tmp);

		foreach($content->find('div.preview a img') as $element) {
				$info_tmp[] = $element->src;
		}
		if($info_tmp[0]) $info['image'] = $this->url.$info_tmp[0];unset($info_tmp);

		foreach($content->find('div.in_group a') as $element) {
				$info_tmp[] = trim(preg_replace('/[^0-9]/ui','\\1',$element->href));
		}

		if(count($info_tmp)) $info['groups'] = $info_tmp;unset($info_tmp);

		foreach($content->find('div.img_tabs ul li div a') as $element) {
				$info['images']['full'][] = $this->url.$element->href;
		}

		foreach($content->find('div.img_tabs ul li div a img') as $element) {
				$info['images']['min'][] = $this->url.$element->src;
		}
        foreach($content->find('ul.breadcrumb li a') as $element) {
				$info_tmp[] = $element->innertext;
		}
		if($info_tmp[2]&&$info_tmp[3]&&$info_tmp[4]) {
			$info['categories'] = array($info_tmp[4],$info_tmp[3],$info_tmp[2]);
		}
		unset($info_tmp);
		 foreach($content->find('div.info p') as $element) {
				if(strlen($element->innertext)>=50&&strpos($element->innertext,$info['brand']['name'])!==false) $info_tmp[] = strip_tags($element->innertext,true);
		}
		if(count($info_tmp)) $info['brand']['info'] = implode('<br>',$info_tmp);unset($info_tmp);

		$info['last'] = $info_tmp;

		if($info['title']) return $info;

		return false;
	}

	public function run() {

		$upload_path = realpath('..').DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR;

		//print_r($this->scanId(129919));

        /*for($i=101354;$i<=200000;$i++)
        {
        	$find_id = Ids::model()->findByPk($i);
        	if(!$find_id) {
        		$find_id = New Ids;
        		$find_id->id= $i;
        		$find_id->state = 1;
        		$find_id->save(false);
        		//echo $i.PHP_EOL;
        	}

        }*/

        while (true) {
			$sleep = 60;
			$info = array();
			$ids = $this->ScanIds;
			echo 'Парсим '.$ids->id."\t\t";
			if ($ids) {
				//$sleep = rand(1,5);
				$sleep = 1;
				$info = $this->scanId($ids->id);
				if ($info) {
					echo "\033[1;31m".'удачно'."\033[0m\t";
					$find_item = Item::model()->findByPk($ids->id);
					if (count($info['categories'])) {
						echo '(';
						foreach ($info['categories'] as $cat) {
							$find_cat = Categorie::model()->find(array('condition'=>'name = :cat','params'=>array(':cat'=>$cat)));
							if(!$find_cat) {
								echo $cat.' ';
								$find_cat = New Categorie;
								$find_cat->name = $cat;
								$find_cat->save(false);
								unset($find_cat);
							}
						}
						echo ')';
						$find_cat0 = Categorie::model()->find(array('condition'=>'name=:cat','params'=>array(':cat'=>$info['categories'][0])));
						$find_cat1 = Categorie::model()->find(array('condition'=>'name=:cat','params'=>array(':cat'=>$info['categories'][1])));
						$find_cat2 = Categorie::model()->find(array('condition'=>'name=:cat','params'=>array(':cat'=>$info['categories'][2])));
						if(!$find_cat2->pid) $find_cat2->pid = $find_cat1->id;$find_cat2->save(false);
						if(!$find_cat1->pid) $find_cat1->pid = $find_cat0->id;$find_cat1->save(false);
						echo 'мутим категории'."\t";
					}

					if($find_item) {
						echo "\033[0;33m".'обновлено в БД'."\033[0m\t";
						//$find_item = New Item;
						//$find_item->id = $ids->id;
						$find_item->title = $info['title'];
						$find_item->info = $info['info'];
						$find_item->age = $info['infos']['Возраст'];
						$find_item->sex = $info['infos']['Пол'];
						$find_item->cost = $info['price'];
						$find_item->stats = base64_encode(serialize($info['infos']));
						$find_item->categorie_id = $find_cat2->id;
						$find_item->brand = $info['brand']['id'];
						if($info['image'])
						{
							$split = explode('/',$info['image']);
							$file = $upload_path.'middle'.DIRECTORY_SEPARATOR.$split[count($split)-1];
							echo '['.$file.'<--------'.$info['image'].']';
							if (!is_file($file)) {
								file_put_contents($file,file_get_contents($info['image']));
								if (is_file($file)) {
									$find_item->images = '/img/middle/'.$split[count($split)-1];
								} else {
									$find_item->images = $info['image'];
								}
							}
						}
						$imgs = array();
						foreach ($info['images']['full'] as $id=>$url) {
							$url_full = $url;
							$url_mini = $info['image']['min'][$id];

							$split_full = explode('/',$url_full);
							$split_mini = explode('/',$url_mini);

							$file_full = $upload_path.'full'.DIRECTORY_SEPARATOR.$split_full[count($split_full)-1];
							$file_mini = $upload_path.'full'.DIRECTORY_SEPARATOR.$split_mini[count($split_mini)-1];

							if (!is_file($file_full)) {
								file_put_contents($file_full,file_get_contents($url_full));
								if (is_file($file_full)) {
									$imgs['full'][] = '/img/full/'.$split_full[count($split_full)-1];
								} else {
									$imgs['full'][] = $url_full;
								}
							}

							if (!is_file($file_mini)) {
								file_put_contents($file_mini,file_get_contents($url_mini));
								if (is_file($file_mini)) {
									$imgs['mini'][] = '/img/full/'.$split_mini[count($split_mini)-1];
								} else {
									$imgs['mini'][] = $url_mini;
								}
							}

							if(count($imgs['full'])) $find_item->images_tabs = base64_encode(serialize($imgs));
						}

						$find_brand = Brand::model()->findByPk($info['brand']['id']);
						if(!$find_brand&&$info['brand']['id']) {
							$find_brand = New Brand;
							$find_brand->id = $info['brand']['id'];
							$find_brand->name = $info['brand']['name'];
							$find_brand->info = $info['brand']['name'];
							//$imb = array();
							//$img[] = $info['brand']['img_jpg'];
							//$img[] = $info['brand']['img_png'];
							//$find_brand->images = base64_encode(serialize($img));

							echo "\t\033[0;35m".'добавлен бренд'."\033[0m\t";
						} else {
							if ($find_brand) {
								$find_brand->info = $info['brand']['info'];
								echo "\t\033[1;33m".'бренд уже есть'."\033[0m\t";
							} else {
								echo "\t\033[0;31m".'бренд отсутствует'."\033[0m\t";
							}
						}
						$find_brand->save(false);
						$find_item->save(false);
						$ids->lastscan = date('Y-m-d H:i:s');
						$ids->save(false);
					} else {
						echo "\t\033[0;35m".'добавлен бренд'."\033[0m\t";
					}
				}

				echo PHP_EOL;
			}
			echo 'Ждем '.$sleep.' сек. новое задание'.PHP_EOL;
			sleep($sleep);
		}

		/*
		while (true) {
			$sleep = 60;
			$info = array();
			$ids = $this->ScanIds;
			echo 'Парсим '.$ids->id."\t\t\t";
			if ($ids) {
				//$sleep = rand(1,5);
				$sleep = 1;
				$info = $this->scanId($ids->id);
				if ($info) {
					echo "\033[0;34m".'удачно'."\033[0m\t";
					$find_item = Item::model()->findByPk($ids->id);
					if($find_item) {
						echo 'обновлено в БД';

					} else {
						echo "\t\033[0;32m".'добавлено в БД'. "\033[0m";
						$find_item = New Item;
						$find_item->id = $ids->id;
						$find_item->title = strip_tags($info['title']);
						$find_item->info = $info['info'];
						$find_item->cost = $info['price']['summ'];
						$find_item->stats = base64_encode(serialize($info['stats']));
						$find_item->images = base64_encode(serialize($info['images']));
						$find_item->images_tabs = base64_encode(serialize($info['images_tabs']));
						$find_item->brand = $info['brand']['id'];
						$find_brand = Brand::model()->findByPk($info['brand']['id']);
						if(!$find_brand&&$info['brand']['id']) {
							$find_brand = New Brand;
							$find_brand->id = $info['brand']['id'];
							$find_brand->name = $info['brand']['name'];
							$imb = array();
							$img[] = $info['brand']['img_jpg'];
							$img[] = $info['brand']['img_png'];
							$find_brand->images = base64_encode(serialize($img));;
							$find_brand->save(false);
							echo "\t\033[0;35m".'добавлен бренд'."\033[0m\t";
						} else {
							if ($find_brand) {
								echo "\t\033[1;33m".'бренд уже есть'."\033[0m\t";
							} else {
								echo "\t\033[0;31m".'бренд отсутствует'."\033[0m\t";
							}
						}
						$find_item->save(false);
						$ids->lastscan = date('Y-m-d H:i:s');
						$ids->save(false);
					}
					//print_r($info);
				} else {
					echo "\033[0;31m".'удалено'. "\033[0m";
					$ids->delete(false);
				}
				echo PHP_EOL;
			}
			echo 'Ждем '.$sleep.' сек. новое задание'.PHP_EOL;
			sleep($sleep);
		}
		*/
	}
}
?>