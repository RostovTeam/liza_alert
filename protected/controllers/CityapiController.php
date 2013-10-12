<?php

class CityapiController extends ApiController
{

    protected $model = 'City';

    public function accessRules()
    {
        return array_merge(
                array(array('allow',
                'users' => array('*'),
            )
                ), parent::accessRules()
        );
    }
}