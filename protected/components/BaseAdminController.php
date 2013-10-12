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

    public function getMain_menu()
    {
        $menu = array(
            array('label' => 'Города', 'url' => array('/admin/city/index')),
            array('label' => 'Координаторы', 'url' => array('/admin/coordinator/index')),
            array('label' => 'Экипажи', 'url' => array('/admin/crew/index')),
            array('label' => 'Потеряшки', 'url' => array('/admin/lost/index')),
            array('label' => 'Волонтеры', 'url' => array('/admin/volunteer/index')),
        );
        
        if (Yii::app()->user->checkAccess('superuser') == true ? : array())
        {
            $menu[]=array('label' => 'Пользователи', 'url' => array('/admin/user/index'));
        }
        
        return $menu;
    }

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
            array('allow',
                'roles' => array('admin', 'superuser'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

}

