<?php

/**
 * Created by JetBrains PhpStorm.
 * User: kostyukdg
 * Date: 12.10.13
 * Time: 21:28
 * To change this template use File | Settings | File Templates.
 */
return array(
    'photosDir' => dirname(__FILE__) . '/../../static/photos/',
    'photosRelative' => '/static/photos/',
    'flyerDir' => dirname(__FILE__).'/../../static/flyer/',
    'flyerRelative' => '/static/flyer/',
    'url' => 'http://146.185.145.71',
    'photo_sizes' => array(
        array(75, 75),
        array(300, 300),
    ),
    'lost_status' => array(
         'не требуется ничего',
         'требуется информационная поддржка(шаринг)',
         'выезд на местность',
         'Найдено'
    ),
);