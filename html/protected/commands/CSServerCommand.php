<?php

mb_internal_encoding('UTF-8');

class CSServerCommand extends CConsoleCommand
{
	public $defaultAction 		= 'run';
	public $version 			= '1.0';
	protected $peer;
	protected $pkt;
	protected $socket;
	protected $players_count 	= 33;
	protected $players_max		= 218;
	protected $clients_random = array('JDay','DEN555','midas','GTm','egoist','IBM386','TOLSTY','37cm','attacked a teammate','BeerMan_ua','SkyNetCyborg','Serj-ant','III T O P M','m1stakes','baba','ToWuk','Electro^.^RnB','baton','DED','6yPaTuHO_O','ProFeSSIonAL nOOb XD','Tri Bolta','edik95','AntStall','CIM7','JAGUAR_999_MP','Snowblind','debarst','rAmp','norbert','robik','h00ligans','tetriszz','AlbertoTWS','Tech N9ne','Smer4','Life is Good','buglachi','Barbariska','PaNacEa_d_z','forsage11','air','Vad1k','comissar00','Tectoboy','UAR_NET','princess','ilmanenko','shunter','MEK','xGame','GaNSiK','pRoWka','phetunto','Дмитрий473','War Devil','studak','ExTaSy','YTKA_B_TAIIKAX','D1mka1998','Impulse','EccO','ne4eHbKo xD','xCyBeRx','BAc9IH','MAZA','Yarmak1989','Arsik','poseidon','stigmata123','YARIK','BYBA','prainc','Hammer_lan','f1kr1n','Alechan','Bender','tonny','Niko','Artur-tpr-07','linke337','PunkPaToB','skuba','mps100','kiss_fm','colin-','Solo','PoiSoN','artFALL','MadCat','MadneSS','zaya123','Xottabich','joshua','z9tb','Zalepi','codru_beer','-=EcePtra=-:camper1','-=FOX=-','-=ZMEJ=-','-_-Cko4lol-_-','00741852963','11123','123456','2atro','37cm','37km','380964154166','400kg','4ak_Hopuc_ygyTbIu','4e4en9','4ewka','4ypakabra','6amoH','6o6ep    :j','6yPaTuHO_O','AceHigh86','acronis','adiosnikers','Adrenaline','ADTR','afganec','Agon1st','Aim4ek','air','AlbertoTWS','Alechan','Alex','AliceHub','AliceHubd','alien','andryxa','Annoying Orange','Anonimixnom','AnonimixSib','AntStall','antudypb','ApoStoL','appen','Apple','armada','Arsenal Fc','Arsik','arteom228','artFALL','Artur-tpr-07','asdf','attacked a teammate','Awkword100','azer1999','b0rt','baba','BaBa JIiDa','babay','baby','BAc9IH','Barbariska','baskar','Batareika','baton','BeerMan_ua','Bender','bezpolezniy','bigmama','BliND','BlindGuardian','Bol1Var','bombasus','bomjkeee','BopoH','BOT','Bru','buglachi','Buratino','buypoliman','BYBA','Can9','CapsDets','cDrive','cek00','ceriy','churgulia','CIM7','ciyrax','CJlagkuu_6a6yJlex','CkoPnuoH','clanwar','codru_beer','colin-','Combo','comissar00','Cookie',);
    public function actionHelp() {
    	echo '*************************************************************'.PHP_EOL;
    	echo '*               Couter-Strike 1.6 PHP Server v.'.$this->version.'          *'.PHP_EOL;
    	echo '*************************************************************'.PHP_EOL;
    	echo PHP_EOL;

	}
	public function actionRun($ip = false, $port = 27015) {
		$this->actionHelp();

		if(!$ip) $ip = $this->SelfIpAddr;

		echo 'Server runing at '.$ip.':'.$port.PHP_EOL;

		$this->socket = stream_socket_server('udp://'.$ip.':'.$port, $errno, $errstr, STREAM_SERVER_BIND);

		if (!$this->socket) {
    		die("$errstr ($errno)".PHP_EOL);
		}
		do {
			$this->pkt = stream_socket_recvfrom($this->socket, 1500, 0, $this->peer);

			$info = hex2bin(substr(bin2hex($this->pkt),8));
			$hex = substr(bin2hex($this->pkt),8);
    		$pack = unpack('H8hed/A*cmd/',$this->pkt);
    		//echo $info.PHP_EOL;
    		echo '===========================Поймали пакет==========================='.PHP_EOL;
    		print_r($pack);
    		echo '==================================================================='.PHP_EOL;
    		 switch (trim($pack['cmd'])) {
    		 	case 'TSource Engine Query':
    		 		$str_hex = "FFFFFFFF4930".
						bin2hex("PHP Test My-GS.info").
						"00".
						bin2hex("de_dust").
						"00".
						bin2hex("cstrike").
						"00".
						bin2hex("JDay").
						"00"."0A"."00".
						sprintf("%02X",$this->players_count). //к-тво игрунов
						sprintf("%02X",$this->players_max). //к-тво слотов
						"00646C0001312E312E322E362F537464696F009187690414BC81270D40010A00000000000000";
	    			$str = hex2bin($str_hex);
					//print_r($this->peer);
	    			stream_socket_sendto($this->socket, $str, 0, $this->peer);
	    			//print_r($this->peer);
	    			echo 'Отправляем общие данные сервера хосту '.$this->peer.PHP_EOL;
	    			//echo '==['.$str.']==['.$str_hex.']('.mb_strlen($str_hex).')==='.PHP_EOL;
    			break;
    			case 'U'.hex2bin("FFFFFFFF"):
		    		echo '-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-'.PHP_EOL;

		    		//▒▒▒▒D[D]---->T.N.W<----▒▒DKiller !!!i$▒C
		    		$msg1 =	"\xFF\xFF\xFF\xFF\x44\xFF";
		    		for($i=1;$i<=$this->players_count;$i++) {
		    			//$msg1 .= bcdiv($i,'16',0)."Убийца мамонтов (".date('H:i:s').") ".$i."\x00". pack('H4','FF02')."\x00\x00\xB4\x97\x01\x40";
		    			$msg1 .= bcdiv($i,'16',0).$this->clients_random[rand(0,count($this->clients_random)-1)]."\x00".hex2bin(sprintf("%02X",16))."\x00\x00\x00\xB4\x97\x01\x40";
		    		}
		            echo $msg1.PHP_EOL;
		            stream_socket_sendto($this->socket, $msg1, 0, $this->peer);
		    		echo '-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-'.PHP_EOL;
		    	break;
		    	case 'getchallenge steam':
		    		$str =
		   				$msg1 =	"\xFF\xFF\xFF\xFF\x41\x30\x30\x30\x30\x30\x30\x30\x30\x20".
		    					"0123456789". # id сервера
							    "\x20\x32\x0A\x00";
		   				stream_socket_sendto($this->socket, $msg1, 0, $this->peer);
		   				echo 'hello'.PHP_EOL;
		    	break;
		    	case 'connect':
		    	//connect 48 123456789 "\prot\2\raw\8c062e0919d37b05444173614b4e79aa" "\_cl_autowepswitch\1\bottomcolor\0\cl_dlmax\128\cl_lc\1\cl_lw\1\cl_updaterate\20\model\arctic\name\jday\topcolor\0\_sid\c9f9c8ea0bcd938543f391c41b32292b\_bpw\78d21ec6af3546e19c03d25c6aca7d67\_mygskey\0C8-4B686-22\_gm\f5bd\translit\1\rate\3500"
				echo 'Client connected///////'.PHP_EOL;
				echo '+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++'.PHP_EOL;
				print_r(explode(' ',$cmd_old));
				echo '+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++'.PHP_EOL;
				$msg1 =	"\xFF\xFF\xFF\xFF\x42".
						"\x20".
						"\x34\x32\x39\x34\x39\x36\x37\x32\x39\x35".
						"\x20".
						"\x32\x33\x33\x36".
						"\x20".
						"\"194.114.136.11:".$port."\"".
						"\x00";
			    echo $msg1.PHP_EOL;
			    echo '+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++'.PHP_EOL;
				stream_socket_sendto($this->socket, $msg1, 0, $this->peer);
		    	break;
		    	default:
    				echo 'Хз что наи делать с ['.$hex.'] ('.$info.')'.PHP_EOL;
    		 }

		} while ($this->pkt !== false);

	}

	public function getSelfIpAddr() {
		$ifconfig = shell_exec('/sbin/ifconfig eth0');
        preg_match('/addr:([\d\.]+)/', $ifconfig, $match);
        return $match[1];
	}
}
?>