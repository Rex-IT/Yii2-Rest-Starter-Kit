<?php

namespace app\modules\api;
use Yii;
use yii\filters\ContentNegotiator;
use yii\web\Response;

/**
 * api module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\api\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        Yii::$app->user->enableSession = false;
        //Делаем все ответы от сервера в виде json.
        $handler = new ApiErrorHandler;
        Yii::$app->set('errorHandler', $handler);
        //необходимо вызывать register, это обязательный метод для регистрации обработчика
        $handler->register();
        $net = new ContentNegotiator([
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
                'application/xml' => Response::FORMAT_XML,
            ],
            'languages' => Yii::$app->params['availableLanguages'],
        ]);
        $net->negotiate();
    }
}
