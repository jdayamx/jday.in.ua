<?php
class BotGameBananaCommand extends CConsoleCommand
{
	public $botid = 2;
	public function parse($id) {
		if(!$id) return false;
		require_once(dirname(__FILE__).'/../components/simple_html_dom.php');
		$content = file_get_html('http://cs.gamebanana.com/maps/'.$id);
		echo 'http://cs.gamebanana.com/maps/'.$id.PHP_EOL;
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
				$timg = $element->getAttribute('data-original');
				if(!strlen(trim($timg))) $timg = $element->src;
				//$info['image']['thmb'][] = $element->src;
				$info['image']['thmb'][] = $timg;
			}
			foreach($content->find('a.Screenshot') as $element) {
				$info['image']['full'][] = $element->href;
			}
			$download_page = array();

			foreach($content->find('.Download a') as $element) {
				//echo $element->href .PHP_EOL;
				//$download_page[] = $element->parent->href;
				$download_page[] = $element->href;
			}

			//if(!count($download_page)) {
			//	foreach($content->find('.Content p strong a') as $element) {
					//echo $element->href .PHP_EOL;
			//		$download_page[] = $element->parent->href;
			//	}
			//}
			//echo $content->find('.Content')[0]->innertext;
            //print_r($download_page);


			if (count($download_page)==1) {

				//echo '['.$download_page[0].']'.PHP_EOL;
				$content = file_get_html($download_page[0]);
				if($content) {
					foreach($content->find('td.Download a') as $element) {
						$info['downloads'][] = $element->href;
					}
					if(!count($info['downloads'])) {
						foreach($content->find('.Content p strong a') as $element) {
							//echo $element->href .PHP_EOL;
							$info['downloads'][] = $element->href;
						}
					}

					if(!count($info['downloads'])) {
						foreach($content->find('#OfficialDirectDownload a') as $element) {
							//echo $element->href .PHP_EOL;
							$info['downloads'][] = $element->href;
						}
					}

					if(!count($info['downloads'])) {
						foreach($content->find('td#Download a') as $element) {
							//echo $element->href .PHP_EOL;
							$info['downloads'][] = $element->href;
						}
					}




				}

			}
			//print_r($info);
			//die();
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

	public function run($arg=null) {
        /*
		for($i=2;$i<=200000;$i++)
        {
        	$find_id = ScanIds::model()->findByPk($i);
        	if(!$find_id) {
        		$find_id = New ScanIds;
        		$find_id->id= $i;
        		$find_id->bot_id  = 2;
        		$find_id->save(false);
        		echo $i.PHP_EOL;
        	}

        }
        */

		$upload_path = realpath('..').DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'map'.DIRECTORY_SEPARATOR;

		while (true) {
			$sleep = 60;
			$id = $this->ScanId;
			if($id) {
				$sleep = 1;
				$src = $this->parse($id->id);
				echo 'Сканим '.$id->id.' '."\033[1;31m".$src['gametype']."\033[0m".' ('."\033[1;32m".$src['gamemod']."\033[0m".') - '.$src['mapname'].''."\t\t";
				if ($src) {
					$find_map = MapsDownload::model()->find(array('condition'=>'gamename=:gamename AND mapname=:mapname AND gamemod=:gamemod','params'=>array(':gamename'=>$src['gametype'],':mapname'=>$src['mapname'],':gamemod'=>$src['gamemod'])));
					if (!$find_map) {
						$find_map = New MapsDownload;
						$find_map->resurce = 'http://cs.gamebanana.com/maps/'.$id->id;
						$find_map->gamename = $src['gametype'];
						$find_map->gamemod = $src['gamemod'];
						$find_map->mapname = $src['mapname'];
						$find_map->is_download = 0;
						$id->lastscan = date('Y-m-d H:i:s');
						$id->save(false);
						echo 'добавляем';
					} else {
						echo " \033[0;30m".'уже есть'."\033[0m";
						$id->lastscan = date('Y-m-d H:i:s');
						$id->save(false);
					}
					$imgs = array();
					foreach ($src['image']['thmb'] as $id=>$url) {
						$url_full = $src['image']['full'][$id];
						$fsplit = explode('/',$url);
						$fsplit_full = explode('/',$url_full);
						$file = $upload_path.'img'.DIRECTORY_SEPARATOR.$fsplit[count($fsplit)-1];
						$file_full = $upload_path.'img'.DIRECTORY_SEPARATOR.$fsplit_full[count($fsplit_full)-1];
						if (!is_file($file)) {
							file_put_contents($file,file_get_contents($url));
							if (is_file($file)) $imgs['thmb'][] = '/uploads/map/img/'.$fsplit[count($fsplit)-1];
						} else $imgs['thmb'][] = '/uploads/map/img/'.$fsplit[count($fsplit)-1];
						if (!is_file($file_full)) {
							file_put_contents($file_full,file_get_contents($url_full));
							if (is_file($file_full)) $imgs['full'][] = '/uploads/map/img/'.$fsplit_full[count($fsplit_full)-1];
						} else $imgs['full'][] = '/uploads/map/img/'.$fsplit_full[count($fsplit_full)-1];
						//echo $url.'->'.$upload_path.'img'.DIRECTORY_SEPARATOR.$fsplit[count($fsplit)-1].PHP_EOL;
					}
					if ($imgs['full']) {

						$find_map->images  = base64_encode(serialize($imgs));
						echo ' +screenshot';
					}
					print_r($src );

					if ( $src['downloads'][0]||!$find_map->is_download) {
						$good_link = false;
						foreach($src['downloads'] as $id=>$link) {
							if($this->is_url_exist($link)) {
								$good_link = true;
								break;
							}
						}

						if($good_link) {
							$fsplit = explode('/',$link);
							$file = $upload_path.'file'.DIRECTORY_SEPARATOR.$fsplit[count($fsplit)-1];
							if (!is_file($file)||!filesize($file)) file_put_contents($file,file_get_contents($link));
							if (is_file($file)) {
								$find_map->is_download = 1;
								$find_map->filename = $fsplit[count($fsplit)-1];
								echo ' +map '.$link;
							}
						} else {
							if(!count($src['downloads'])&&$src['trash']) {
								//echo ' - удаляем всё';
								if($find_map) {
									//@$find_map->delete(false);
									//@$id->delete(false);
								}
							} else
							echo ' -плохая ссылка '.$link;
						}
					} else  {

						if(is_object($id)) {
							echo " \033[1;31m".'ОШИБКА ЗАКАЧКИ'."\033[0m";
							$id->state = 0;
							$id->save(false);
						}
					}
					if($find_map) {
						$find_map->lastupdate = date('Y-m-d H:i:s');
						echo 'findmap'.PHP_EOL;
						$find_map->save(false);
						echo '/findmap'.PHP_EOL;
						
					}


				} else {
					echo 'удаляем ID:'.$id->id;
					$id->delete(false);
				}
				echo PHP_EOL;
			}
			echo 'Ждем '.$sleep.' сек. новое задание'.PHP_EOL;
			sleep($sleep);
		}




		//print_r($this->parse(174891));
	}

	public function is_url_exist($url) {
		 // Version 4.x supported
	    $handle   = curl_init($url);
	    if (false === $handle)
	    {
	        return false;
	    }
	    curl_setopt($handle, CURLOPT_HEADER, false);
	    curl_setopt($handle, CURLOPT_FAILONERROR, true);  // this works
	    curl_setopt($handle, CURLOPT_NOBODY, true);
	    curl_setopt($handle, CURLOPT_RETURNTRANSFER, false);
	    $connectable = curl_exec($handle);
	    curl_close($handle);
	    return $connectable;
	    /*
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
	   return $status;*/
	}
}
?>