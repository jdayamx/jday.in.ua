<style>
   .img {
    image-rendering: crisp-edges;
   }
  </style>
<?php

$this->pageTitle=Yii::app()->name . ' - minecraft item '.str_replace('-',':',$model->id);
$this->breadcrumbs=array(
    'minecraft'=>array('/minecraft'),
	$model->name,
);

?>
<table class="zzz table-choc border">
	<tr class="head">
		<th colspan="5"><?php echo $model->name. ' [ID '.str_replace('-',':',$model->id).']';?></th>
	</tr>
	<tr>
		<td width="100" rowspan="5" style="text-align:center;">
			<?php
				echo CHtml::image('/img/minecraft/item/'.$model->id.'.png','',array('lowsrc'=>'/img/minecraft/item/'.$model->id.'.png','class'=>'img','width'=>'64'));
			?>
		</td>
	</tr>
	<tr>
		<td width="100" class="row">Название</td><td><?php echo $model->name;?></td> <td width="50" class="row" rowspan="3">Цена</td><td><?php echo $model->calccost;?>$</td>
	</tr>
	<tr>
		<td width="100" class="row">ID</td><td><?php echo $model->id;?></td><td rowspan="2"><?php echo $model->VisualCost;?></td>
	</tr>
	<tr>
		<td width="100" class="row">Категория</td><td><?php echo $model->category->name;?></td>
	</tr>
	<tr>
		<td width="100" class="row">Тип</td><td><?php echo $model->type->name;?></td><td width="50" class="row">Крафт</td><td><?php echo ($model->cost_by_craft?'ДА':'НЕТ');?></td>
	</tr>
    <?php
    if ($model->cost_by_craft) {
    ?>
	<tr class="head">
		<th colspan="5">Крафт</th>
	</tr>
	<tr>
		<td colspan="5" style="text-align:center;">
		<?php
			echo $model->Craft;
		?>
		</td>
	</tr>
	<tr class="head">
		<th colspan="5">Для крафта</th>
	</tr>
	<td colspan="5" style="text-align:center;">

		<?php
			foreach($model->calcitem as $i=>$c) {				echo CHtml::image('/img/minecraft/item/'.$i.'.png','').$model->CalcStack($c);			}
			echo '<hr>';
			echo $model->CraftTree;
		?>
		</td>
	<?php
    }
    ?>
</table>