<table class="table-choc border">
	<tr>
		<td class="header" colspan=2>Пользователь: <span style="color:<?=$model->group->color?>"><?=$model->username?></span>  </td>
	</tr>
	<tr>
		<td  class="row" width="200">
		</td>
		<td class="row_in">
			<table class="table-choc">
				<tr>
					<td  class="row" width="200">
						Группа:
					</td>
					<td>
						<span style="color:<?=$model->group->color?>"><?=$model->group->name?></span>
					</td>
				</tr>
				<tr>
					<td  class="row" width="200">
						Дата регистрации:
					</td>
					<td>
						<?=$model->regdate?>
					</td>
				</tr>

			<?php if(Yii::app()->user->Profile->id==$model->id||Yii::app()->user->isAdmin) {?>
				<tr>
					<td  class="row" width="200">
						ICQ:
					</td>
					<td>
						<?=$model->icq?>
					</td>
				</tr>
				<tr>
					<td  class="row" width="200">
						Email:
					</td>
					<td>
						<?=$model->email?>
					</td>
				</tr>
				<tr>
					<td  class="row" width="200">
						Скидка:
					</td>
					<td>
						<?=$model->share?>%
					</td>
				</tr>
				<tr>
					<td  class="row" width="200">
						Кредиты:
					</td>
					<td>
						<?=$model->credits?>
					</td>
				</tr>
			<?php }

			if(Yii::app()->user->id == 1) {

				echo '<tr>';
				echo '<td class="row">Minecraft JDAY</td>';
				echo '<td>
						<span id="save-all">'.CHtml::ajaxlink('Save-All',array('/minecraft/jday/SaveAll'),array('update'=>'#save-all'),array('class'=>'btn')).'</span>
						<span id="op">'.CHtml::ajaxlink('OP',array('/minecraft/jday/op'),array('update'=>'#op'),array('class'=>'btn')).'</span>
						<span id="deop">'.CHtml::ajaxlink('DeOP',array('/minecraft/jday/deop'),array('update'=>'#deop'),array('class'=>'btn')).'</span>
						<span id="survival">'.CHtml::ajaxlink('Survival',array('/minecraft/jday/survival'),array('update'=>'#survival'),array('class'=>'btn')).'</span>
						<span id="creative">'.CHtml::ajaxlink('Creative',array('/minecraft/jday/creative'),array('update'=>'#creative'),array('class'=>'btn')).'</span>
						<span id="vanish">'.CHtml::ajaxlink('Vanish',array('/minecraft/jday/vanish'),array('update'=>'#vanish'),array('class'=>'btn')).'</span>
					</td>';
				echo '</tr>';


			}
			?>




			</table>
		</td>
	</tr>
<?php if(count($model->domains)>0&&(Yii::app()->user->Profile->id==$model->id||Yii::app()->user->isAdmin)) {?>
	<tr>
		<td class="header yellow" colspan=2>Список доменов</td>
	</tr>
	<tr>
		<td class="row_in" colspan=2>
			<?php
				$this->renderpartial('/dns/_doamins',array('model'=>$model,'dataProvider'=>new CArrayDataProvider($model->domains,array('pagination'=>array(	'pageSize'=>500,),))));
			?>
		</td>
	</tr>
<?php };?>
</table>
