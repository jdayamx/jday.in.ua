<?php

class UtilsController extends Controller
{
	public function actionIptables()
	{
		$this->render('iptables');
	}
	
	public function actionIptables2($do='')
	{
		switch($do) {			
			case 'gen':
				//print_r($_POST);
				//echo '329042378049239047';
				$list = 'Создайте файл к примеру <b>/home/firewall</b> с правами запуска и встатье туда код:';
				$list .= '<pre>';
				$list .= '#!/bin/bash'.PHP_EOL;
				$list .= 'iptables -F'.PHP_EOL;
				$list .= 'iptables -P INPUT DROP'.PHP_EOL;
				$list .= 'iptables -P FORWARD DROP'.PHP_EOL;
				$list .= 'iptables -P OUTPUT ACCEPT'.PHP_EOL;  
				$list .= 'iptables -A INPUT -m state --state ESTABLISHED,RELATED -j ACCEPT'.PHP_EOL;  
				
				
				if(isset($_POST['ports'])) {
					foreach($_POST['ports'] as $port) {
						//$list .= $port.PHP_EOL;
						$model = Ports::model()->findByAttributes(array('number'=>$port));
						if($model) {
							$list .= '#'.str_repeat('=',80).PHP_EOL;
							$list .= '# '.$model->description.PHP_EOL;
							$list .= '#'.str_repeat('=',80).PHP_EOL;  
							$list .= 'iptables -X '.$model->name.PHP_EOL;
							$list .= 'iptables -N '.$model->name.PHP_EOL;
							$list .= 'iptables -A INPUT -p '.$model->prot.' --dport '.$model->number.' -j '.$model->name.PHP_EOL;
							if($model->access == 1) {
								$list .= 'iptables -A '.$model->name.' -j ACCEPT'.PHP_EOL;
							} else {
								$list .= 'iptables -A '.$model->name.' -s '.$_SERVER['REMOTE_ADDR'].' -j ACCEPT'.PHP_EOL;
							}
						} else {
							$list .= 'iptables -A INPUT -s '.$_SERVER['REMOTE_ADDR'].' --dport '.$port.' -j ACCEPT'.PHP_EOL;
						}
						/*
						
						iptables -N mysql
						
						iptables -A mysql -s 192.168.1.5 -j ACCEPT      # jday

						*/
					}
				}
				$list .= '#'.str_repeat('=',80).PHP_EOL;  
				$list .= '/sbin/service iptables save'.PHP_EOL; 
				$list .= 'iptables -nvL'.PHP_EOL; 
				            
				//$list .= print_r($_POST, 1).PHP_EOL;
				
				$list .= '</pre>';
				$data['list'] = $list;
				echo json_encode($data);
			break;
			default:
				$this->render('iptables2');
		}
	}

	public function actionGenerateIList()
	{
		$list = 'Создайте файл к примеру <b>/home/firewall</b> с правами запуска и встатье туда код:'.PHP_EOL;
		$list .= '<pre>';
		$list .= '#!/bin/bash'.PHP_EOL;
		$list .= 'iptables -F'.PHP_EOL;
		$list .= 'iptables -P INPUT DROP'.PHP_EOL;
		$list .= 'iptables -P FORWARD DROP'.PHP_EOL;
		$list .= 'iptables -P OUTPUT ACCEPT'.PHP_EOL;
		$list .= PHP_EOL;
		$list .= 'iptables -A INPUT -i lo -j ACCEPT'.PHP_EOL;
		$list .= PHP_EOL;
		$list .= 'iptables -I INPUT -m state --state RELATED,ESTABLISHED -j ACCEPT'.PHP_EOL;
		$list .= PHP_EOL;
		$list .= '# разрешили пинг'.PHP_EOL;
		$list .= 'iptables -I INPUT -p icmp -j ACCEPT'.PHP_EOL;
		$list .= PHP_EOL;
		$list .= '# избранные порты'.PHP_EOL;
		if(isset($_POST['ports'])&&is_array($_POST['ports']))
		{
			foreach ($_POST['ports'] as $port) {
				$list .= 'iptables -A INPUT -p tcp -m tcp --dport '.$port.' -j ACCEPT'.PHP_EOL;
			}
		}
		$list .= 'iptables -A INPUT -p tcp -m multiport --port 30000:30999 -j ACCEPT'.PHP_EOL;
		$list .= PHP_EOL;
		$list .= '# разрешили все для'.PHP_EOL;
		$list .= 'iptables -I INPUT -s '.$_SERVER['REMOTE_ADDR'].' -j ACCEPT'.PHP_EOL;
		$list .= PHP_EOL;
		$list .= '#'.PHP_EOL;
		$list .= '# Save settings'.PHP_EOL;
		$list .= '#'.PHP_EOL;
		$list .= '/sbin/service iptables save'.PHP_EOL;
		$list .= '#'.PHP_EOL;
		$list .= '# List rules'.PHP_EOL;
		$list .= '#'.PHP_EOL;
		$list .= 'iptables -L -v'.PHP_EOL;
		$list .= '</pre>';
		//sleep(2);
		echo json_encode(array('list'=>$list,'post'=>print_r($_POST,true)));
	}

	public function actionZp($do='') {
		$new = new Zp;
		$new->actual_date = date('Y-m-d');
		switch($do) {
			case 'create':
		        if(isset($_POST['Zp']))
		        {
		            $new->attributes=$_POST['Zp'];
		            if($new->validate()&&$new->save())
		                $this->redirect(array('/utils/zp'));
		        }
			default:
				$model=new Zp('search');
		        $model->unsetAttributes();  // clear any default values
		        if(isset($_GET['Zp']))
		            $model->attributes=$_GET['Zp'];

		        $this->render('zp',array(
		            'model'=>$model,
		            'new'=> $new,
		        ));
		}
	}

	public function actionImageSlicing() {
		$model = new ImageSlicingForm;
		$data = null;
		if(isset($_POST['ImageSlicingForm']))
        {
            $model->attributes=$_POST['ImageSlicingForm'];
            if($model->validate())
            	$data = file_get_contents($model->url);
        }

		$this->render('imageslicing',array(
		    'model'=>$model,
			'data'=> $data,
		));
	}

	public function actionImage64() {
		$model = new Image64Form;
		$data = null;
		if(isset($_POST['Image64Form']))
        {
            $model->attributes=$_POST['Image64Form'];
            if($model->validate())
            	$data = file_get_contents($model->url);
        }

		$this->render('image64',array(
		    'model'=>$model,
			'data'=> $data,
		));
	}
	                          
	public function actionIp2int($do = false) {
		
		switch($do) {
			case 'calc':     
			if(Yii::app()->request->isAjaxRequest) {
				$ip = $_SERVER['REMOTE_ADDR'];
				if(isset($_POST['ip'])) $ip = CHtml::encode($_POST['ip']); 
				//print_r($_POST);
				$ar['list'] = '<b>ip2long [x64]: </b>'.ip2long($ip).'<br>';
				$ip86 = ip2long($ip);
				if($ip86>2147483647) $ip86 -= 4294967296;
				$ar['list'] .= '<b>ip2long [x86]: </b>'.$ip86.'<br>';			
				$ar['list'] .= '<b>gethostbyaddr: </b>'.gethostbyaddr($ip).'<br>';
				$ar['l2i'] = long2ip($_POST['ipi']);
				echo json_encode($ar);
			} else {
				$ip = $_SERVER['REMOTE_ADDR'];
				if(isset($_POST['ip'])) $ip = CHtml::encode($_POST['ip']); 
				//print_r($_POST);
				echo '<b>ip2long [x64]: </b>'.ip2long($ip).'<br>';
				$ip86 = ip2long($ip);
				if($ip86>2147483647) $ip86 -= 4294967296;
				echo '<b>ip2long [x86]: </b>'.$ip86.'<br>';			
				echo '<b>gethostbyaddr: </b>'.gethostbyaddr($ip).'<br>';
			}
			break;			
	
		
			default:
				$this->render('ip2int',array());
		}
		//sdsd
	}


}
?>