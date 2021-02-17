<style>
select {	display:block;}
</style>
<?
$url = 'https://credit.lineofwar.net/api/newprofile?key=fec70baf886dea89bfadbc4f572fd1a8';
$res = json_decode(file_get_contents($url));

$fields = array();
$errors = array();

if(isset($_POST['form'])) {
	$fields = $_POST['form'];
	//$validate = json_decode(file_get_contents($url.'&validate='.base64_encode(serialize($fields))));
	if( $ch = curl_init() ) {
		$t = array();
		foreach($fields as $name=>$val) {			$t[] = 'form['.$name.']='.$val;		}
		//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_URL, $url.'&validate=true');
		// не проверять SSL сертификат
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		// не проверять Host SSL сертификата
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch,CURLOPT_POST, count($t));
		curl_setopt($ch,CURLOPT_POSTFIELDS, implode('&',$t));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		//execute post
		$result = curl_exec($ch);
		$validate = json_decode($result);
		//close connection
		curl_close($ch);
	}

	//echo '<pre>'.print_r($result, true).'</pre>';
	//echo '<pre>'.print_r($validate, true).'</pre>';
	$errors = (array) $validate->errors;
}




if(!$res->error && !$validate->error && !$validate->success) {

	echo '<form method="POST">'.PHP_EOL;
    $old_category = '';
    $script = '';
    $scripts_A = $res->script->array;
    if($scripts_A) {
    /*
    a = new Array(
2	{"attr1":"text1","attr2":"text2"},
3	{"attr1":"text3","attr2":"text4"}
4	);

    */
    	$script .= '<script>'.PHP_EOL;
    	foreach($res->script->array as $arname=>$ar) {
    		$script .= 'var '.$arname.' = {'.PHP_EOL;
    		$el1 = array();    		foreach($ar as $k=>$a) {
    			$el2 = array();
    			foreach ($a as $k1=>$v) {
    				$el2[] = '"'.$k1.'": [ "'.str_replace('"','\"',$v).'" ]';    			}
    			$el1[] = '"'.$k.'": {'.implode(', ',$el2).'}';
    			//$el2 .= '"'.$k.'": {"12": [ "2,5" ],"24": [ "1,25" ],"48": [ "0,65" ]},'.PHP_EOL;    		}
    		$script .= implode(','.PHP_EOL,$el1);
    		$script .= '};'.PHP_EOL.PHP_EOL;    	}


    	//$script .= 'alert(AddrDistrict[28][593]);';
    	$script .= '</script>';    }
    echo $script;

	foreach($res->fields as $field) {
		if($old_category != $field->category && $field->category)	{			if($old_category) echo '</fieldset>';			echo '<fieldset><legend>'.$field->category.'</legend>';		}
		if($field->align) {			echo '<div style="float:'.$field->align.';margin-right:10px;">';		} else {			echo '<div style="clear:both;">';		}		echo '<label for="'.$field->name.'">'.$field->label.'</label>';
		switch($field->params->type) {
			case 'textfield':
				echo '<input type="text" name="form['.$field->name.']" id="'.$field->name.'" value="'.(isset($fields[$field->name])?$fields[$field->name]:'').'">'.PHP_EOL;
			break;
			case 'dropdownlist':
				//echo '<pre>'.print_r($field->params, true).'</pre>';
				echo '<select name="form['.$field->name.']" id="'.$field->name.'" '.($field->params->onchange?'onChange="'.$field->params->onchange.'"':'').'>'.PHP_EOL;
					echo '<option value="">- Пусто -</option>'.PHP_EOL;
					foreach((array) $field->params->value as $key=>$val) {						echo '<option value="'.$key.'" '.(isset($fields[$field->name])&&$fields[$field->name]==$key?'selected':'').'>'.$val.'</option>'.PHP_EOL;					}
				echo '</select>'.PHP_EOL;
			break;
			case 'textarea':
				echo '<textarea name="form['.$field->name.']" id="'.$field->name.'">'.(isset($fields[$field->name])?$fields[$field->name]:'').'</textarea>'.PHP_EOL;
			break;
			default:
		}

		if(isset($errors[$field->name][0])) {			echo '<div style="fomt-size:10px;color:red;">'.$errors[$field->name][0].'</div>';		}

		echo '</div>';

        if($old_category != $field->category)	{
			$old_category = $field->category;
		}
	}
	if($old_category) echo '</fieldset>';
	echo '<hr style="clear:both;"><input type="submit" value="Отправить" class="btn">';
	echo '</form>'.PHP_EOL;
} else {	echo $res->error.' '.$validate->error. ' '. $validate->success;}


//echo '<pre>';
//print_r($res);
//echo '</pre>';

?>