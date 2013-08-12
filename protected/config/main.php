<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'tLab',
	'sourceLanguage'=>'pt',

	// preloading 'log' component
	'preload'=>array(
		'log',
		'bootstrap', // preload the bootstrap component
//                'translate',
	),
    
	'aliases' => array(
		'xupload' => 'ext.xupload'
	),
    
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
                'application.models.forms.*',
		'application.components.*',
		//Translate Module
                'application.modules.translate.TranslateModule',
                'application.modules.translate.controllers.*',
                'application.modules.translate.models.*',
                // Extensions
                'ext.Randomness.Randomness',
                'ext.helpers.XHtml',
	),

	'modules'=>array(
		'translate'=>array(
                        'class'=>'application.modules.translate.TranslateModule',
                ),
		'api'=> array(
                    'defaultController' => 'service',
                ),
		'cms'=> array(),
		'portal'=> array(
                    'defaultController' => 'dashboard',
                ),
		'site'=> array(
                    'defaultController' => 'front',
                ),
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'12345',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
			'generatorPaths'=>array(
                            'bootstrap.gii',
                        ),
		),
	),

	// application components
	'components'=>array(
            'image'=>array(    
                'class'=>'application.extensions.image.CImageComponent',           
                'driver'=>'GD',
            ),

            'user'=>array(
                // enable cookie-based authentication
                'allowAutoLogin'=>true,
                // this is actually the default value
                'loginUrl'=>array('/site'),
                'authTimeout'=>3600
            ),
            
            // UserCounter
            'counter' => array(
                'class' => 'ext.usercounter.UserCounter',
            ),
            
            // uncomment the following to enable URLs in path-format
            'urlManager'=>array(
                    'class'=>'application.components.UrlManager',
                    'urlFormat'=>'path',
                    'showScriptName'=>false,
                    'rules'=>array(
                            'gii'=>'gii',
                            'api'=>'api',
                            '<lang:(pt|en|fr|es)>/' => 'site/front',
                            '<lang:(pt|en|fr|es)>/<module:\w+>/<controller:\w+>/<id:\d+>'=>'<module>/<controller>/view',
                            '<lang:(pt|en|fr|es)>/<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<module>/<controller>/<action>',
                            '<lang:(pt|en|fr|es)>/<module:\w+>/<controller:\w+>/<action:\w+>/*'=>'<module>/<controller>/<action>',
                    ),
            ),

            'bootstrap' => array(
                'class' => 'application.extensions.bootstrap.components.Bootstrap',
            ),
                        	    
            // uncomment the following to use a MySQL database

//            'db_cms'=>array(
//                    'class' => 'CDbConnection',
//                    'connectionString' => 'mysql:host=localhost;dbname=tlab_cms',
//                    'emulatePrepare' => true,
//                    'username' => 'root',
//                    'password' => 'joca232',
//                    'charset' => 'utf8',
//            ),
//            
//            'db_portal'=>array(
//                    'class' => 'CDbConnection',
//                    'connectionString' => 'mysql:host=localhost;dbname=tlab_portal',
//                    'emulatePrepare' => true,
//                    'username' => 'root',
//                    'password' => 'joca232',
//                    'charset' => 'utf8',
//            ),
//            
//            'db'=>array(
//                    'connectionString' => 'mysql:host=localhost;dbname=tlab_translate',
//                    'emulatePrepare' => true,
//                    'username' => 'root',
//                    'password' => 'joca232',
//                    'charset' => 'utf8',
//            ),

            'db_cms'=>array(
                    'class' => 'CDbConnection',
                    'connectionString' => 'mysql:host=localhost;dbname=tlab_cms',
                    'emulatePrepare' => true,
                    'username' => 'root',
                    'password' => '',
                    'charset' => 'utf8',
            ),
            
            'db_portal'=>array(
                    'class' => 'CDbConnection',
                    'connectionString' => 'mysql:host=localhost;dbname=tlab_portal',
                    'emulatePrepare' => true,
                    'username' => 'root',
                    'password' => '',
                    'charset' => 'utf8',
            ),
            
            'db'=>array(
                    'connectionString' => 'mysql:host=localhost;dbname=tlab_translate',
                    'emulatePrepare' => true,
                    'username' => 'root',
                    'password' => '',
                    'charset' => 'utf8',
            ),
            
            'errorHandler'=>array(
                    // use 'site/error' action to display errors
                    'errorAction'=>'app/error',
            ),
            'log'=>array(
                    'class'=>'CLogRouter',
                    'routes'=>array(
                            array(
                                    'class'=>'CFileLogRoute',
                                    'levels'=>'error, warning',
                                    'enabled'=>true,
                            ),
                            // uncomment the following to show log messages on web pages
                            /*
                            array(
                                    'class'=>'CWebLogRoute',
                            ),
                            */
                    ),
            ),

            // Use Message in Database and Translate Components
            'messages'=>array(
                'class'=>'CDbMessageSource',
                'connectionID'=>'db',
                'sourceMessageTable'=>'sourcemessage',
                'translatedMessageTable'=>'message',
                'onMissingTranslation' => array('TranslateModule', 'missingTranslation'),
            ),
            
            'translate'=>array(//if you name your component something else change TranslateModule
                'class'=>'translate.components.MPTranslate',
                //any avaliable options here
                'acceptedLanguages'=>array(
                      'pt'=>'Português',
                      'en'=>'English',
                      'es'=>'Español'
                ),
            ),
            
            
            'ePdf' => array(
                'class'         => 'ext.yii-pdf.EYiiPdf',
                'params'        => array(
                    'mpdf'     => array(
                        'librarySourcePath' => 'application.vendors.mpdf.*',
                        'constants'         => array(
                            '_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
                        ),
                        'class'=>'mpdf', // the literal class filename to be loaded from the vendors folder
                        /*'defaultParams'     => array( // More info: http://mpdf1.com/manual/index.php?tid=184
                            'mode'              => '', //  This parameter specifies the mode of the new document.
                            'format'            => 'A4', // format A4, A5, ...
                            'default_font_size' => 0, // Sets the default document font size in points (pt)
                            'default_font'      => '', // Sets the default font-family for the new document.
                            'mgl'               => 15, // margin_left. Sets the page margins for the new document.
                            'mgr'               => 15, // margin_right
                            'mgt'               => 16, // margin_top
                            'mgb'               => 16, // margin_bottom
                            'mgh'               => 9, // margin_header
                            'mgf'               => 9, // margin_footer
                            'orientation'       => 'P', // landscape or portrait orientation
                        )*/
                    ),
                    'HTML2PDF' => array(
                        'librarySourcePath' => 'application.vendors.html2pdf.*',
                        'classFile'         => 'html2pdf.class.php', // For adding to Yii::$classMap
                        /*'defaultParams'     => array( // More info: http://wiki.spipu.net/doku.php?id=html2pdf:en:v4:accueil
                            'orientation' => 'P', // landscape or portrait orientation
                            'format'      => 'A4', // format A4, A5, ...
                            'language'    => 'en', // language: fr, en, it ...
                            'unicode'     => true, // TRUE means clustering the input text IS unicode (default = true)
                            'encoding'    => 'UTF-8', // charset encoding; Default is UTF-8
                            'marges'      => array(5, 5, 5, 8), // margins by default, in order (left, top, right, bottom)
                        )*/
                    )
                ),
            ),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);