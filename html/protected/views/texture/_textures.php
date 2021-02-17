<table class="table-choc border">
	<tr>
		<td class="header">Фаворитные</td>
	</tr>
	<tr>
		<td>
		<?php
			foreach($model as $k=>$texture) {
				echo '<div style="position:relative;">'.CHtml::image($texture,$texture,array('style'=>'max-width:200px;','draggable'=>'draggable')).'<div style="position:absolute;top:0;right:0;">'.CHtml::ajaxlink(CHtml::image('/img/icons/cross-icon.png','X'),array('texture/rem','link'=>$texture),array('update'=>'#new_form'),array('id'=>'t'.md5($texture))).'</div></div>';
				echo "<script>
					jQuery('body').on(
						'click',
						'#t".md5($texture)."',
						function(){							jQuery.ajax({'url':'/texture/rem?link=".urlencode($texture)."',
							'cache':false,
							'success':function(html){jQuery(\"#new_form\").html(html)
							}
						});
						return false;});
					</script>";
			}

		?>
		</td>
	</tr>
</table>
<br>