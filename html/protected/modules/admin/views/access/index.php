<style>
.menu li {
	margin:2px;
	background:#DDD;
	border-radius:3px;
	padding-left:5px;
}
.menu li a {
	text-decoration:none;
}
.menu li.active {
	background:#F33;
}

</style>
<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	Yii::app()->getModule('admin')->name=>array('/admin/global/index'),
	'Права доступа'=>array('/admin/access/index'),
);

echo CHtml::beginForm('','POST',array('id'=>'form-access'));

?>

<table class="table-choc border">
	<tr>
		<td class="header" colspan="4">Права доступа на сайте</td>
	</tr>
	<tr>
		<td class="header green" width="220">Модули</td>
		<td class="header yellow" width="220"><?php echo $module?'Действия для '.$module:'Действия';?></td>
		<td class="header red" width="220"><?php echo $controller?'Права для '.$controller:'Права';?></td>
		<td class="header blue">Группы</td>
	</tr>
	<tr valign="top">
		<td>
			<?php
				$items = array();
				foreach(Yii::app()->metadata->getModules() as $mod) {
					$mname = Yii::app()->getModule($mod)->name;
					$items[] = array('label'=>$mname?$mname:$mod, 'url'=>array('/admin/access/index','module'=>$mod),);
				}
					$this->widget('zii.widgets.CMenu',
						array(
							'htmlOptions'=>array('class'=>'menu'),
							'encodeLabel'=>false,
							'items'=>$items,
						)
					);
				?>

		</td>
		<td>
		<?php
			if($module) {
				$item_c = array();
				foreach(Yii::app()->metadata->getControllers($module) as $cont) {
					$item_c[] = array('label'=>$cont, 'url'=>array('/admin/access/index','module'=>$module,'controller'=>$cont,'group'=>$group),);
					//echo $cont;
				}
			} else {
				foreach(Yii::app()->metadata->getControllers() as $cont) {
					$item_c[] = array('label'=>$cont, 'url'=>array('/admin/access/index','controller'=>$cont,'group'=>$group),);
					//echo $cont;
				}

			}

			$this->widget('zii.widgets.CMenu',
						array(
							'htmlOptions'=>array('class'=>'menu'),
							'encodeLabel'=>false,
							'items'=>$item_c,
						)
			);
		?>
		</td>
		<td>
			<?php
				if($controller) {
					foreach(Yii::app()->metadata->getActions($controller, $module) as $a) {
						$permanent = false;
						$css = 'transparent';
						$cc = new $controller;
						foreach($cc->accessRules() as $zz) {

							if($zz[0] == 'allow') {
								$actions_tm = array();
								foreach($zz['actions'] as $act_tmp) {$actions_tm[]=trim(mb_strtolower($act_tmp));}
								//echo '<pre>'.print_r($actions_tm, true).'</pre>';

								if($actions_tm&&$zz['users'][0]=='*'&&in_array(mb_strtolower($a), $actions_tm)) {
									$permanent = true;
									$css = '#F77';
									//echo '<pre>'.print_r($zz, true).'</pre>';
								} elseif($actions_tm&&$zz['users'][0]=='@'&&in_array(mb_strtolower($a),$actions_tm)) {
									//echo '<pre>'.print_r($zz, true).'</pre>';
									$css = '#77F';
									$permanent = true;
								}

							}
						}
						//echo '<pre>'.print_r(array('module'=>$module,'controller'=>$controller,'action'=>$a,'group_id'=>$group), true).'</pre>';
						$find_c = Access::model()->findByAttributes(array('module'=>mb_strtolower($module),'controller'=>mb_strtolower($controller),'action'=>mb_strtolower($a),'group_id'=>$group));
						if($find_c) {
							echo '<div style="background:#aFa;margin:2px;border-radius:3px;">'.CHtml::checkbox('Access['.$a.']',1).''.$a.'</div>';
						} else {
							if($permanent) {
								echo '<div style="background:'.$css.';margin:2px;border-radius:3px;">'.CHtml::checkbox('Access['.$a.']',1,array('disabled'=>'disabled')).''.$a.'</div>';
							} else {
								echo CHtml::checkbox('Access['.$a.']').''.$a.'<br>';
							}
						}

					}
				}
			?>
		</td>
		<td>
			<?php
				foreach(Group::model()->findall() as $gr) {
					//if($gr->id>=0&&$gr->id<Yii::app()->user->GroupId) continue;
					$item_g[] = array('label'=>'['.$gr->id.'] '.$gr->name, 'url'=>array('/admin/access/index','module'=>$module,'controller'=>$controller,'group'=>$gr->id),'active'=>$group==$gr->id?true:false);
				}
				$this->widget('zii.widgets.CMenu',
						array(
							'htmlOptions'=>array('class'=>'menu'),
							'encodeLabel'=>false,
							'items'=>$item_g,
						)
				);

			?>
		</td>
	</tr>
	<tr>
		<td class="footer" colspan="4">
		<?php echo CHtml::submitbutton('Сохранить', array('class'=>'bbcode'));?>
		</td>
	</tr>

</table>

<?php
echo CHtml::endForm();
?>