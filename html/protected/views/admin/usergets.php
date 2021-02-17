<?php
$this->breadcrumbs=array(
	'Админка'=>array('/admin/index'),
	'Синхронизация пользователей'
);
?>
<div class="panelG topic">
<table class="shortstory">
<tr>
<td class="thead" colspan=2>Список пользователей старого сайта</td>
</tr>
<tr>
<td class="row_yellow" colspan=2></td>
</tr>

<tr>
<td class="thead" width="50%">Старая база</td><td class="thead" width="50%">Новая база</td>
</tr>
<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider'=> $dataProvider,
    'itemView'=>'_old_userlist',
    'template'=>'<tr><td class="row1" colspan=2 style="text-align:center;">{pager}</td></tr>{items}<tr><td class="row1" colspan=2 style="text-align:center;">{pager}</td></tr>',
    'pager'=>array(
        'header'=>false,
        'htmlOptions'=>array('class'=>'pager'),
    ),
));


?>
</table>
</div>
<br>