<?php
//print_r($data['title']);
?>
<table class="table-choc border shadow">
	<tr>
		<td class="header"><?php  echo $data['title']?></td>
	</tr>
	<tr>
		<td>
		<?php
			$this->widget('zii.widgets.CMenu',
							array(
								'htmlOptions'=>array('class'=>'icons_admin'),
								'encodeLabel'=>false,
								'items'=>$data['items']
							)
			);
		?>

		</td>
	</tr>
</table>

<br>
