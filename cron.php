<?php

defined('YII_DEBUG') or define('YII_DEBUG',true);

define('FRAMEWORK_FOLDER',dirname(__FILE__).'/framework/');
define('CONFIG_FOLDER',dirname(__FILE__).'/protected/config/');

$yii=FRAMEWORK_FOLDER.'framework/yii.php';
$configFile=CONFIG_FOLDER.'main.php';

// including Yii
require_once($yii);
 
// creating and running console application
Yii::createConsoleApplication($configFile)->run();