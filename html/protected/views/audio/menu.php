<table class="table-choc border">
	<tr>
		<td class="header">
			Фильтр
		</td>
	</tr>
	<tr>
		<td width="30%" class="row">
			<?php
				$data = Yii::app()->db->createCommand('SELECT format,count(id) as count from audio WHERE format not in ("ztmp") GROUP BY format')->queryAll();
				foreach($data as $f) {
				//print_r($data);
				//Audio.php
			?>
		</td>
	</tr>
</table>