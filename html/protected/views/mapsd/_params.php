<table border=0>
	<tr valign="top">
		<td class="row_in" width="50%">
			<table border=0>
				<tr><td class="row" width="75%">Версия BSP</td><td><?=$data['version'];?></td></tr>
				<tr><td class="row" width="75%">Версия карты</td><td><?=$data['mapversion'];?></td></tr>
				<tr><td class="row" width="75%">Размерность карты</td><td><?=Yii::t('mygs','{n} юнит|{n} юнита|{n} юнитов',intval($data['MaxRange']));?></td></tr>
				<tr><td class="row" width="75%">Название SkyBox</td><td><?=$data['skyname'];?></td></tr>
				<tr><td class="row" width="75%">Узлы (Node)</td><td><?=$data['nodes'];?></td></tr>
				<tr><td class="row" width="75%">Листья (leaves)</td><td><?=$data['leaves'];?></td></tr>
				<tr><td class="row" width="75%">Индексы сурфейсов (markSurfaces)</td><td><?=$data['markSurfaces'];?></td></tr>
				<tr><td class="row" width="75%">Модели (models)</td><td><?=$data['models'];?></td></tr>
				<tr><td class="row" width="75%">Плоскости (planes)</td><td><?=$data['planes'];?></td></tr>
				<tr><td class="row" width="75%">Вершины (vertices)</td><td><?=$data['vertices'];?></td></tr>
				<tr><td class="row" width="75%">Ребра (edges)</td><td><?=$data['edges'];?></td></tr>
				<tr><td class="row" width="75%">Края (surfEdges)</td><td><?=$data['surfEdges'];?></td></tr>
				<tr><td class="row" width="75%">Поверхности (faces)</td><td><?=$data['faces'];?></td></tr>
				<tr><td class="header" colspan=2>Файлы</td></tr>
				<?php
					if($data['files']) {
						//ksort($data['files']);
						foreach ($data['files'] as $key=>$val)
						{
							echo '<tr><td class="row" colspan=2>'.$key.'</td></tr>';
						}
					} else echo '<tr><td class="yellow" colspan=2>Используются стандартные библиотеки</td></tr>';
				?>





			</table>
		</td>
		<td class="row_in">
			<table border=0>
				<tr><td class="header" colspan=2>Entities</td></tr>
					<?php
						ksort($data['entities']);
						$mac_pl = 0;
						foreach ($data['entities'] as $key=>$val)
						{							switch($key)
							{								case 'info_player_deathmatch':
									$mac_pl +=$val;
								break;
								case 'info_player_start':
									$mac_pl +=$val;
								break;
								case 'info_player_allies':
									$mac_pl +=$val;
								break;
								case 'info_player_axis':
									$mac_pl +=$val;
								break;
								case 'info_player_observer':
									$mac_pl +=$val;
								break;
								case 'info_player_teamspawn':
									$mac_pl +=$val;
								break;

								default:							}							$cc = '';							if ($key == 'info_player_deathmatch'&&$val>=17) $cc = ' class="yellow"';
							if ($key == 'info_player_start'&&$val>=17) $cc = ' class="yellow"';
							if ($key == 'info_player_teamspawn'&&$val>=32) $cc = ' class="yellow"';
							if ($key == 'info_player_teamspawn'&&$val==32) $cc = ' class="green"';
							echo '<tr><td class="row" width="70%">'.$key.'</td><td'.$cc.'>'.$val.'</td></tr>';						}
						$cc = ' class="green"';
						if ($mac_pl<32) $cc = ' class="yellow"';
						if ($mac_pl>32) $cc = ' class="red"';
						echo '<tr><td class="header" colspan=2>Дополнительно</td></tr>';
						echo '<tr><td class="row" width="70%">Всего игровых слотов</td><td'.$cc.'>'.$mac_pl.'</td></tr>';
					?>

			</table>
		</td>
	</tr>
	<tr>
		<td class="header" colspan=2>
			Встроенные текстуры
		</td>
	</tr>
	<tr>
		<td class="row_in" colspan=2>
         	<table class="table-choc">
				<tr valign="center">
					<td align="center" width="150" class="row">
						<img src="/img/info.png">
					</td>
					<td align="left">
						<b><font color=red>Внимание</font></b><br>Использовать материалы карт можно только с разрешения разработчика карты.
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<?php
	if(Yii::app()->user->id == 1 && $data['Textures']) {		?>
	<tr>
		<td class="footer" colspan=2 id="zd">
         	<?php
         	echo CHtml::ajaxlink('Добавить кучку текстур',array('mapsd/adddata','id'=>$model->id),array('update'=>'#zd'));
         	?>
		</td>
	</tr>
		<?php	}
	?>

	<tr>
		<td colspan=2>
			<?php
				if($data['Textures']) {
						ksort($data['Textures']);
						echo '<div style="max-width:700px;">';
						foreach ($data['Textures'] as $key=>$val)
						{							$src = false;
							$title = false;							preg_match('/title\="(.+)"/ui',$val['img'],$ret);
							preg_match('/src\="(.+)"\s{1}alt/ui',$val['img'],$rets);
							preg_match('/([a-z0-9\_\-\{\!]+)/ui',$ret[1],$rett);

							$title=trim($rett[1]);
							$src=$rets[1];
							if($title&&$src){
								$hash = md5_file(realpath('').$src);								$t_find = Texture::model()->find(array('condition'=>'hash=:hash','params'=>array(':hash'=>$hash)));
								//echo '[<input type="text" value="'.$hash.'">]';
								//echo '<p>'.print_r($rets,true).'</p>';
								$rethw = getimagesize(realpath('').$src);
								if (!$t_find) {
									echo CHtml::ajaxlink(
										'<div onmouseover="this.style.border=\'2px solid #F00\'" onmouseout="this.style.border=\'2px solid #999\'" style="margin:2px;border:2px solid #999;float:left;background: url('.$src.') no-repeat center;width:'.$rethw[0].'px;height:'.$rethw[1].'px;" id="tt_'.$id.'"></div>',
										array('texture/create'),
										array(
											'type' => 'POST',
											'data' => array(
											'new[mid]' => $model->id,
											'new[pid]' => 0,
											'new[type]' => 'png',
											'new[filename]' => trim($src),
											'new[name]' => trim($title)),
											'update'=>'#new_form'
										),
										array(
											'title'=>$title.' Размеры: '.$rethw[0].'x'.$rethw[1],
										)
									);
								} else {									//print_r($t_find->mid);
									if($t_find->mid != $model->id) {										$find_link_m = TextureMapLink::model()->findByAttributes(array('texture_id'=>$t_find->id,'map_id'=>$t_find->mid));
										if(!$find_link_m) {											$find_link_m = new TextureMapLink;
											$find_link_m->texture_id =$t_find->id;
											$find_link_m->map_id = $t_find->mid;
											$find_link_m->save(false);										}
										$find_link_c = TextureMapLink::model()->findByAttributes(array('texture_id'=>$t_find->id,'map_id'=>$model->id));
										if(!$find_link_c) {
											$find_link_c = new TextureMapLink;
											$find_link_c->texture_id =$t_find->id;
											$find_link_c->map_id = $model->id;
											$find_link_c->save(false);
										}
										//if(!$find_link_c&&!$find_link_m) echo $model->id.'!='.$t_find->mid;									}									//echo $title;
									echo CHtml::link(
										'<div onmouseover="this.style.border=\'2px solid #F00\'" onmouseout="this.style.border=\'2px solid #FF0\'" style="margin:2px;border:2px solid #FF0;float:left;background: url('.$src.') no-repeat center;width:'.$rethw[0].'px;height:'.$rethw[1].'px;" id="tt_'.$id.'"></div>',
										array('texture/view','id'=>$t_find->id),
										array(
											'title'=>$title.' Размеры: '.$rethw[0].'x'.$rethw[1],
										)
									);
								}							} else {								//echo ''.$val['img'].'&nbsp;';							}
							//print_r($title);

						}
						echo '</div>';
				} else echo 'Нет ресурсов';
			?>
		</td>
	</tr>
</table>

<?php
//print_r($data);
?>
