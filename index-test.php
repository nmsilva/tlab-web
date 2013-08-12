<?php
/**
 * This is the bootstrap file for test application.
 * This file should be removed when the application is deployed for production.
 */

define('ASSETS_FOLDER',dirname(__FILE__).'/assets');
define('FRAMEWORK_FOLDER',dirname(__FILE__).'/framework/');
define('CONFIG_FOLDER',dirname(__FILE__).'/protected/config/');
define('MODULES_FOLDER',dirname(__FILE__).'/protected/modules/');

// change the following paths if necessary
$yii=FRAMEWORK_FOLDER.'framework/yii.php';
$config=CONFIG_FOLDER.'main.php';


require_once($yii);
Yii::createWebApplication($config)->run();
