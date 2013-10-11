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

}
