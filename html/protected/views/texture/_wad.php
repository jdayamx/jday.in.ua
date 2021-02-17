<?php
$data = $model->InfoData;
//asort($data);
foreach ($data as $id=>$tex)
{
	//print_r($tex);
	//$t_find = Texture::model()->find(array('condition'=>'name=:name','params'=>array(':name'=>trim($tex['name']))));
	$hash = md5_file(realpath('').$tex['img']);
	$t_find = Texture::model()->find(array('condition'=>'hash=:hash','params'=>array(':hash'=>$hash)));
	if (!$t_find) {
		echo CHtml::ajaxlink('<div onmouseover="this.style.border=\'2px solid #F00\'" onmouseout="this.style.border=\'2px solid #999\'" style="margin:2px;border:2px solid #999;float:left;background: url('.$tex['img'].') no-repeat center;width:'.$tex['width'].'px;height:'.$tex['height'].'px;" id="tt_'.$id.'"></div>', array('texture/create'),array('type' => 'POST', 'data' => array( 'new[pid]' => $model->id,'new[type]' => 'png','new[filename]' => trim($tex['img']),'new[name]' => trim($tex['name'])),'update'=>'#new_form'));
	} else {
	    if($t_find->mid) {	    	$find_link_m = TextureMapLink::model()->findByAttributes(array('texture_id'=>$t_find->id,'map_id'=>$t_find->mid));
			if(!$find_link_m) {
				$find_link_m = new TextureMapLink;
				$find_link_m->texture_id =$t_find->id;
				$find_link_m->map_id = $t_find->mid;
				$find_link_m->save(false);
			}	    }
		echo CHtml::link('<div onmouseover="this.style.border=\'2px solid #F00\'" onmouseout="this.style.border=\'2px solid #FF0\'" style="margin:2px;border:2px solid #FF0;float:left;background: url('.$tex['img'].') no-repeat center;width:'.$tex['width'].'px;height:'.$tex['height'].'px;" id="tt_'.$id.'"></div>',array('texture/view','id'=>$t_find->id));
	}


	//echo CHtml::image($tex['img'],$tex['name'],array('style'=>'margin:2px;'));
}
?>