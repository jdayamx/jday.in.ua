<?php
$this->breadcrumbs=array(
	'Новости',
);
if(!empty($_GET['tag'])):
?>
<h1>Сообщения с меткой <i><?php echo CHtml::encode($_GET['tag']); ?></i></h1>
<?php endif; ?>

<?php $this->widget('zii.widgets.CListView', array(
	'htmlOptions'=>array('class'=>'width:400px;'),
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'template'=>"{items}\n{pager}",
)); ?>
