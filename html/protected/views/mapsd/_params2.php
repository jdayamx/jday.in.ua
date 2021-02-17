<table border=0>
	<tr valign="top">
		<td class="row_in" width="50%">
			<table border=0>
				<tr><td class="row" width="55%">Версия BSP</td><td><?=$data['version'];?></td></tr>
				<tr><td class="row">Версия карты</td><td><?=$data['mapversion'];?></td></tr>
				<tr><td class="row" >Размерность карты</td><td><?=implode('<br>',explode(',',$data['MaxRange']));?></td></tr>
				<tr><td class="row">Название SkyBox</td><td><?=$data['skyname'];?></td></tr>
				<tr><td class="row">Узлы (Node)</td><td><?=$data['nodes'];?></td></tr>
				<!--<tr><td class="row" width="75%">Листья (leaves)</td><td><?=$data['leaves'];?></td></tr>
				<tr><td class="row">Индексы сурфейсов (markSurfaces)</td><td><?=$data['markSurfaces'];?></td></tr>-->
				<tr><td class="row">Модели (models)</td><td><?=$data['models'];?></td></tr>
				<tr><td class="row">Плоскости (planes)</td><td><?=$data['planes'];?></td></tr>
				<!--<tr><td class="row">Вершины (vertices)</td><td><?=$data['vertices'];?></td></tr>-->
				<tr><td class="row">Ребра (edges)</td><td><?=$data['edges'];?></td></tr>
				<tr><td class="row">Края (surfEdges)</td><td><?=$data['surfEdges'];?></td></tr>
				<tr><td class="row">Поверхности (faces)</td><td><?=$data['faces'];?></td></tr>







			</table>
		</td>
		<td class="row_in">
			<table border=0>
				<tr><td class="header" colspan=2>Entities</td></tr>
					<?php
						ksort($data['entities']);
						$mac_pl = 0;
						foreach ($data['entities'] as $key=>$val)
						{
							switch($key)
							{
								case 'info_player_teamspawn':
									$mac_pl +=$val;
								break;
								case 'info_player_counterterrorist':
									$mac_pl +=$val;
								break;
								case 'info_player_commons':
									$mac_pl +=$val;
								break;
								case 'info_player_human':
									$mac_pl +=$val;
								break;
								case 'info_player_observer':
									$mac_pl +=$val;
								break;
								case 'info_player_zombie':
									$mac_pl +=$val;
								break;
								case 'info_player_terrorist':
									$mac_pl +=$val;
								break;
								case 'info_player_deathmatch':
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

								default:
							}
							$cc = '';
							if ($key == 'info_player_counterterrorist'&&$val>=32) $cc = ' class="yellow"';
							if ($key == 'info_player_terrorist'&&$val>=32) $cc = ' class="yellow"';
							echo '<tr><td class="row" width="70%">'.$key.'</td><td'.$cc.'>'.$val.'</td></tr>';
						}
						$cc = ' class="green"';
						if ($mac_pl<64) $cc = ' class="yellow"';
						if ($mac_pl>64) $cc = ' class="red"';
						echo '<tr><td class="header" colspan=2>Дополнительно</td></tr>';
						echo '<tr><td class="row" width="70%">Всего игровых слотов</td><td'.$cc.'>'.$mac_pl.'</td></tr>';
					?>

			</table>
		</td>
	</tr>
</table>

<?php
//print_r($data);
?>
