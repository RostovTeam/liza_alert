<?php

class GPSapiController extends ApiController
{

    public function accessRules()
    {
        return array_merge(
                array(array('allow',
                'actions' => array('create', 'list'),
                'users' => array('*'),
            )
                ), parent::accessRules()
        );
    }

    public function actionList()
    {
        $redis = new Redis();
        $redis->pconnect('127.0.0.1', 6379);
        $data = $redis->get('gps');
        if ($data)
            $data = unserialize($data);
        else
            $data = array();

        $this->_sendResponse(200, array('error' => 0, 'content' => $data));
    }

    public function actionCreate()
    {
        if (!isset($_POST['GPS']) && !isset($_POST['GPS']['phone']))
        {
            $this->_sendResponse(400, array('error' => 'wrong_request', 'content' => array()));
        }

        $redis = new Redis();

        $redis->pconnect('127.0.0.1', 6379);
        $data = $redis->get("gps");
        $recieved = $_POST['GPS'];

        if (!$data)
            $data = array();
        else
            $data = unserialize($data);

        if (isset($data[$recieved['phone']]))
        {
            $data[$recieved['phone']] = array_merge($data[$recieved['phone']], $recieved);
        } else
        {
            $volunteer = Volunteer::model()->findByAttributes(array('phone' => $_POST['GPS']['phone']));
            if ($volunteer)
            {
                $name = $volunteer->name;
            } else
            {
                $name = '';
            }

            $recieved['name'] = $name;
            $data[$recieved['phone']] = $recieved;
        }

        if ($redis->set("gps", serialize($data), 50000))
            $this->_sendResponse(200, array('error' => 0, 'content' => array()));
        else
            $this->_sendResponse(500, array('error' => 'cant_save_data', 'content' => array()));
    }

}