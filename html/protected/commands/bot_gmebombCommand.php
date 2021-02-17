<?php
//яркий сайт по новостям, играм и ля ля ля  http://gamebomb.ru/

class bot_gmebombCommand extends CConsoleCommand
{
	public $domain = 'http://gamebomb.ru';

	public function actionHelp() {
		echo str_repeat('*',70).PHP_EOL;
		echo '*'.str_repeat(' ',68).'*'.PHP_EOL;
		echo '*                   BOT for http://gamebomb.ru                       *'.PHP_EOL;
		echo '*'.str_repeat(' ',68).'*'.PHP_EOL;
		echo str_repeat('*',70).PHP_EOL;
	}

	public function parse_news($id) {
		$content = file_get_html($this->domain.'/gbnews/'.$id);
		$info = array();
		if($content) {
			$tmp_info = array();
			$tmp_img = array();
			foreach($content->find('.container-header h1 a') as $element) {
				$info['title'] = $element->innertext;
			}
			foreach($content->find('.container-margin div p') as $element) {
				$tmp_info[] = $element->innertext;
			}
			foreach($content->find('td.img a img') as $element) {
				$tmp_img['small'] = $element->src;
				$tmp_img['big'] = $element->parent()->href;
			}
			foreach($tmp_info as $i=>$text) {
				if(!strlen(trim($text))) unset($tmp_info[$i]);
				if(mb_substr(trim($text),0,2)=='PS') unset($tmp_info[$i]);
			}
			sort($tmp_info);
			$info['content'] = implode('<br><br>',$tmp_info);
			echo str_repeat('-',70).PHP_EOL;
			$tmp_info = array();
			$descriptor = str_get_html('<html><body>'.$info['content'].'</body></html>');
			$src_img = array();
			$download_img = array();
			foreach($descriptor->find('a img') as $element) {
				$download_img[] = $this->domain.$element->src;
				$src_img[] = $element->src;
				$download_img[] = $this->domain.$element->parent()->href;
				$src_img[] = $element->parent()->href;
			}

			$path_root = dirname(Yii::app()->basePath.'..'.DIRECTORY_SEPARATOR);
			$path_img = $path_root.DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.'news'.DIRECTORY_SEPARATOR.$id;
			if(!is_dir($path_img)) mkdir($path_img);
			if(count($download_img)) {
				//echo $path_img;
				$first_img = true;
				foreach($download_img as $n=>$img) {
					$copy_to = $path_img.DIRECTORY_SEPARATOR.$n.'.jpg';
					$replace_img[]= '/img/news/'.$id.'/'.$n.'.jpg';;
					if(!is_file($copy_to)) {
						echo 'Copy '.$img.'--->'.$copy_to.PHP_EOL;
						$img_data = file_get_contents($img);
						file_put_contents($copy_to, $img_data);
					} else {
						echo 'Exists '.$copy_to.PHP_EOL;
					}

				}
				$info['content'] = str_replace($src_img,$replace_img,$info['content']);
			}
			echo '['.$id.']'.$info['title'].PHP_EOL;
			$allow = false;
			if(count($tmp_img)) {
				foreach ($tmp_img as $k=>$_src_img) {
					$src_img = $this->domain.$_src_img;
					$copy_to = $path_img.DIRECTORY_SEPARATOR.'title_'.$k.'.jpg';
					if(!is_file($copy_to)) {
						echo 'Copy '.$src_img.'--->'.$copy_to.PHP_EOL;
						file_put_contents($copy_to,file_get_contents($src_img));
					} else {
						echo 'Exists '.$copy_to.PHP_EOL;
					}
					if($first_img) {
     					$info['first_img'] = file_get_contents($copy_to);
					}
					$allow = true;
                    $first_img = false;
				}
			}
			if(Post::model()->find(array('condition'=>'title=:tt','params'=>array(':tt'=>$info['title'])))) $allow = false;

			if($allow&&$info['title']&&strlen($info['title'])) {
				$info['content'] = str_replace('/gbnews','/post',$info['content']);
				$p = new Post;
				$p->id 								= $id;
				$p->title 							= $info['title'];
				$p->category_id 					= 1;
				$p->visible 						= 1;
				$p->body 							= $info['content'];
				if($info['first_img']) 	$p->image 	= 'data:image/jpg;base64,'.base64_encode($info['first_img']);
				$p->meta 				= $info['title'];
				$p->created 		= time();
				$p->author_id 			= 1;
				$p->save();
				echo str_repeat('+',70).PHP_EOL;
			} else echo str_repeat('-',70).PHP_EOL;
			unset($descriptor);
			unset($content);
		} else echo str_repeat('|',70).PHP_EOL;
			/*
							$tmp_img['small'] = $element->src;
				$tmp_img['big'] = $element->parent()->href;
			*/

		//	print_r($info);

		//}
	}

	public function actionIndex() {
		require_once(YiiBase::getPathOfAlias('application.components.simple_html_dom').'.php');
		$this->actionHelp();
		//$nn=2405;
		//while(true) {
		//	$this->parse_news($nn);
		//	$nn++;
		//}
		$nn = 1;
		while($nn<10119) {
			$this->parse_news($nn);
			$nn++;
		}
		//echo file_get_contents('http://gamebomb.ru/gbnews/23');

	}
}

//игры (описание) - http://gamebomb.ru/games/1-39747
?>
