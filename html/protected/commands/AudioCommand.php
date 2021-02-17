<?php
class AudioCommand extends CConsoleCommand
{


	public function actionIndex() {
		$base_path = realpath(dirname(__FILE__).'/../../');
		foreach(Yii::app()->db->createCommand('SELECT id FROM audio where channels=0 ORDER BY id DESC')->queryColumn() as $id) {
			$audio =  Audio::model()->findByPk($id);
			if(preg_match('~wav~ui',$audio->format)) {
				echo $audio->name.PHP_EOL;

				$fp = fopen($base_path.$audio->link, 'r');
				fseek($fp, 20);
				$rawheader = fread($fp, 16);
				$header = unpack('vtype/vchannels/Vsamplerate/Vbytespersec/valignment/vbits', $rawheader);
				if($header['type'] < 5) {
					$audio->attributes = $header;
					$audio->save(false);
					print_r($header);
				}
			} else {
				require_once($base_path.'/protected/components/getID3-1.9.8/getid3/getid3.php');
				$getID3 = new getID3;
				$ThisFileInfo = $getID3->analyze($base_path.$audio->link);
				getid3_lib::CopyTagsToComments($ThisFileInfo);
				print_r($ThisFileInfo['audio']);
				if($ThisFileInfo['audio'] && $ThisFileInfo['audio']['bitrate'] && $ThisFileInfo['audio']['channels']) {
					$audio->channels = $ThisFileInfo['audio']['channels'];
					$audio->samplerate = $ThisFileInfo['audio']['sample_rate'];
					$audio->bytespersec = $ThisFileInfo['audio']['bitrate'];
					$audio->save(false);
				}
			}

		}

	}

}
?>