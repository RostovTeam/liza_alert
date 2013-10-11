<?php

class BalloonapiController extends ApiController
{

    protected $model = 'Balloon';

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