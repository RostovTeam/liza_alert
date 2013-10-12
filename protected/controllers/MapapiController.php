<?php

class MapapiController extends ApiController
{

    public function accessRules()
    {
        return array_merge(
                array(array('allow',
                'actions' => array('view', 'create'),
                'users' => array('*'),
            )
                ), parent::accessRules()
        );
    }

    public function actionView($id)
    {

        $lost = Lost::model()->findByPk($id);

        if (!$lost)
        {
            $this->_sendResponse(404, array('error' => "Couldn't find model."));
        }


        $params = array('lost_id' => $id);

        $ballons = Balloon::model()->findAllByAttributes($params);
        $radars = Radius::model()->findAllByAttributes($params);
        $areas = Area::model()->findAllByAttributes($params);

        $data = array(
            'ballons' => array_map(function($v)
                    {
                        return $v->attributes;
                    }, $ballons),
            'radars' => array_map(function($v)
                    {
                        return $v->attributes;
                    }, $radars),
            'areas' => array_map(function($v)
                    {
                        return $v->attributes;
                    }, $areas),
            'lost' => $lost->attributes + array('city' => $lost->city->attributes) +
            array('coordinator' => $lost->coordinator->attributes)
        );

        $this->_sendResponse(200, array('error' => 0, 'content' => $data));
    }

    public function actionCreate()
    {

        if (!isset($_REQUEST['Balloon']) && !isset($_REQUEST['Radar']) && !isset($_REQUEST['Area']))
        {
            $this->_sendResponse(400, array('error' => 'Nothing to save'));
        }

        $modelnames = array('Balloon' => 'Balloon', 'Radar' => 'Radius', 'Area' => 'Area');

        $content = array();

        foreach ($modelnames as $postindex => $modelname)
        {
            if (isset($_REQUEST[$postindex]) && is_array($_REQUEST[$postindex]) 
                    && intval($_REQUEST[$postindex][0]['lost_id']))
            {
                $modelname::model()->deleteAllByAttributes(array('lost_id' => $_REQUEST[$postindex][0]['lost_id']));
                foreach ($_REQUEST[$postindex] as $key => $data)
                {
                    $model = new $modelname;
                    $model->attributes = $data;

                    if (!$model->save())
                    {
                        $content['validation_erros'][$postindex][$key] = $model->errors;
                    }
                }
            }
        }

        if (isset($content['validation_erros']))
        {
            $this->_sendResponse(500, array('error' => 'validation_errors', array('content' => $content)));
        } else
        {
            $this->_sendResponse(200, array('error' => 0, array('content' => $content)));
        }
    }

}