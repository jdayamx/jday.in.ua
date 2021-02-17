<?php $this->beginContent('//layouts/main'); ?>

	<div style="width:22%;float:left;margin:2px;">
		<?php echo $this->menu; ?>
	</div>
	<div style="width:77%;float:left;margin:2px;" class="info">
		<?php echo $content; ?>
	</div>
	<div style="clear:both;"></div>
<?php $this->endContent(); ?>