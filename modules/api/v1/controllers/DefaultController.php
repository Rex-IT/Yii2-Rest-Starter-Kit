<?php

namespace app\modules\api\v1\controllers;
use app\modules\api\v1\components\RestController;
use yii\rest\Controller;


/**
 * Default controller for the `v1` module
 */
class DefaultController extends RestController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['except'] = ['index'];
        return $behaviors;
    }
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return [
            'message'=>'v1'
        ];
    }
}
