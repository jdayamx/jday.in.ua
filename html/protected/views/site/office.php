<?php

$_date = date('Ymd', strtotime($date));

$d = $data[$_date];
$_times = $d['time'];
$times = array_reverse($d['time']);

//echo $time;

?>
<table class="table-choc border">
	<tr>
		<td class="header">
			Камера наблюдения <?php echo $date.' '.$d['time_current']; ?>
		</td>
	</tr>
	<tr>
		<td class="footer" style="padding:8px;max-width:940px;">
			<?php 
				$_data = $data;
				unset($_data['path']);
			   	foreach($_data as $dat=>$d) {
			   		echo CHtml::link('&nbsp;'.date('Y-m-d',strtotime($dat)).'&nbsp;',array('/site/office','date'=>date('Y-m-d',strtotime($dat))),array('class'=>'btn','style'=>'float:left;'.($date==date('Y-m-d',strtotime($dat))?'color:green;':'')));
			   	}
			?>
		</td>
	</tr>
	<tr>
		<td class="footer" style="padding:8px;">
			<?php 				
			   	foreach($_times as $tim=>$t) {
			   		echo CHtml::link('&nbsp;'.$tim.'&nbsp;',array('/site/office','date'=>date('Y-m-d',strtotime($_date)),'time'=>$tim),array('class'=>'btn','style'=>($time==$tim?'color:green;':'')));
			   	}
			?>
		</td>
	</tr>
	<tr>
		<td class="footer" style="padding:8px;">
			<?php 						
		   		echo CHtml::ajaxlink('&nbsp;Конвертировать в видео&nbsp;',array('/site/office','do'=>'convert','date'=>date('Y-m-d',strtotime($_date)),'time'=>$time),array('update'=>'#screen_w',/*'complete'=>'function() {$("#screen_w").html("Ok");}',*/'beforeSend' => 'function() {$("#screen_w").html("Погоди пока видео конвертится...");}'),array('class'=>'btn','style'=>'color:blue;'));	
			?>
		</td>
	</tr>
	<tr>
		<td width="30%" class="row" id="screen">
		<div id="screen_w"></div>
		<?php            
			//echo $data['path'].DIRECTORY_SEPARATOR.$_date.DIRECTORY_SEPARATOR.$d['time_current'].DIRECTORY_SEPARATOR.'*.jpg';
			$files = glob($data['path'].DIRECTORY_SEPARATOR.$_date.DIRECTORY_SEPARATOR.$time.DIRECTORY_SEPARATOR.'*.*', GLOB_NOSORT);
			arsort($files);
			foreach($files as $f) {
				$file = str_replace('/www/test.jday.in.ua/html','',$f);
				$file_info = pathinfo($f);
				switch($file_info['extension']) {
					case 'mpg':
						echo '<div style="width:636px;height:477px;float:left;display: inline-block;"><embed type="application/x-vlc-plugin"
pluginspage="http://www.videolan.org"version="VideoLAN.VLCPlugin.2"  width="100%"        
height="100%" id="vlc" loop="yes"autoplay="yes" target="'.$file.'"></embed></div>';
					break;
					default:
						echo CHtml::image($file,$file,array('width'=>159,'style'=>'float:left;','title'=>$file_info['filename']));
				}
				
			}
		?>
		</td>
	</tr> 
	<tr>
		<td class="footer" style="padding:8px;">
			<?php 						
		   		echo CHtml::ajaxlink('&nbsp;Конвертировать в видео&nbsp;',array('/site/office','do'=>'convert','date'=>date('Y-m-d',strtotime($_date)),'time'=>$tim),array('update'=>'#screen','complete'=>'function() {$("#screen_w").html("Ok");}','beforeSend' => 'function() {$("#screen_w").html("Погоди пока видео конвертится...");}'),array('class'=>'btn','style'=>'color:blue;'));	
			?>
		</td>
	</tr>
</table>