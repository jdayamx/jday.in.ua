<?php foreach($comments as $comment): ?>
<table class="table-choc border" id="c<?php echo $comment->id; ?>">
<tr>
<td class="thead"><?php echo $comment->authorLink; ?> прокомментировал:</td><td width="30" class="thead">
<?php echo CHtml::link("#{$comment->id}", $comment->getUrl($post), array(
		'class'=>'cid',
		'title'=>'Постоянная ссылка на этот комментарий',
	)); ?>
</td>
</tr>
<tr>
<td colspan="2" class="row2"><?php echo date('F j, Y \a\t h:i a',$comment->create_time); ?></td>
</tr>
<tr>
<td colspan="2" class="row2 maximg">
<?php echo nl2br(CHtml::encode($comment->content)); ?>
</td>
</tr>
</table>
<br>
<?php endforeach; ?>