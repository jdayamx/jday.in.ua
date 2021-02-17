<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	Yii::app()->getModule('adm')->name=>array('/adm/general/index'),
	$this->module->name,
);
$xml = simplexml_load_file('http://jday.in.ua/repo.xml');

/*
INSERT INTO `jday`.`repo_items` (`id`, `pid`, `category_id`, `name`, `version`, `image`, `cover`, `description`) VALUES (NULL, '3', '1', 'Группы пользователей', '1.0', 'http://jday.in.ua/img/admin/Group-icon.png', 'http://jday.in.ua/img/admin/Group-cover.png', '<b>Группы</b> пользователей');
*/

?>
<table class="table-choc border">
	<tr>
		<td class="header" colspan="2"><?php echo $this->module->name;?></td>
	</tr>
	<tr>
		<td colspan="2">
			<?php
				$items = array();
				foreach($xml->items->item as $item) {
					//if($cat->pid==0) echo '<h2>'.$cat->name.'</h2>';
					$items[(int) $item->category][] = $item;
					//echo '<pre>'.print_r($item,true).'</pre>';
				}
				//echo '<pre>'.print_r($items,true).'</pre>';
				foreach($xml->categories->category as $cat) {
					if($cat->pid==0) {
						echo '<h2>'.$cat->name.'</h2>';
						echo '<div style="float:left;width:100%;padding:5px;">';
						foreach($items[(int) $cat->id] as $item) {
							switch((string)$item->type){
								case 'module':
									//echo 'V';
									if(strlen(Yii::app()->getModule((string)$item->tname)->name)) {
										//echo $item->version.'->'.Yii::app()->getModule((string)$item->tname)->version.'<br>';
										if((float)$item->version>Yii::app()->getModule((string)$item->tname)->version){
											$bg = 'background-image:url(/img/t_red.png);background-repeat:no-repeat;background-position:top left;';
										} else {
											$bg = 'background-image:url(/img/t_green.png);background-repeat:no-repeat;background-position:top left;';
										}

									} else {
										$bg = '';
									}
								break;
								default:
									$bg = '';
							}
							echo '<div class="shadow" style="margin-right:35px;margin-bottom:20px;float:left;text-align:center;height:210px;background:#fff;'.$bg.'border:1px solid #777;width:150px;">'.CHtml::image((string) $item->cover,'',array('width'=>'')).'<p style="font-size:18px;" title="'.$item->name.'">'.(strlen($item->name)>13?mb_substr($item->name,0,13).'..':$item->name).'</p><p style="margin:1px;font-weight:bold;color:#8AC100;text-align:right;">'.((float)$item->cost?'<font color="darkred">'.$item->cost.'₴ </font>':'БЕСПЛАТНО').'</p></div>';
							//echo '<pre>'.print_r($item,true).'</pre>';
						}
						echo '</div>';

					}
					//echo '<pre>'.print_r($cat,true).'</pre>';
				}
				echo '<pre>'.print_r($xml,true).'</pre>';
			?>
		</td>
	</tr>
</table>