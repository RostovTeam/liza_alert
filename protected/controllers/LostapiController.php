<?php

class LostapiController extends ApiController
{

    protected $model = 'Lost';

    public function accessRules()
    {
        return array_merge(
                array(array('allow',
                'users' => array('*'),
            )
                ), parent::accessRules()
        );
    }

    public function actionList($city_id = '')
    {

        $modelname = $this->model;

        $params = array();
        if (!empty($city_id))
            $params = array('city_id' => $city_id);

        $models = $modelname::model()->findAllByAttributes($params);

        if (is_null($models))
        {
            $this->_sendResponse(200, array('error' => 0, 'content' => array()));
        } else
        {
            //$_this=$this;
            $content = array_map(function($v)
                    {
                        return LostapiController::generateContent($v);
                    }, $models);

            $this->_sendResponse(200, array('error' => 0, 'content' => $content));
        }
    }

    public function actionView($id)
    {

        $modelname = $this->model;

        $model = $modelname::model()->findByPk($id);

        if (!$model)
        {
            $this->_sendResponse(404, array('error' => "Couldn't find model."));
        } else
        {
            $content = LostapiController::generateContent($model);

            $this->_sendResponse(200, array('error' => 0, 'content' => $content));
        }
    }

    public static function generateContent($model)
    {
        $content =
                $model->attributes +
                array('city' => $model->city->attributes) +
                array('coordinator' => $model->coordinator->attributes);

        if ($model->photo)
        {
            $content['photo']=array();
            $content['photo']['original'] = Yii::app()->params['url'] . Yii::app()->params['photosRelative'] .
                    $model->photo;
            $base_filename = explode('.', $model->photo)[0];
            $ext = explode('.', $model->photo)[1];

            foreach (Yii::app()->params['photo_sizes']as $size)
            {
                $content['photo'][$size[0] . 'x' . $size[1]] = Yii::app()->params['url'] .
                        Yii::app()->params['photosRelative'] .
                        $base_filename . '_' . $size[0] . 'x' . $size[1] . '.' . $ext;
            }
        }

        return $content;
    }

}