<?php

class MapapiController extends ApiController
{

    public function accessRules()
    {
        return array_merge(
                array(array('allow',
                'actions' => array('view'),
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
            'ballons' => array_map( function($v)
                    {
                        return $v->attributes;
                    },$ballons),
            'radars' => array_map( function($v)
                    {
                        return $v->attributes;
                    },$radars),
            'areas' => array_map( function($v)
                    {
                        return $v->attributes;
                    },$areas),
            'lost' => $lost->attributes+array('city'=>$lost->city->attributes)
                            +array('coordinator'=>$lost->coordinator->attributes)
        );

        $this->_sendResponse(200, array('error' => 0, 'content' => $data));
    }

}