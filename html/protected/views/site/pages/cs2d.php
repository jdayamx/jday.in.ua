<?php

Yii::import('application.components.classes.cs2d');

$map = new cs2d(Yii::getPathOfAlias('application.views.site.pages').'/awp_TuGa_v1.0.map');
echo '<table><tr valign="top"><td><pre>'.print_r($map,true).'</pre></td>';

$map = new cs2d(Yii::getPathOfAlias('application.views.site.pages').'/dm_overwatch.map');
echo '<td><pre>'.print_r($map,true).'</pre></td></tr></table>';



?>