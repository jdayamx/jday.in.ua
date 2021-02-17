<?php
class MunicipalCommand extends CConsoleCommand
{
	public $session = '';
	public $params = array();

	public function getHead() {
		$ret  = '******************************************************************'.PHP_EOL;
		$ret .= '*                                                                *'.PHP_EOL;
		$ret .= '*               Парсер сайта www.municipal.kiev.ua 2.0           *'.PHP_EOL;
		$ret .= '*                                                                *'.PHP_EOL;
		$ret .= '******************************************************************'.PHP_EOL;
		return $ret;
	}

	public function getHouseInfo($street_id, $house_id) {
		$ret = array();

		$res = http_get('http://www.municipal.kiev.ua:8080/kiev/',array("timeout"=>5), $info);
		$headers = http_parse_headers($res);
		$cook = http_parse_cookie($headers['Set-Cookie'], 0, array("comment"));
		$this->session = $coocie;
		$this->params = array(
				"timeout"=>1000,
				'cookies'=>$cook->cookies,
				'referer'=>'http://www.municipal.kiev.ua:8080/kiev/',
				'headers'=>array(
					'X-Requested-With'=>'XMLHttpRequest',
				),
		);

		$res = http_get(
			'http://www.municipal.kiev.ua:8080/kiev/renderers/house/locator.jsp',
			$this->params,
			$info
		);
		$headers1 = http_parse_headers($res);
        //----------------------------------------------------------------------

		$res = http_post_fields (
					'http://www.municipal.kiev.ua:8080/kiev/daemons/locator' ,
					array(
						'cmd'=>'list',
						'what'=>'street',
					),
					array(),
					$this->params
				);
		$msg = http_parse_message ( $res );

		$res = http_post_fields (
					'http://www.municipal.kiev.ua:8080/kiev/daemons/locator' ,
					array(
						'cmd'=>'list',
						'what'=>'house',
						'oid'=>$street_id
					),
					array(),
					$this->params
				);
		$msg = http_parse_message ( $res );
		$ret['houses'] = $msg;

		$resi = http_post_fields (
					'http://www.municipal.kiev.ua:8080/kiev/daemons/locator' ,
					array(
						'cmd'=>'list',
						'what'=>'condominimum',
						'oid'=>$house_id
					),
					array(),
					$this->params
				);
		$msgi = http_parse_message ( $resi );
		$infos = $this->json_decode_nice($msgi->body)->items[1];
		$ret['cond'] = $infos;
		$res = http_get('http://www.municipal.kiev.ua:8080/kiev/daemons/locator?cmd=name&what=district',$this->params, $info);
		$ret['district'] = http_parse_message ( $res );
		$res = http_get('http://www.municipal.kiev.ua:8080/kiev/daemons/locator?cmd=set&what=condominimum&id='.$infos->id, $this->params, $info);
		$ret['condominimum'] = http_parse_message ( $res );

		$res = http_get('http://www.municipal.kiev.ua:8080/kiev/renderers/house/index.jsp?id='.$infos->id, $this->params, $info);
		$ret['index.jsp id'] = http_parse_message ( $res );
		$res = http_get('http://www.municipal.kiev.ua:8080/kiev/renderers/house/menu.jsp?item=info', $this->params, $info);
		$ret['menu.js'] = http_parse_message ( $res );
		$res = http_get('http://www.municipal.kiev.ua:8080/kiev/renderers/house/info/index.jsp', $this->params, $info);
		$ret['index.jsp'] = http_parse_message ( $res );

		$res = http_get('http://www.municipal.kiev.ua:8080/kiev/renderers/house/menu.jsp?item=passport', $this->params, $info);
		$ret['menu.jsp?item=passport'] = http_parse_message ( $res );

		$res = http_get('http://www.municipal.kiev.ua:8080/kiev/renderers/engine/index.jsp?domain=passport', $this->params, $info);
		$ret['index.jsp?domain=passport'] = http_parse_message ( $res );

		$res = http_get('http://www.municipal.kiev.ua:8080/kiev/renderers/engine/menu.jsp?item=view', $this->params, $info);
		$ret['menu.jsp?item=view'] = http_parse_message ( $res );

		$res = http_get('http://www.municipal.kiev.ua:8080/kiev/renderers/engine/engine.jsp', $this->params, $info);
		$ret['engine.jsp'] = http_parse_message ( $res );

		//http://www.municipal.kiev.ua:8080/kiev/renderers/engine/engine.jsp

		/*
		$this->snoopy->fetch('http://www.municipal.kiev.ua:8080/municipal/daemons/locator?cmd=set&what=condominimum&id='.$datainfo['org'][0]['id']);
    	$this->snoopy->fetch('http://www.municipal.kiev.ua:8080/municipal/renderers/house/index.jsp');
	    $this->snoopy->fetch('http://www.municipal.kiev.ua:8080/municipal/renderers/house/menu.jsp?item=info');
	    $this->snoopy->fetch('http://www.municipal.kiev.ua:8080/municipal/renderers/house/info/index.jsp');
	    $this->snoopy->fetch('http://www.municipal.kiev.ua:8080/municipal/renderers/house/menu.jsp?item=passport');
	    $this->snoopy->fetch('http://www.municipal.kiev.ua:8080/municipal/renderers/house/engine/index.jsp?domain=passport');
	    $this->snoopy->fetch('http://www.municipal.kiev.ua:8080/municipal/renderers/house/engine/menu.jsp?item=view');
	    $this->snoopy->fetch('http://www.municipal.kiev.ua:8080/municipal/renderers/house/engine/engine.jsp');
		*/

				//$msgi = http_parse_message ( $resi );
		return $ret;
	}

	public function actionIndex() {
        echo $this->Head;
		$res = http_get('http://www.municipal.kiev.ua:8080/kiev/',array("timeout"=>5), $info);
		$headers = http_parse_headers($res);
		$cook = http_parse_cookie($headers['Set-Cookie'], 0, array("comment"));
		$this->session = $coocie;
		$this->params = array(
				"timeout"=>1000,
				'cookies'=>$cook->cookies,
				'referer'=>'http://www.municipal.kiev.ua:8080/kiev/',
				'headers'=>array(
					'X-Requested-With'=>'XMLHttpRequest',
				),
		);

		$res = http_get(
			'http://www.municipal.kiev.ua:8080/kiev/renderers/house/locator.jsp',
			$this->params,
			$info
		);
		$headers1 = http_parse_headers($res);
        //----------------------------------------------------------------------

		$res = http_post_fields (
					'http://www.municipal.kiev.ua:8080/kiev/daemons/locator' ,
					array(
						'cmd'=>'list',
						'what'=>'street',
					),
					array(),
					$this->params
				);
		$msg = http_parse_message ( $res );

		echo str_repeat('-',80).PHP_EOL;
		foreach($this->json_decode_nice($msg->body)->items as $street) {
			if(!$street->id) continue;
			echo $street->name.' (id:'.$street->id.')'.PHP_EOL;
			$res = http_post_fields (
					'http://www.municipal.kiev.ua:8080/kiev/daemons/locator' ,
					array(
						'cmd'=>'list',
						'what'=>'house',
						'oid'=>$street->id
					),
					array(),
					$this->params
				);
			$msg = http_parse_message ( $res );
			//список домов
			foreach($this->json_decode_nice($msg->body)->items as $house) {
				if(!$house->id) continue;
				echo $house->name.' (id:'.$house->id.')';
				/*$resi = http_post_fields (
					'http://www.municipal.kiev.ua:8080/kiev/daemons/locator' ,
					array(
						'cmd'=>'list',
						'what'=>'condominimum',
						'oid'=>$house->id
					),
					array(),
					$params
				);*/
				//$msgi = http_parse_message ( $resi );
				//$infos = $this->json_decode_nice($msgi->body)->items[1];
                //echo ' ['.$infos->name.']';
                //$res = http_get('http://www.municipal.kiev.ua:8080/kiev/daemons/locator?cmd=name&what=district',$params, $info);
                //$msgi = http_parse_message($res);
                //echo 'RN: '.$msgi->body;

                print_r($this->getHouseInfo($street->id, $house->id));
                //$res = http_get('http://www.municipal.kiev.ua:8080/kiev/daemons/locator?cmd=set&what=condominimum&id='.$infos->id,$params, $info);



				sleep(1);
				echo PHP_EOL;
			}
			//print_r($this->json_decode_nice($msg->body));

			//print_r($street);
			//
			echo str_repeat('-',80).PHP_EOL;
			sleep(1);
		//break;
		}

	}

	function json_decode_nice($json, $assoc = FALSE){
    $json = str_replace(array("\n","\r"),"",$json);
    $json = str_replace('{identifier','{"identifier"',$json);
    $json = str_replace('{id','{"id"',$json);
    $json = str_replace('name:','"name":',$json);
    $json = str_replace('items:','"items":',$json);
    //print_r(json_decode($json, true));
    return json_decode($json,$assoc);
}

}
?>