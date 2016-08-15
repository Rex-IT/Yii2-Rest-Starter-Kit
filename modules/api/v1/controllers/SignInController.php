<?php
/**
 * Created by Rex IT.
 * rexit.web@gmail.com
 */

namespace app\modules\api\v1\controllers;


use app\models\Login;
use app\models\SignUp;
use app\modules\api\v1\components\RestController;
use yii\rest\CreateAction;

class SignInController extends RestController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['except'] = ['login','sign-up'];
        return $behaviors;
    }


    public function actionLogin()
    {
        $model = new Login();
        if (($load = $model->load(\Yii::$app->request->post(),'')) && $model->validateLogin()) {
            return $model->answer();
        }
        if (!$load) {
            $model->validate();
        }
        \Yii::$app->response->setStatusCode(422, 'Data Validation Failed.');
        $result = [];
        foreach ($model->getFirstErrors() as $name => $message) {
            $result[] = [
                'field' => $name,
                'message' => $message,
            ];
        }
        return $result;
    }


    public function actionSignUp()
    {
        $model = new SignUp();
        if (($load = $model->load(\Yii::$app->request->post(),'')) && ($user = $model->signup())) {
            return [
                'username'=>$user->username,
                'access_token'=>$user->access_token
            ];
        }
        if (!$load) {
            $model->validate();
        }
        \Yii::$app->response->setStatusCode(422, 'Data Validation Failed.');
        $result = [];
        foreach ($model->getFirstErrors() as $name => $message) {
            $result[] = [
                'field' => $name,
                'message' => $message,
            ];
        }
        return $result;
    }
}