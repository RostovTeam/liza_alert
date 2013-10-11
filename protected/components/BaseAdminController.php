<?php

/**
 * Description of AdminController
 *
 * @author Roman
 */
class BaseAdminController extends CController
{

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column3';
    public $main_menu = array(
        array('label' => '<i class="icon-briefcase"></i>News', 'url' => array('/admin/news/index')),
        array('label' => '<i class="icon-briefcase"></i>Statistics', 'url' => array('/admin/stats/index')),
        array('label' => '<i class="icon-user"></i>Games', 'url' => array('/admin/game/index')),
        array('label' => '<i class="icon-user"></i>Genres', 'url' => array('/admin/genre/index')),
        array('label' => '<i class="icon-user"></i>Developers', 'url' => array('/admin/developer/index')),
        array('label' => '<i class="icon-user"></i>Users', 'url' => array('/user/admin')),
    );
    public $menu = array();
    public $breadcrumbs = array();

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'roles' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

}

