<tr valign="top">
	<td rowspan=2 width="100">
	<?php
		echo CHtml::link(CHtml::image($data->img_mini,$data->title,array('width'=>125)),$data->source_url);
		echo '<br><b>Цена: </b>'.$data->cost .' '.$data->currency;
	?>
	</td>
	<td class="header" height="16">
	<?php
		echo $data->title;
	?>
	<div style="float:right;">
	<?php
		echo $data->created;
	?>
	</div>
	</td>
</tr>
<tr>
	<td class="row_in">
		<table>
			<tr valign="top">
				<td style="position:relative;">
					<?php
						echo $data->Sceenshots;
					?>
					<?php
						echo $data->text;
					?>
					<div style="position:absolute;right:2px;bottom:2px;">
						<i><?php
							echo $data->from;
						?></i>
					</div>
				</td>
				<td width="260">
					<?php
						foreach(unserialize($data->detail) as $k=>$v) {							if(in_array($k,array('Марка:','Модель:','Год выпуска:','Доп. опции:'))) continue;							echo '<b>'.$k.'</b> '.$v.'<br>';						}
					?>
				</td>
			</tr>
		</table>
	</td>
</tr>