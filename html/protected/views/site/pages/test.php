<?php


class mblock {
	public $name;
	public $pitch;
	public $x;
	public $y;
	public $z;
	public $tool;
	function __construct($name,$pitch,$x, $y, $z, $tool = 0) {
		$this->name = $name;
		$this->pitch = $pitch;
		$this->x = $x;
		$this->y = $y;
		$this->z = $z;
		$this->tool = $tool;
	}   
}

class mobject {
	public $x;
	public $y;
	public $z;                     
	
	function __construct($x, $y, $z) {
		$this->x = $x;
		$this->y = $y;
		$this->z = $z;
	}   
	
	public function doCommand($command) {
		$host   = '127.0.0.1';
		$port   = '25564';
		$user   = 'root';
		$pass   = 'balamut83';
		$socket = fsockopen($host, $port) or die('Could not connect to: '.$host);
		stream_set_blocking($socket, 25);
		fputs($socket, $user."\r\n");
		//print_r(fgets($socket, 1024));
		fputs($socket, $pass."\r\n");
		//print_r(fgets($socket, 1024));
		fputs($socket, "\r\n");
		fputs($socket, $command."\r\n");
		socket_read($socket, 2048);
		//print_r(fgets($socket, 1024));
		socket_close($socket);
	}  
	
	public function setblock($block, $pitch=1, $x=0,$y=0,$z=0, $tool=0) {
		// /setblock <X> <Y> <Z> [имя блока] [вариации блока] [настройка размещения блока] [дополнительные параметры]
		$this->doCommand('setblock '.($this->x+$x).' '.($this->y+$y).' '.($this->z+$z).' '.$block.' '.$pitch.' '.$tt);
	}  
	
	public function draw($data) {
		foreach($data as $p) {
			$this->setblock($p->name,$p->pitch,$p->x,$p->y,$p->z, $tool);
		}
	}
	
	public function drawFromFile($file) {
		$data = unserialize(base64_decode(file_get_contents($file)));
		$this->draw($data);
		//$data = file_put_contents('teeeeeeeeeest.mobj',base64_encode(serialize($data)));
	}
	
}


?>
<pre>
<?php
	/*
	$data[] = new mblock(5,1,1,-1,1);$data[] = new mblock(5,1,1,-1,2);$data[] = new mblock(5,1,1,-1,3);$data[] = new mblock(5,1,1,-1,4);$data[] = new mblock(5,1,1,-1,5);	
	$data[] = new mblock(5,1,2,-1,1);$data[] = new mblock(5,1,2,-1,2);$data[] = new mblock(5,1,2,-1,3);$data[] = new mblock(5,1,2,-1,4);$data[] = new mblock(5,1,2,-1,5);
	$data[] = new mblock(5,1,3,-1,1);$data[] = new mblock(5,1,3,-1,2);$data[] = new mblock(5,1,3,-1,3);$data[] = new mblock(5,1,3,-1,4);$data[] = new mblock(5,1,3,-1,5);$data[] = new mblock(5,1,3,-1,6);
	$data[] = new mblock(5,1,4,-1,1);$data[] = new mblock(5,1,4,-1,2);$data[] = new mblock(5,1,4,-1,3);$data[] = new mblock(5,1,4,-1,4);$data[] = new mblock(5,1,4,-1,5);
	$data[] = new mblock(5,1,5,-1,1);$data[] = new mblock(5,1,5,-1,2);$data[] = new mblock(5,1,5,-1,3);$data[] = new mblock(5,1,5,-1,4);$data[] = new mblock(5,1,5,-1,5);
	
	$data[] = new mblock(54,1,1,0,1);$data[] = new mblock(54,1,1,0,2);$data[] = new mblock(54,1,1,0,4);$data[] = new mblock(54,1,1,0,5);
	
	//$data[] = new mblock('wooden_door',0,4,0,1,'replace');
	
    $data[] = new mblock(163,2,1,4,-1);$data[] = new mblock(163,2,2,4,-1);$data[] = new mblock(163,2,3,4,-1);$data[] = new mblock(163,2,4,4,-1);$data[] = new mblock(163,2,5,4,-1);$data[] = new mblock(163,2,6,4,-1);$data[] = new mblock(163,2,7,4,-1);$data[] = new mblock(163,2,0,4,-1);$data[] = new mblock(163,0,-1,4,-1);$data[] = new mblock(163,0,-1,4,0);
	$data[] = new mblock(17,0,0,0,0);$data[] = new mblock(17,0,0,1,0);$data[] = new mblock(17,0,0,2,0);$data[] = new mblock(17,0,0,3,0);$data[] = new mblock(163,1,7,4,0);
	$data[] = new mblock(5,0,1,0,0);$data[] = new mblock(5,0,1,1,0); $data[] = new mblock(5,0,1,2,0);$data[] = new mblock(5,0,1,3,0);$data[] = new mblock(163,1,7,4,1);
	$data[] = new mblock(5,0,2,0,0);$data[] = new mblock(102,0,2,1,0);$data[] = new mblock(102,0,2,2,0);$data[] = new mblock(5,0,2,3,0);$data[] = new mblock(163,1,7,4,2);
	$data[] = new mblock(5,0,3,0,0);$data[] = new mblock(102,0,3,1,0);$data[] = new mblock(102,0,3,2,0);$data[] = new mblock(5,0,3,3,0);$data[] = new mblock(163,1,7,4,3);
	$data[] = new mblock(5,0,4,0,0);$data[] = new mblock(102,0,4,1,0);$data[] = new mblock(102,0,4,2,0);$data[] = new mblock(5,0,4,3,0);$data[] = new mblock(163,1,7,4,4);
	$data[] = new mblock(5,0,5,0,0);$data[] = new mblock(5,0,5,1,0);$data[] = new mblock(5,0,5,2,0);$data[] = new mblock(5,0,5,3,0); $data[] = new mblock(163,1,7,4,5);
	$data[] = new mblock(17,0,6,0,0);$data[] = new mblock(17,0,6,1,0);$data[] = new mblock(17,0,6,2,0);$data[] = new mblock(17,0,6,3,0);$data[] = new mblock(163,1,7,4,6);
	$data[] = new mblock(5,0,6,0,1);$data[] = new mblock(5,0,6,1,1);$data[] = new mblock(5,0,6,2,1);$data[] = new mblock(5,0,6,3,1); $data[] = new mblock(163,1,7,4,7);
	$data[] = new mblock(5,0,6,0,2);$data[] = new mblock(102,0,6,1,2);$data[] = new mblock(102,0,6,2,2);$data[] = new mblock(5,0,6,3,2); $data[] = new mblock(163,3,6,4,7);
	$data[] = new mblock(5,0,6,0,3);$data[] = new mblock(102,0,6,1,3);$data[] = new mblock(102,0,6,2,3);$data[] = new mblock(5,0,6,3,3); $data[] = new mblock(163,3,5,4,7);
	$data[] = new mblock(5,0,6,0,4);$data[] = new mblock(102,0,6,1,4);$data[] = new mblock(102,0,6,2,4);$data[] = new mblock(5,0,6,3,4);$data[] = new mblock(163,3,4,4,7);
	$data[] = new mblock(5,0,6,0,5);$data[] = new mblock(5,0,6,1,5); $data[] = new mblock(5,0,6,2,5); $data[] = new mblock(5,0,6,3,5);$data[] = new mblock(163,3,3,4,7);
	$data[] = new mblock(17,0,6,0,6);$data[] = new mblock(17,0,6,1,6);$data[] = new mblock(17,0,6,2,6);$data[] = new mblock(17,0,6,3,6);$data[] = new mblock(163,3,2,4,7);
	$data[] = new mblock(5,0,0,0,1);$data[] = new mblock(5,0,0,1,1);$data[] = new mblock(5,0,0,2,1);$data[] = new mblock(5,0,0,3,1);$data[] = new mblock(163,3,1,4,7);
	$data[] = new mblock(5,0,0,0,2);$data[] = new mblock(102,0,0,1,2);$data[] = new mblock(102,0,0,2,2);$data[] = new mblock(5,0,0,3,2);$data[] = new mblock(163,3,0,4,7);
	$data[] = new mblock(5,0,0,0,3);$data[] = new mblock(102,0,0,1,3);$data[] = new mblock(102,0,0,2,3);$data[] = new mblock(5,0,0,3,3);$data[] = new mblock(163,3,-1,4,7);
	$data[] = new mblock(5,0,0,0,4);$data[] = new mblock(102,0,0,1,4);$data[] = new mblock(102,0,0,2,4);$data[] = new mblock(5,0,0,3,4);$data[] = new mblock(163,0,-1,4,6);  
	$data[] = new mblock(5,0,0,0,5);$data[] = new mblock(5,0,0,1,5);$data[] = new mblock(5,0,0,2,5);$data[] = new mblock(5,0,0,3,5);$data[] = new mblock(163,0,-1,4,5);
	$data[] = new mblock(17,0,0,0,6);$data[] = new mblock(17,0,0,1,6);$data[] = new mblock(17,0,0,2,6);$data[] = new mblock(17,0,0,3,6);$data[] = new mblock(163,0,-1,4,4);    
	$data[] = new mblock(5,0,1,0,6);$data[] = new mblock(5,0,1,1,6);$data[] = new mblock(5,0,1,2,6);$data[] = new mblock(5,0,1,3,6);$data[] = new mblock(163,0,-1,4,3);    
	$data[] = new mblock(5,0,2,0,6);$data[] = new mblock(5,0,2,1,6);$data[] = new mblock(5,0,2,2,6);$data[] = new mblock(5,0,2,3,6);$data[] = new mblock(163,0,-1,4,2);  
	$data[] = new mblock(5,0,3,2,6);$data[] = new mblock(5,0,3,3,6);$data[] = new mblock(163,0,-1,4,1);  
		 
	$data[] = new mblock(5,0,4,0,6);$data[] = new mblock(5,0,4,1,6);$data[] = new mblock(5,0,4,2,6);$data[] = new mblock(5,0,4,3,6);  
	$data[] = new mblock(5,0,5,0,6);$data[] = new mblock(5,0,5,1,6);$data[] = new mblock(5,0,5,2,6);$data[] = new mblock(5,0,5,3,6);  
	$data[] = new mblock(163,0,0,5,0);$data[] = new mblock(163,1,4,7,6);$data[] = new mblock(163,0,2,7,6);
	$data[] = new mblock(163,0,0,5,1);$data[] = new mblock(163,1,4,7,5);$data[] = new mblock(163,0,2,7,5);
	$data[] = new mblock(163,0,0,5,2);$data[] = new mblock(163,1,4,7,4);$data[] = new mblock(163,0,2,7,4);
	$data[] = new mblock(163,0,0,5,3);$data[] = new mblock(163,1,4,7,3);$data[] = new mblock(163,0,2,7,3);
	$data[] = new mblock(163,0,0,5,4);$data[] = new mblock(163,1,4,7,2);$data[] = new mblock(163,0,2,7,2);
	$data[] = new mblock(163,0,0,5,5);$data[] = new mblock(163,1,4,7,1);$data[] = new mblock(163,0,2,7,1);	
	$data[] = new mblock(163,0,0,5,6);$data[] = new mblock(163,1,4,7,0);$data[] = new mblock(163,0,2,7,0);
	$data[] = new mblock(5,0,1,5,6);$data[] = new mblock(163,1,5,6,0);$data[] = new mblock(126,4,3,8,-1);
	$data[] = new mblock(5,0,2,5,6);$data[] = new mblock(163,1,5,6,1);$data[] = new mblock(126,4,3,8,0);
	$data[] = new mblock(5,0,3,5,6);$data[] = new mblock(163,1,5,6,2);$data[] = new mblock(126,4,3,8,1);
	$data[] = new mblock(5,0,4,5,6);$data[] = new mblock(163,1,5,6,3);$data[] = new mblock(126,4,3,8,2);
	$data[] = new mblock(5,0,5,5,6);$data[] = new mblock(163,1,5,6,4);$data[] = new mblock(126,4,3,8,3);
	$data[] = new mblock(163,1,6,5,6);$data[] = new mblock(163,1,5,6,5);$data[] = new mblock(126,4,3,8,4);
	$data[] = new mblock(163,1,6,5,5);$data[] = new mblock(163,1,5,6,6);$data[] = new mblock(126,4,3,8,5);
	$data[] = new mblock(163,1,6,5,4);$data[] = new mblock(5,0,3,7,6);$data[] = new mblock(126,4,3,8,6);
	$data[] = new mblock(163,1,6,5,3);$data[] = new mblock(5,0,4,6,6);$data[] = new mblock(126,4,3,8,7);
	$data[] = new mblock(163,1,6,5,2);$data[] = new mblock(5,0,3,6,6);
	$data[] = new mblock(163,1,6,5,1);$data[] = new mblock(5,0,2,6,6);
	$data[] = new mblock(163,1,6,5,0);$data[] = new mblock(163,0,1,6,6);
	$data[] = new mblock(5,0,5,5,0);$data[] = new mblock(163,0,1,6,5);
	$data[] = new mblock(5,0,4,5,0);$data[] = new mblock(163,0,1,6,4);
	$data[] = new mblock(5,0,3,5,0);$data[] = new mblock(163,0,1,6,3);
	$data[] = new mblock(5,0,2,5,0);$data[] = new mblock(163,0,1,6,2);
	$data[] = new mblock(5,0,1,5,0);$data[] = new mblock(163,0,1,6,1);
	$data[] = new mblock(5,0,2,6,0);$data[] = new mblock(163,0,1,6,0);
	$data[] = new mblock(5,0,3,6,0);
	$data[] = new mblock(5,0,4,6,0);
	$data[] = new mblock(5,0,3,7,0); */
	
	
	//file_put_contents('teeeeeeeeeest.mobj',base64_encode(serialize($data)));


    $o1 = new mobject(275, 64, 409);
    //$o1->draw($data);
   	$o1->drawFromFile('teeeeeeeeeest.mobj');
    
    print_r($data);
    
    /*$o1->setblock(17);
    $o1->setblock(17,1,0,1,0);
    $o1->setblock(17,1,0,2,0);
    $o1->setblock(17,1,0,3,0);
    $o1->setblock(17,13,1,3,0);
    $o1->setblock(17,13,0,3,1);
    $o1->setblock(17,13,-1,3,0);
    $o1->setblock(17,13,0,3,-1);    
    $o1->setblock(17,1,0,4,0);
    $o1->setblock(17,1,0,5,0);  
    
    $o1->setblock('leaves',13,-2,3,0);*/
    
    
    
    print_r($o1);
?>
</pre>