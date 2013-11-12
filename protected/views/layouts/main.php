<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Лиза алерт</title>
        <!-- Bootstrap -->
        <link href="/static/css/bootstrap.min.css" rel="stylesheet">
        <link href="/static/css/style.css" rel="stylesheet">
    </head>
    <body >

        <?= $content; ?>

        <? Yii::app()->clientScript->registerCoreScript('jquery');?>
        <script type="text/javascript" src="/static/js/vendor/bootstrap.min.js"></script>

    </body>
</html>
