<?php

class MapapiController extends ApiController
{

    public function accessRules()
    {
        return array_merge(
                array(
            array('allow',
                'actions' => array('view'),
                'users' => array('*')
            ),
            array('allow',
                'actions' => array('create'),
                'roles' => array('superuser', 'admin')
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
            'lost' => LostapiController::generateContent($lost)
        );

        $this->_sendResponse(200, array('error' => 0, 'content' => $data));
    }

    public function actionCreate()
    {
        if (!isset($_POST['lost_id']))
        {
            $this->_sendResponse(400, array('error' => 'No lost_id'));
        }

        $lost = Lost::model()->findByPk($_POST['lost_id']);

        if (!$lost)
        {
            $this->_sendResponse(400, array('error' => 'Lost not found'));
        }

        if (isset($_POST['map_lat']) && isset($_POST['map_lng']))
        {
            $lost->map_lat = $_POST['map_lat'];
            $lost->map_lng = $_POST['map_lng'];
        }

        if (isset($_POST['map_zoom']))
        {
            $lost->map_zoom = $_POST['map_zoom'];
        }

        $lost->save();

        if (!isset($_REQUEST['Balloon']) && !isset($_REQUEST['Radar']) && !isset($_REQUEST['Area']))
        {
            $this->_sendResponse(400, array('error' => 'Nothing to save'));
        }


        $modelnames = array('Balloon' => 'Balloon', 'Radar' => 'Radius', 'Area' => 'Area');

        $content = array();

        foreach ($modelnames as $postindex => $modelname)
        {
            if (isset($_REQUEST[$postindex]))
            {
                $modelname::model()->deleteAllByAttributes(array('lost_id' => $_POST['lost_id']));
            }

            if (is_array($_REQUEST[$postindex])) //&& intval($_REQUEST[$postindex][0]['lost_id']))
            {
                foreach ($_REQUEST[$postindex] as $key => $data)
                {
                    $model = new $modelname;
                    $model->attributes = $data;
                    $model->lost_id = $_POST['lost_id'];

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