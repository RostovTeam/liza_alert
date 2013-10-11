<?php

/**
 * Description of SiteController
 *
 * @author Roman
 */
class SiteController extends Controller
{

    public $defaultAction = 'News';

    function actionIndex()
    {
        
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

    function actionNews($type = 0, $tag = '', $game = '', $developer = '', $search = '')
    {
        $crit = new CDbCriteria();


        if ($type != -1)
            $crit->compare('type', $type);

        $crit->with = array();
        
        
        if ($search)
        {
            $crit->compare('title', $search, true);
            $crit->compare('content', $search, true, 'OR');
        }

        if ($tag)
        {
           $crit->addCondition('id in(select news_id from news_tag nt join tag tg on nt.tag_id=tg.id where tg.name=:tname )');
           $crit->params+=array(':tname'=>$tag);
        }

        if ($game)
        {
            array_push($crit->with, '_game');
            $crit->compare('_game.name', $game);
        }

        if ($developer)
        {
            array_push($crit->with, '_developer');
            $crit->compare('_developer.name', $developer);
        }
        
        //var_dump($crit);
        $crit->order = 'date_created DESC';
        $crit->limit = 50;

        $models = News::model()->findAll($crit);

        $this->render('news_list', array('models' => $models));
    }

    function actionNewsDetail($id)
    {
        $model = News::model()->findByPk($id);

        $this->render('news_detail', array('model' => $model));
    }

    function actionGames()
    {
        $model = new Game('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Game']))
            $model->attributes = $_GET['Game'];

        $this->render('games_list', array(
            'model' => $model,
        ));
    }

    function actionCompanies()
    {
        
    }

}

