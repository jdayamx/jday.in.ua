<?php
require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'php-telnet'.DIRECTORY_SEPARATOR.'PHPTelnet.php');


class MyTelnet extends PHPTelnet {

	function Connect($server = '127.0.0.1', $user, $pass, $port = 23) {
		$rv=0;
		$vers=explode('.',PHP_VERSION);
		$needvers=array(4,3,0);
		$j=count($vers);
		$k=count($needvers);
		if ($k<$j) $j=$k;
		for ($i=0;$i<$j;$i++) {
			if (($vers[$i]+0)>$needvers[$i]) break;
			if (($vers[$i]+0)<$needvers[$i]) {
				$this->ConnectError(4);
				return 4;
			}
		}
		
		$this->Disconnect();
		
		if (strlen($server)) {
			if (preg_match('/[^0-9.]/',$server)) {
				$ip=gethostbyname($server);
				if ($ip==$server) {
					$ip='';
					$rv=2;
				}
			} else $ip=$server;
		} else $ip='127.0.0.1';
		
		if (strlen($ip)) {
			if ($this->fp=fsockopen($ip,$port)) {
//				fputs($this->fp,$this->conn1);
//				$this->Sleep();
//				fputs($this->fp,$this->conn2);
				$this->Sleep();
				
//				$this->Sleep();
				$this->GetResponse($r);
				
//				echo '<hr><pre>'.$r.'</pre>';
				
				$r=explode("\n",$r);
				$this->loginprompt=$r[count($r)-1];

//				echo "USER = $user";
				fputs($this->fp,"$user\r");
				$this->Sleep();

				fputs($this->fp,"$pass\r");
				if ($this->use_usleep) usleep($this->loginsleeptime);
				else sleep(1);
				$this->GetResponse($r);
//				echo '<hr><pre>'.$r.'</pre>';
				$r=explode("\n",$r);
				if (($r[count($r)-1]=='')||($this->loginprompt==$r[count($r)-1])) {
					$rv=3;
					$this->Disconnect();
				}
			} else $rv=1;
		}
		
		if ($rv) $this->ConnectError($rv);
		return $rv;
	}
	function Disconnect($exit = 'exit') {
		if ($this->fp) {
			if ($exit) $this->DoCommand($exit,$junk);
			fclose($this->fp);
			$this->fp=NULL;
		}
	}
	
	function DoCommand($c,&$r) {
		if ($this->fp) {
			echo date("Y-m-d H:m:s u") . ' DoCommand, before fputs: "' .$c. '"<br / >';
			fputs($this->fp,"$c\r");
			echo date("Y-m-d H:m:s u") . ' DoCommand, after fputs<br / >';
			$this->Sleep();
			$this->GetResponse($r);
			
/*			
			if (strlen($r) < 3) {
				sleep(1);
				$this->GetResponse($r);
			}
*/			

//			$this->GetResponse($r);
			
			$r = str_replace(array("\r\n\r"),array("\r"),$r);
//			$r = strtr($r,"|r|n|r","\r");
//			|r|n|r
//			$r=preg_replace("/^.*?[\r\n]+*$/","$1",$r);
		}
		return $this->fp?1:0;
	}
	
	function GetResponse(&$r) {
		$r='';
		do { 
			echo date("Y-m-d H:m:s u") . ' GetResponse, before fread<br / >';
			$temp = fread($this->fp,1000);
			$r.= $temp;
			$s=socket_get_status($this->fp);
//			if ($s['unread_bytes'] == 0 && strlen($temp) > 0) $this->Sleep(); // если непрочитанные байты закончились - поспим немного, авось появятся.
			echo date("Y-m-d H:m:s u") . ' GetResponse, after fread. Readed '.strlen($temp).' bytes, unread '.$s['unread_bytes'].' bytes<br / >';
			echo '<hr><pre>' . print_r($s,true) . '</pre>';
		} while ($s['unread_bytes']); //    || strlen($temp) > 0
	}
}


class YiiTelnet extends CComponent {

	private $_telnet;

	public function init() {
		$this->_telnet = new MyTelnet();
		$this->_telnet->use_usleep=1;
		$this->_telnet->sleeptime=500000;
		$this->_telnet->loginsleeptime=1000000;
		

	}
	
	public function getLoginPrompt() {
		return $this->_telnet->loginprompt;
	}
	
	public function connect($host, $login, $password, $port = 23) {
		return $this->_telnet->Connect($host, $login, $password, $port);
	}
	
	public function doCommand($command) {
		$result = null;
		$this->_telnet->doCommand($command, $result);
		return $result;
	}
	
	public function disconnect($exit = 1) {
		return $this->_telnet->Disconnect($exit);
	}
	
	
	
}
?>