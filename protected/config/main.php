<?php

return array(
    'name' => 'Лиза алерт',
    'language' => 'ru',
    'defaultController' => 'site',
    'homeUrl'=>'/admin',
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.controllers.*',
        'application.modules.user.models.*',
        'application.modules.user.components.*',
    ),
    #...
    'modules' => array(
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'password',
            'generatorPaths' => array('application.gii'),
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
        'admin',
    ),
    'components' => array(
        'clientScript' => array(
            'scriptMap' => array(
                'jquery.min.js' => '/static/js/vendor/jquery-1.9.1.js',
                'jquery.js' => '/static/js/vendor/jquery-1.9.1.js',
            //'jquery-ui.min.js' => '/js/vendor/jquery-ui-1.10.3.custom.min.js',
            )
        ),
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(
                //hard-code
                '<id:\d+>' => 'site/frame',
                
                //general
                array('<model>api/list', 'pattern' => 'api/<model:\w+>', 'verb' => 'GET'),
                array('<model>api/view', 'pattern' => 'api/<model:\w+>/<id:\d+>', 'verb' => 'GET'),
                array('<model>api/update', 'pattern' => 'api/<model:\w+>/<id:\d+>', 'verb' => 'PUT'),
                array('<model>api/delete', 'pattern' => 'api/<model:\w+>/<id:\d+>', 'verb' => 'DELETE'),
                array('<model>api/create', 'pattern' => 'api/<model:\w+>', 'verb' => 'POST'),
                array('<model>api/<action>', 'pattern' => 'api/<model:\w+>/<action:\w+>'),
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:[A-Za-z]\w+>' => '<controller>/<action>',
                //'<action:\w+>' => 'site/<action>',
            ),
        ),
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
            'loginUrl' => array('site/login'),
            'returnUrl'=>'/admin'
        ),
        'db' => array(
            'class' => 'system.db.CDbConnection',
            'connectionString' => 'mysql:host=localhost;port=3306;dbname=liza',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            // 'enableProfiling' => true,
            'schemaCachingDuration' => 300,
            'enableParamLogging' => true,
            'enableProfiling' => true,
        ),
        'authManager' => array(
            'class' => 'CDbAuthManager',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
//                array(
//                    'class' => 'CWebLogRoute',
//                ),
            ),
        ),
    ),
    'params' => require(dirname(__FILE__) . '/params.php'),
);

