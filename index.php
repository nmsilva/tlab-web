<?php

date_default_timezone_set("Portugal");

define('ASSETS_FOLDER',dirname(__FILE__).'/assets');
define('FRAMEWORK_FOLDER',dirname(__FILE__).'/framework/');
define('CONFIG_FOLDER',dirname(__FILE__).'/protected/config/');
define('MODULES_FOLDER',dirname(__FILE__).'/protected/modules/');

// change the following paths if necessary
$yii=FRAMEWORK_FOLDER.'framework/yii.php';
$config=CONFIG_FOLDER.'main.php';
$globals=CONFIG_FOLDER.'globals.php';
$define=CONFIG_FOLDER.'define.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
require_once($globals);
require_once($define);

Yii::createWebApplication($config)->run();
