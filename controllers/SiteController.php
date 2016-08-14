<?php

namespace app\controllers;


use Yii;
use yii\base\Exception;
use yii\base\UserException;
use yii\rest\Controller;
use yii\web\ErrorAction;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;

class SiteController extends Controller
{

    public function actionIndex()
    {
        throw new NotFoundHttpException();
    }


}
