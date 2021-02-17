<?php

mb_internal_encoding('UTF-8');

class ChatServerCommand extends CConsoleCommand
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

	public function actionRun($ip = false, $port = 6666) {
		$this->actionHelp();

		if(!$ip) $ip = $this->SelfIpAddr;

		echo 'Server runing at '.$ip.':'.$port.PHP_EOL;

		$socket = stream_socket_server("tcp://".$ip.':'.$port, $errno, $err) or die($err);
		$conns = array($socket);
		$conn_ids = array(0);
		$conn_user = array();
		$msgs = array();

		// server loop
		while (true) {
		  $reads = $conns;
		  // get number of connections with new data
		  $mod = stream_select($reads, $write, $except, 5);
		  if ($mod===false) break;

		  foreach ($reads as $read) {
		    if ($read===$socket) {
		      $conn = stream_socket_accept($socket);
		      $recv = fread($conn, 1024);
		      if (empty($recv)) continue;
				echo $recv.PHP_EOL;
		      if (strpos($recv, "GET / ")===0) {
		        // serve static html page from memory
		        fwrite($conn, "HTTP/1.1 200 OK\r\n". "Connection: close\r\n".
		          "Content-Type: text/html; charset=UTF-8\r\n\r\n");
		        fwrite($conn, $html);
		        stream_socket_shutdown($conn, STREAM_SHUT_RDWR);

		      } else if (strpos($recv, "GET /msg/")===0) {
		        // ajax request: send a message
		        // syntax: GET /msg/user_from/user_to%20message
		        // e.g. GET /msg/john/mary%20hello
		        stream_socket_shutdown($conn, STREAM_SHUT_RDWR);
		        preg_match("!GET /msg/([^/]+)/(\S+)!", $recv, $match);
		        $user = $match[1];
		        $match[2] = urldecode($match[2]);
		        if (!strpos($match[2], " ")) continue;
		        list($target, $msg) = explode(" ", $match[2], 2);

		        if ($target=="all") {
		          // send message to all users
		          foreach ($conns as $i=>$conn) {
		            if ($i!=0) fwrite($conn, "data: ".$user." to all: ".$msg."\n\n");
		          }

		        } else if (isset($conn_user[$target])) {
		          // send message to one user and to the originator
		          if ($target!=$user) foreach ($conn_user[$target] as $conn) {
		            fwrite($conn, "data: ".$user.": ".$msg."\n\n");
		          }
		          if (isset($conn_user[$user])) foreach ($conn_user[$user] as $conn) {
		            fwrite($conn, "data: You to ".$target.": ".$msg."\n\n");
		          }

		        } else {
		          // user is offline, keep message in memory for later delivery
		          if (!isset($msgs[$target])) $msgs[$target] = "";
		          $msgs[$target] .= "data: ".$user." (".@date("Y-m-d H:i")."): ".$msg."\n\n";
		          foreach ($conn_user[$user] as $conn) {
		            fwrite($conn, "data: You to ".$target." (offline): ".$msg."\n\n");
		          }
		        }

		      } else if (strpos($recv, "text/event-stream")===false) {
		        // block other requests like favicon.ico
		        stream_socket_shutdown($conn, STREAM_SHUT_RDWR);

		      } else {
		        // login as new user
		        // syntax: GET /username e.g. GET /john
		        preg_match("!GET /(\S+)!", $recv, $match);
		        if (!isset($match[1])) continue;
		        $user = $match[1];
		        echo "connect ".$user." from ".stream_socket_get_name($conn, true)."\n";

		        fwrite($conn, "HTTP/1.1 200 OK\r\n". "Connection: close\r\n".
		          "Content-Type: text/event-stream\r\n\r\n");
		        fwrite($conn, "data: Welcome ".$user."!\n\n");
		        fwrite($conn, "data: now online: ".implode(", ", array_keys($conn_user))."\n\n");

		        // deliver messages sent when user was offline
		        if (isset($msgs[$user])) {
		          fwrite($conn, $msgs[$user]);
		          unset($msgs[$user]);
		        }
		        // notify other users
		        foreach ($conns as $i=>$c) {
		          if ($i!=0) fwrite($c, "data: ".$user." has joined.\n\n");
		        }
		        // register connection in pool
		        $conns[] = $conn;
		        $conn_ids[] = $user;
		        // allow multiple connections for 1 user
		        $conn_user[$user][] = $conn;
		      }
		    } else {
		      $data = fread($read, 1024);
		      if ($data=="" or $data===false) {
		        // user/browser closed connection
		        if ($data!==false) stream_socket_shutdown($read, STREAM_SHUT_RDWR);
		        $conn_id = array_search($read, $conns, true);
		        unset($conns[$conn_id]);

		        // unregister connection for user
		        $user = $conn_ids[$conn_id];
		        unset($conn_ids[$conn_id]);
		        $conn_id = array_search($read, $conn_user[$user], true);
		        unset($conn_user[$user][$conn_id]);

		        if (empty($conn_user[$user])) {
		          unset($conn_user[$user]);
		          // notify other users
		          foreach ($conns as $i=>$c) {
		            if ($i!=0) fwrite($c, "data: ".$user." has left.\n\n");
		} } } } } }
	}

	public function getSelfIpAddr() {
		$ifconfig = shell_exec('/sbin/ifconfig eth0');
        preg_match('/addr:([\d\.]+)/', $ifconfig, $match);
        return $match[1];
	}
}
?>