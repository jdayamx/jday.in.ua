<?php

$ips = array('93.126.70.150','94.45.64.132','93.126.70.90');
$ips = array();


if (in_array($_SERVER['REMOTE_ADDR'], $ips)) {
// echo $_SERVER['SERVER_ADDR'] . ' / ' . $_SERVER['REMOTE_ADDR'];
return array(
	'components'=>array(
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(

				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),

				// uncomment the following to show log messages on web pages
				   array(
            // направляем результаты профайлинга в ProfileLogRoute (отображается
            // внизу страницы)
            'class'=>'CProfileLogRoute',
            'levels'=>'profile',
            'enabled'=>true,
        ),

			),
		),
	),
);
}
else {
	return array();
}


