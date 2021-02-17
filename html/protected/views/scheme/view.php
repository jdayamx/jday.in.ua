<?php
$this->breadcrumbs=array(
	'Schemes'=>array('index'),
	$model->name,
);
?>

<table class="table-choc border" style="max-width: 960px;">
	<tr>
		<td class="header">
			<?php echo $model->name; ?>
		</td>
	</tr>
	<tr>
		<td style="max-width: 955px;">
			<?php

			$elements =new SchemeElementLink('search');
        $elements->unsetAttributes();  // clear any default values
        if(isset($_GET['SchemeElementLink']))
            $elements->attributes=$_GET['SchemeElementLink'];

			$this->widget('CTabView', array(
				'id'=>'info_tbe_'.$model->id,
				'htmlOptions'=>array(
					'class'=>'tabs',
				),
				'tabs'=>array(
					'to_'.$model->id=>array('title'=>'Описание', 'content'=>'<div>'.$model->description.'</div>', 'active'=>true),
					'tp_'.$model->id=>array(
						'title'=>'Элементы',
						'content'=>$this->renderPartial('_elements',array('model'=>$model,'elements'=>$elements) , true),
					),
				),
			));

				echo $model->description;
			?>
		</td>
	</tr>
</table>
