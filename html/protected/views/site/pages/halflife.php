<h1>Half-Life Yii</h1>
<?

$wad_file = array('path'=>'/uploads/wad/','file'=>'zm_abyss.wad');
$mdl_file = array('path'=>'/uploads/mdl/','file'=>'25_6a6o4ka-napxaet.mdl');
$wad = new hlwad($wad_file);
$mdl = new hlmdl($mdl_file);

//$mdl->test();
//$wad->TextureList();
//echo $wad->ShowPalette(1);
//echo round(memory_get_usage()/1024/1024,2)."M<hr>";
//echo '<pre>'.print_r($wad->Textures_info,true).'</pre>';
$s = '';
$ms = '';
for($i=1;$i<=$wad->TexturesCount;$i++) $s .= $wad->ShowImage($i,true);
for($i=1;$i<=$mdl->TexturesCount;$i++) $ms .= $mdl->ShowTexture($i,true);

$this->widget('CTabView', array(
'htmlOptions'=>array('class'=>'tabs'),
'tabs'=>array(
array('title'=>'WAD View', 'content'=>'<h2>Component <b>hlwad</b> (<i>'.$wad_file['file'].'</i>)</h2>'.$s, 'active'=>true),
array('title'=>'MDL View', 'content'=>'<h2>Component hlmdl (<i>'.$mdl->File.'</i>)</h2>'.
	$this->widget('CTabView', array(
		'htmlOptions'=>array('class'=>'tabs'),
		'tabs'=>array(
			array('title'=>'Textures', 'content'=>$ms, 'active'=>true),
			array('title'=>'info', 'content'=>$mdl->ShowInfo()/*.'<pre>'.print_r($mdl->bhead,true).'</pre>'*/),
			array('title'=>'3d View', 'content'=>'Messages Content'),
		),
	),true)
),
array('title'=>'BSP View', 'content'=>'Coming soon....'),
),
));
//echo "<hr>".round(memory_get_usage()/1024/1024,2)."M";
?>