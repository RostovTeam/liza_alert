<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
        <title></title>
        <meta name="keywords" content="" />
        <meta name="description" content="" />

        <link href="/static/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="/static/css/style.css" type="text/css" media="screen, projection" />
            <? Yii::app()->clientScript->registerScriptFile('/static/js/vendor/jquery-1.9.1.js'); ?>

            <!--[if lte IE 6]><link rel="stylesheet" href="style_ie.css" type="text/css" media="screen, projection" /><![endif]-->
    </head>

    <body>

        <div id="wrapper">
            <a href='index.php'><img src='/static/img/logo.png'></img></a>
            <header id="header">
                <div>
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <a href="<?= Yii::app()->createUrl('site/news') ?>">News</a>
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <a href="<?= Yii::app()->createUrl('site/news', array('type' => 2)) ?>">Reviews</a>
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <a href="<?= Yii::app()->createUrl('site/games') ?>">Games</a>
                </div>
                <div style="float:right">
                    <? if (Yii::app()->user->isGuest): ?>
                        <a href="/index.php/user/login">Login</a>
                    <? else: ?>
                         <a href="/index.php/user/logout">Logout</a>
                    <? endif; ?>
                </div>
            </header><!-- #header-->

            <section id="middle">

                <?= $content ?>

            </section><!-- #middle-->



        </div><!-- #wrapper -->

    </body>
</html>