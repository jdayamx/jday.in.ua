<div class="mbox" style="margin: 2px;margin-left:16px;">
	<table style="height:100%;">
		<tr>
			<td class="header <?php echo $data->info?'':' yellow'?>" title="Карта: <?=$data->mapname?>"><?=strlen($data->mapname)>17?mb_substr($data->mapname,0,17).'..':$data->mapname?></td>
		</tr>
		<tr>
			<td class="row imb" style="text-align:center;">
				<?=$data->CoverImage;?>
			</td>
		</tr>
		<tr height="22">
			<td class="row">
				<?='<small>'.$data->gamename.'</small><br>'.$data->gamemod?>
			</td>
		</tr>
	</table>
</div>