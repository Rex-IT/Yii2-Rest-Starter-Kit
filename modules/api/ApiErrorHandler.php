<?php
namespace app\modules\api;
use Yii;
use yii\filters\ContentNegotiator;
use yii\helpers\Json;
use yii\web\ErrorHandler;
use yii\web\Response;

/**
 * Created by Rex IT.
 * rexit.web@gmail.com
 */
class ApiErrorHandler extends ErrorHandler
{
    /**
     * @param \Exception $exception
     */

    protected function renderException($exception)
    {
        if (Yii::$app->has('response')) {
            $response = Yii::$app->getResponse();
        } else {
            $response = new Response();
        }

        $response->data = $this->convertExceptionToArray($exception);
        $response->setStatusCode($this->getCode($exception));
        $response->send();
    }

    /**
     * @param \Exception $exception
     * @return array
     */
    protected function convertExceptionToArray($exception)
    {

        return [
            'code'=>$this->getCode($exception),
            'message'=>$exception->getMessage()
        ];
    }

    private function getCode($exception)
    {
        if (empty($exception->statusCode)) {
            $code = 500;
        } else {
            $code = $exception->statusCode;
        }
        return $code;
    }
}