<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL ^ E_NOTICE);
define('ACRDIR',__DIR__.'/../');
$WEDOCTORCONFIG = parse_ini_file(__DIR__.'/../system/WEDOCTOR_CONFIG');

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');
defined('__ROOT__') or define('__ROOT__', dirname(dirname(__FILE__)));
define("WECHAT_URL", BASE_URL.'/wechat.php');
define('WECHAT_TOKEN', '6d8fd128e41186469f2f98e0f3e523eb');
define('ENCODING_AES_KEY', "jH0eyd8HjsnmEw6OfwDBXwvzrbjYa4Mdw0nbrvk4Mwy");
define("WECHAT_APPID", 'wx52bb6ea1f6dfa436');
define("WECHAT_APPSECRET", '528c79b8b1ccef4cd0c39d9a7522bd73');
define('WEDOCTORS_KEY','KzhRb99Tn37dPP4u');

define('ACAR_IMGURL','http://img.acar.wzgeek.com/');
require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../config/web.php');

(new yii\web\Application($config))->run();
