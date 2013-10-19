<?php

class CityapiController extends ApiController
{

    protected $model = 'City';

    public function accessRules()
    {
        return array_merge(
                array(array('allow',
                    'actions'=>array('list','view'),
                'users' => array('*'),
            )
                ), parent::accessRules()
        );
    }
}