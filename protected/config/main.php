<?php

return array(
    'name' => 'ЪGames',
    'defaultController' => 'site',
    'preload'=>array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.widgets.*',
        'application.modules.user.models.*',
        'application.modules.user.components.*',
    ),
    #...
    'modules' => array(
        'comments' => array(
            //you may override default config for all connecting models
            'defaultModelConfig' => array(
                //only registered users can post comments
                'registeredOnly' => false,
                'useCaptcha' => false,
                //allow comment tree
                'allowSubcommenting' => true,
                //display comments after moderation
                'premoderate' => false,
                //action for postig comment
                'postCommentAction' => 'comments/comment/postComment',
                //super user condition(display comment list in admin view and automoderate comments)
                'isSuperuser' => 'Yii::app()->user->checkAccess("moderate")',
                //order direction for comments
                'orderComments' => 'DESC',
            ),
            //the models for commenting
            'commentableModels' => array(
                //model with individual settings
                'News' => array(
                    'registeredOnly' => true,
                    'useCaptcha' => false,
                    'allowSubcommenting' => true,
                    //config for create link to view model page(page with comments)
                    'pageUrl' => array(
                        'route' => 'admin/news/view',
                        'data' => array('id' => 'id'),
                    ),
                ),
                //model with default settings
                'ImpressionSet',
            ),
            //config for user models, which is used in application
            'userConfig' => array(
                'class' => 'User',
                'nameProperty' => 'username',
                'emailProperty' => 'email',
            ),
        ),
        'user' => array(
            # encrypting method (php hash function)
            'hash' => 'md5',
            # send activation email
            'sendActivationMail' => false,
            # allow access for non-activated users
            'loginNotActiv' => false,
            # activate user on registration (only sendActivationMail = false)
            'activeAfterRegister' => true,
            # automatically login from registration
            'autoLogin' => true,
            # registration path
            'registrationUrl' => array('/user/registration'),
            # recovery password path
            'recoveryUrl' => array('/user/recovery'),
            # login form path
            'loginUrl' => array('/user/login'),
            # page after login
            'returnUrl' => array('/user/profile'),
            # page after logout
            'returnLogoutUrl' => array('/user/login'),
        ),
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
            'rules' => array(
                 array('<model>api/list', 'pattern' => 'api/<model:\w+>', 'verb' => 'GET'),
                array('<model>api/view', 'pattern' => 'api/<model:\w+>/<id:\d+>', 'verb' => 'GET'),
                array('<model>api/update', 'pattern' => 'api/<model:\w+>/<id:\d+>', 'verb' => 'PUT'),
                array('<model>api/delete', 'pattern' => 'api/<model:\w+>/<id:\d+>', 'verb' => 'DELETE'),
                array('<model>api/create', 'pattern' => 'api/<model:\w+>', 'verb' => 'POST'),
                array('<model>api/<action>', 'pattern' => 'api/<model:\w+>/<action:\w+>'),
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
        'user' => array(
            'class' => 'WebUser',
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
);