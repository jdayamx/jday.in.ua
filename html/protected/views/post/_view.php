<?
$path_root = dirname(Yii::app()->basePath.'..'.DIRECTORY_SEPARATOR);
$path_img = $path_root.DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.'news'.DIRECTORY_SEPARATOR.$data->id.DIRECTORY_SEPARATOR.'title_small.jpg';


?>
<table class="table-choc border">
<tr>
<td class="header"><?php echo CHtml::link(((mb_strlen($data->title)>=50)?(mb_substr($data->title,0,49).'...'):$data->title), $data->url); ?></td><td align="right" class="header">Опубликовал: <?php echo $data->author->username?></td>
</tr>
<tr>
<td colspan=2 class="row2"><?=date('F j, Y',strtotime($data->created));?></td>
</tr>
<tr>
<td colspan=2 class="row2 maximg">
<?php
$this->beginWidget('CMarkdown', array('purifyOutput'=>true));
if(is_file($path_img)) echo CHtml::image('/img/news/'.$data->id.'/title_small.jpg',$data->title,array('style'=>'float:left;margin-right:10px;margin-bottom:5px;'));
if(!$full) {
	echo mb_substr(strip_tags($data->body,'<br>'),0,600).'...';
} else {
	echo $data->body;
}
$this->endWidget();
?>
</td>
</tr>
<tr>
<td class="row"><?=Yii::app()->user->isAllow('post/update')?CHtml::link('Редактировать новость', array('post/update','id'=>$data->id)):''; ?></td><td align="right" class="row"><?php echo CHtml::link('Обсудить на форуме', array('post/forum','id'=>$data->id),array('style'=>'color:red;')); ?> </td>
</tr>
</table>

<br>
