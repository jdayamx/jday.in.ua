<?php
/* @var $this ModelController */

$this->breadcrumbs=array(
	'Список моделей'=>array('index'),
	'Все'
);

$this->layout='column2';

$this->left_menu = $this->renderpartial('_filter', array('model'=>$model,'category_id'=>$category_id), true);
?>

<table class="table-choc border">
	<tr>
		<td class="header" colspan=3>Модели <?php if(Yii::app()->user->id) echo '<div style="float:right;">'.CHtml::link('Добавить',array('model/create')).'</div>';?></td>
	</tr>
<?php
$this->widget('zii.widgets.CListView', array(
	'htmlOptions'=>array(
		'id'=>'texture_list',
	),
    'dataProvider'=>$model->search(),
    'template'=>'<tr>
					<td class="footer" style="text-align:center;">
						{pager}
					</td>
				</tr>
				<tr>
					<td style="text-align:center;padding:5px;">
						{items}
					</td>
				</tr>
				<tr>
					<td class="footer" style="text-align:center;">
						{pager}
					</td>
				</tr>',
    'itemView'=>'_view',
    'pager'=>array(
        'header'=>false,
        'htmlOptions'=>array('class'=>'pager'),
    ),
));

?>
</table>
<br>
