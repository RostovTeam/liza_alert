<?php

/**
 * Description of SiteController
 *
 * @author Roman
 */
class SiteController extends Controller
{

    function actionIndex($id)
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: POST, GET");
        header("Access-Control-Allow-Headers: x-requested-with");
        if (Lost::model()->findByPk($id))
            $this->render('index', array('id' => $id));
        else
            $this->render('index', array('id' => null));
    }

    function actionTest()
    {
        $models = array('Area', 'Balloon', 'City', 'Lost', 'Radius', 'Volunteer');
        
        foreach ($models as $mn)
        {
            $m=new $mn;
            echo $mn.'<BR>';
            echo json_encode(array('error'=>0,'content'=>$m->attributes));
            echo '<br />';
        }
    }

    function actionInstall()
    {
        //exit();
        $auth = Yii::app()->authManager;
        //$auth->clearAll();
//
//        $role_admin = $auth->createRole('admin');
//        $admin = new User;
//        $admin->username = 'admin1';
//        $admin->password = 'password';
//        $admin->email = "admin1@gamesite.ru";
//        $admin->save();
//
//        $auth->assign('admin', $admin->id);
//
//        $role_member = $auth->createRole('member');
        $member = new User;
        $member->username = 'member';
        $member->password = 'password';
        $member->email = "member@gamesite.ru";
        $member->save();
        var_dump($member->errors);
        $auth->assign('member', $member->id);

        //$role_user = $auth->createRole('user');
        //сохраняем роли и операции
        $auth->save();
    }

}

