<?php


class RadarapiController extends ApiController
{
     protected $model = 'Radius';

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