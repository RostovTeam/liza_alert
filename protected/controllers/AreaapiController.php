<?php

class AreaapiController extends ApiController
{

    protected $model = 'Area';

    public function accessRules()
    {
        return array_merge(
                array(array('allow',
                'users' => array('*'),
            )
                ), parent::accessRules()
        );
    }

    public function actionList($lost_id='')
    {

        $modelname = $this->model;
        
        $params=array();
        if(!empty($lost_id))
            $params=array('lost_id' => $lost_id);

        $models = $modelname::model()->findAllByAttributes($params);

        if (is_null($models))
        {
            $this->_sendResponse(200, array('error' => 0, 'content' => array()));
        } else
        {
            $rows = array();
            foreach ($models as $model)
                $rows[] = $model->attributes;

            $this->_sendResponse(200, array('error' => 0, 'content' => $rows));
        }
    }

}
