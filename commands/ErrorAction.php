<?php
/**
 * Created by PhpStorm.
 * User: wangzhen
 * Date: 2016/12/13
 * Time: 17:22
 */

namespace app\commands;


use yii\web\HttpException;

class ErrorAction extends \yii\web\ErrorAction
{
    public function run()
    {

        $exception = \Yii::$app->getErrorHandler()->exception;
        if($exception instanceof HttpException){
            if($exception->statusCode ==101){
                $exception->statusCode=200;
                return $this->controller->render('/common/error',['message'=>$exception->getMessage()]);
            }
        }
        return parent::run();
    }
}