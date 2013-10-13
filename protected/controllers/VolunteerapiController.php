<?php

class VolunteerapiController extends ApiController
{
    
    public $model='Volunteer';

    public function accessRules()
    {
        return array_merge(
                array(array('allow',
                'actions' => array('create'),
                'users' => array('*'),
            )
                ), parent::accessRules()
        );
    }

    public function actionCreate()
    {
        if (isset($_POST['Volunteer']))
        {
            $model->attributes = $_POST['Volunteer'];

            if ($model->save())
            {
                $this->_sendResponse(200, array('error' => 0, 'content' => $model->attributes));
            } else
            {
                $this->_sendResponse(500, array('error' => 'validation_errors', 'errors_list' => $model->errors));
            }
        } else
        {
            $this->_sendResponse(400, array('error' => 'POST array should contain model name as key'));
        }
    }

}