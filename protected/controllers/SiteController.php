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
            $m = new $mn;
            echo $mn . '<BR>';
            echo json_encode(array('error' => 0, 'content' => $m->attributes));
            echo '<br />';
        }
    }

    function actionInstall()
    {
        exit();
        $auth = Yii::app()->authManager;
        $auth->clearAll();

        $role_su = $auth->createRole('superuser');
        $su = new User;
        $su->login = 'superuser';
        $su->password = 'password';
        $su->save();
var_dump($su->errors);
        $auth->assign('superuser', $su->user_id);

        $role_admin = $auth->createRole('admin');
        $admin = new User;
        $admin->login = 'admin';
        $admin->password = 'password';
        $admin->save();
        var_dump($admin->errors);
        $auth->assign('admin', $admin->user_id);

        //сохраняем роли и операции
        $auth->save();
    }

    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        if (!Yii::app()->user->isGuest)
        {
            $role = Yii::app()->user->role;
            if ($role)
            {
                $this->redirect(Yii::app()->params['modules_default_pages'][$role]);
            }
        }

        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm']))
        {
            $model->attributes = $_POST['LoginForm'];

            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }

        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

}

