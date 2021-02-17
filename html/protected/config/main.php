<?php
mb_internal_encoding('UTF-8');
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
$modules = array();
//$models = array();
foreach(scandir(realpath(dirname(__FILE__).DIRECTORY_SEPARATOR.'..').DIRECTORY_SEPARATOR.'modules') as $md) {
	if(!in_array($md,array('.','..'))) $modules[] = $md;
	// ищем модели в модуле

}
return CMap::mergeArray(
require(dirname(__FILE__).'/log.php'),array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	//'baseUrl'=>'https://jday.in.ua',
	'name'=>'Портал jDay.in.ua',

	// preloading 'log' component
	'preload'=>array('log'),
	'sourceLanguage'    =>'en',
	'language'          =>'ru',

	// autoloading model and component classes
	'import'=>array(
		'application.modules.admin.models.*',
		'application.models.*',
		'application.components.*',
		'ext.HalfLife.components.*',
		'application.modules.autobot.models.*',
		'application.modules.forum.models.*',
		'application.modules.news.models.*',
	),

	'defaultController'=>'site',

	'components'=>array(
		'session' => array(
		    'class' => 'CCacheHttpSession',
		    'cacheID' => 'cache',
		    'sessionName' => 'SESSIONN',
		    //'cookieParams' => array(
		        //'httponly' => true,
		        //'domain' => '.' .  $_SERVER['SERVER_NAME'],
		        //'domain' => '.jday.in.ua',
		    //),
		),

		'mailer'=>array(
			'class'=>'application.extensions.mailer.EMailer',
			'SMTPAuth'=>true,
				//'Host'=>'mail.proline.net.ua:25',
				//'Username'=>'eduard.vatamanjuk@proline.in.ua',
				//'Password'=>'2idP0Bd3er8Z',
			'Host'=>'mail.jday.in.ua:25',
			//'SMTPSecure' => 'ssl',
			'Username'=>'jday@jday.in.ua',
			'Password'=>'voodoo',
			'From'=>'jday.in.ua',
			'FromName'=>'jday',
			'CharSet'=>'utf-8',
		),

		'settings'=>array(
	        'class'             => 'ext.CmsSettings',
    	    'cacheComponentId'  => 'cache',
        	'cacheId'           => 'global_website_settings',
	        'cacheTime'         => 84000,
    	    'tableName'     => 'config',
        	'dbComponentId'     => 'db',
	        'createTable'       => true,
    	    'dbEngine'      => 'InnoDB',
        ),

		'mdl'=>array(
        	'class'=>'ext.game.mdl',
    	),

		'bsp2'=>array(
        	'class'=>'ext.game.bsp2',
    	),

		'xls'=>array(
			'class'=>'application.extensions.xls.xls',
		),

		'bsp'=>array(
        	'class'=>'ext.game.bsp',
    	),

		'zip'=>array(
        	'class'=>'ext.zip.EZip',
    	),

		'rar'=>array(
        	'class'=>'ext.rar.ERar',
    	),

    	'p7z'=>array(
        	'class'=>'ext.7z.p7z',
    	),

		'email'=>array(
      	  	'class'=>'ext.email.Email',
       		'delivery'=>'php', //Will use the php mailing function.
        //May also be set to 'debug' to instead dump the contents of the email into the view
    	),

    	'whois'=>array(
      	  	'class'=>'ext.whois',
       		//'delivery'=>'php', //Will use the php mailing function.
        //May also be set to 'debug' to instead dump the contents of the email into the view
    	),

		'cache'=>array(
            'class'=>'system.caching.CApcCache',
        ),

		'metadata'=>array(
			'class'=>'ext.Metadata'
		),

		'user'=>array(
			// enable cookie-based authentication
			'class'=>'WebUser',
			'loginUrl'=>array('/site/login'),
			'allowAutoLogin'=>true,
		),

		'authManager'=>array(
            	'class'=>'CDbAuthManager',
	            'connectionID'=>'db',
    	        // Path to SDbAuthManager in srbac module if you want to use case insensitive
				//access checking (or CDbAuthManager for case sensitive access checking)

				#'class'=>'modules.srbac.components.SDbAuthManager',
				// The database component used
				#'connectionID'=>'db',
				// The itemTable name (default:authitem)
				//'itemTable'=>'items',
				#'itemTable'=>'AuthItem',
				// The assignmentTable name (default:authassignment)
				//'assignmentTable'=>'assignments',
				#'assignmentTable'=>'AuthAssignment',
				// The itemChildTable name (default:authitemchild)
				//'itemChildTable'=>'itemchildren',
				#'itemChildTable'=>'AuthItemChild',
	    ),

	    'telnet'=>array(
			'class'=>'application.extensions.YiiTelnet.YiiTelnet',
		),

		//'db'=>array(
		//	'connectionString' => 'sqlite:protected/data/blog.db',
		//	'tablePrefix' => 'tbl_',
		//),
		// uncomment the following to use a MySQL database

		'db'=>array(
			'class'=>'system.db.CDbConnection',
			'connectionString' => 'mysql:host=localhost;dbname=jday',
			'emulatePrepare' => true,
			'enableProfiling' => true,
			'username' => 'jday',
			'password' => 'FrLrqZFBP9XZu226',
			'charset' => 'utf8',
//			'tablePrefix' => 'tbl_',
		),
		'sh'=>array(
			'class'=>'system.db.CDbConnection',
			'connectionString' => 'mysql:host=localhost;dbname=sh',
			'emulatePrepare' => true,
			'enableProfiling' => true,
			'username' => 'jday',
			'password' => 'FrLrqZFBP9XZu226',
			'charset' => 'utf8',
		),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
				'/<view:meconomy>.html'=>'site/page',
				'<controller:docs><action:imgs><img:.*?>'=>'/img/slider/mapping.jpg',
				'<view:donat>.html'=>'site/page',
				'/user/<name:.*?>/' => '/site/profile',
				'sitemap.xml'=>'site/sitemap',
				'<view:repo>.xml'=>'site/page',
				'post/<id:\d+>/<title:.*?>'=>'post/view',
				'posts/<tag:.*?>'=>'post/index',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				'<module:\w+>/<controller:\w+>-<action:\w+>.html'=>'<module>/<controller>/<action>',
			),
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),
	'modules' => array_merge(array(
		'games',
		'admin',
		'books',
		'autobot',
		'forum',
   		'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>'voodoo',
            'ipFilters'=>array('93.126.70.50', '93.126.70.90'),
           // 'generatorPaths' => array(
         	//	'bootstrap.gii'
       		//),
            // 'newFileMode'=>0666,
            // 'newDirMode'=>0777,
        ),
    ),$modules),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require(dirname(__FILE__).'/params.php'),
));