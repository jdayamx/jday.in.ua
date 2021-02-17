<?php

$bsp2 = Yii::app()->bsp2;
//$bsp->Load(realpath(dirname(__FILE__).'/fy_badzone.bsp'));
//$bsp->Load(realpath(dirname(__FILE__).'/de_snipe_it3.bsp'));
//$bsp2->Load(realpath(dirname(__FILE__).'/cs_st_mansion.bsp'));
//$bsp2->Load(realpath(dirname(__FILE__).'/mg_knife_flamerz.bsp'));
//$bsp2->Load(realpath(dirname(__FILE__).'/fy_losttown.bsp'));
//$bsp2->Load(realpath(dirname(__FILE__).'/cp_helmsdeep_v1.bsp'));
//$bsp2->Load(realpath(dirname(__FILE__).'/ar_santorini_beta_fixed_1.bsp'));
$bsp2->Load(realpath(dirname(__FILE__).'/fy_desert.bsp'));



//$bsp->Load(realpath(dirname(__FILE__).'/aim_a2_prisonyard.bsp'));

//echo '<pre>'.print_r($bsp->ShortInfo, true).'</pre>';
//echo '<pre>'.print_r($bsp->faces, true).'</pre>';
//foreach ($bsp->faces as $face)
//{//	$face->plane = $bsp->planes[$face->plane];
//	$face->firstEdge = $bsp->edges[$face->firstEdge];
//	echo '<pre>'.print_r($face->firstEdge->vertices, true).'</pre>';
//	foreach ($face->firstEdge->vertices as $index)
//	{//		$face->firstEdge->vertices[$i] = $bsp->vertices[$num];//	}//	echo '<pre>'.print_r($face, true).'</pre>';//}
//echo ($bsp->ShortData);


echo '<pre>'.print_r($bsp2, true).'</pre>';

$info['version'] = $bsp2->header->version;
$info['nodes'] = $bsp2->header->lumps['LUMP_NODES']->fourCC;
$info['faces'] = $bsp2->header->lumps['LUMP_FACES']->fourCC;
$info['models'] = $bsp2->header->lumps['LUMP_MODELS']->fourCC;
$info['planes'] = $bsp2->header->lumps['LUMP_PLANES']->fourCC;
$info['VERTEXES'] = $bsp2->header->lumps['LUMP_VERTEXES']->fourCC;
$info['edges'] = $bsp2->header->lumps['LUMP_EDGES']->fourCC;
$info['surfEdges'] = $bsp2->header->lumps['LUMP_SURFEDGES']->fourCC;




$info['mapversion'] = $bsp2->header->mapRevision;
$info['MaxRange'] = 'world_mins: '.$bsp2->header->lumps['LUMP_ENTITIES']->data['worldspawn'][0]['world_mins'].', world_maxs: '.$bsp2->header->lumps['LUMP_ENTITIES']->data['worldspawn'][0]['world_maxs'];
$info['skyname'] = $bsp2->header->lumps['LUMP_ENTITIES']->data['worldspawn'][0]['skyname'];
foreach($bsp2->header->lumps['LUMP_ENTITIES']->data as $eclass=>$ent) {	$info['entities'][$eclass] = count($ent);}



unset($bsp2);


echo '<pre>'.print_r($info, true).'</pre>';


$mm = MapsDownload::model()->findByPk(4);
$ii = unserialize(base64_decode($mm->info));
echo '<pre>'.print_r($ii, true).'</pre>';

?>