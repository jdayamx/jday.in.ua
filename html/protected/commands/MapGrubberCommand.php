<?php
class MapGrubberCommand extends CConsoleCommand
{
	public function getNextMap()
	{
		$find_devices = MapsDownload::model()->find(array(
			'condition'=>'lastupdate < DATE_SUB(NOW(), INTERVAL 1 DAY)',
//			'order'=>'lastupdate ASC',
			)
		);
		return $find_devices;
	}

	public function run() {
  		while(true) {
  			$sleep = 60;
  			$nextMap = $this->NextMap;
  			if($nextMap) {
  				$sleep = 1;
  				if(!in_array($nextMap->gamename,array('Team Fortress Classic', 'Counter-Strike 1.6','Half-Life','Half-Life: Rally','Counter-Strike 1.5','Day of Defeat','Counter-Strike: Condition Zero','Deathmatch Classic','Half-Life: Opposing Force','BrainBread','Sven Coop'))) {
  					$nextMap->lastupdate = date('Y-m-d H:i:s');
  					$nextMap->save(false);
  					$sleep = 0;
  				} else {
  					$nextMap->class = 'goldsrc';
  					$nextMap->lastupdate = date('Y-m-d H:i:s');
  					$nextMap->save(false);
  					$sleep = 0;
  					echo "\033[0;30m".'Обновлен'."\033[0m".PHP_EOL;
  				/*	if($nextMap->save()) {
						echo "\033[0;30m".'Обновлен'."\033[0m".PHP_EOL;
					} else {
						echo "\033[1;32m".'Ошибка'."\033[0m".PHP_EOL;
						foreach($nextMap->getErrors() as $key=>$val) {
							echo $key." - \033[0;31m".$val[0]."\033[0m".PHP_EOL;
						}

					}*/
  					// делаем нужное

  				}
  				echo print_r($nextMap->attributes,true).PHP_EOL;

  			} else {
  				echo 'Ждем задание '.$sleep.' сек...'.PHP_EOL;
  			}

  			sleep($sleep);
  		}
	}
}
?>