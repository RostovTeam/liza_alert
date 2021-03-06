<?php

class VolunteerapiController extends ApiController
{

    public $model = 'Volunteer';

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

            $model = Volunteer::create($_POST['Volunteer']);

            if ($model->id)
            {
                if(isset($_POST['Volunteer']['lost_id']) && intval($_POST['Volunteer']['lost_id']))
                {
                    $losts=$model->lost;
                    
                    if(is_array($losts))
                    {
                        array_push($losts, $_POST['Volunteer']['lost_id']);
                    }
                    else
                    {
                        $losts=array($_POST['Volunteer']['lost_id']);
                    }
                     
                    $model->lost=$losts;
                    $model->save();
                }
                
                $this->_sendResponse(200, array('error' => 0, 'content' => $model->attributes));
            } 
            else
            {
                $this->_sendResponse(500, array('error' => 'validation_errors', 'errors_list' => $model->errors));
            }
        }
        else
        {
            $this->_sendResponse(400, array('error' => 'POST array should contain model name as key'));
        }
    }

}