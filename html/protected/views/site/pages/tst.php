
<?
mb_internal_encoding('UTF-8');
                                                                                                                                  //matched_country=-1 - любая страна
$this->layout = 'clear';
                                                                                                                   //&category_id=1                           //&checked_auto_ria=0
$content = file_get_contents('http://auto.ria.com/ajax.php?target=auto&event=load_subcategory&marka_id=15&lang_id=2&is_hot=0&under_credit=0');

//$content = preg_replace("/\\\\u([a-f0-9]{4})/e", "iconv('UCS-4LE','UTF-8',pack('V', hexdec('U$1')))", $content);
$json = json_decode($content);

echo '<pre>'.print_r($content, true).'</pre>';

foreach( $json->modelArr as $node) {
	$name = $node->name;	$node->name = trim($name);  //trim(iconv(mb_detect_encoding($node->name, array('UTF-8', 'Windows-1251', 'KOI8-R', 'ISO-8859-5'), TRUE), 'UTF-8', $node->name));	echo '<pre>'.print_r($node, true).'</pre>';}

?>
