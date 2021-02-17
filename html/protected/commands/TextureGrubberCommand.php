<?php
class TextureGrubberCommand extends CConsoleCommand
{
	public function getNextMap()
	{
		$find_devices = MapsDownload::model()->find(array(
			'condition'=>'lastupdate < DATE_SUB(NOW(), INTERVAL 60 SECOND) AND class <> ""',
//			'order'=>'lastupdate ASC',
			)
		);
		return $find_devices;
	}

	public function run() {

		$path = dirname(dirname(dirname(__FILE__).'..').'..');

  		while(true) {
  			$sleep = 60;
  			$nextMap = $this->NextMap;
  			if($nextMap) {
  				$sleep = 1;
  				echo print_r($nextMap->attributes,true).PHP_EOL;

  				echo mime_content_type ( $path.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'map'.$nextMap->filename )
  			} else {
  				echo 'Ждем задание '.$sleep.' сек...'.PHP_EOL;
  			}

  			sleep($sleep);
  		}
	}
}
?>