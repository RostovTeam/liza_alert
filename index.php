<?php

date_default_timezone_set('Europe/Moscow');
define('YII_DEBUG',true);

$yii = '../framework/yii.php';
$config = '/protected/config/main.php';

require_once($yii);
Yii::createWebApplication($config)->run();