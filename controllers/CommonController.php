<?php
/**
 * Created by PhpStorm.
 * User: wangzhen
 * Date: 2016/12/13
 * Time: 15:37
 */

namespace app\controllers;


use app\components\helper\WeUrl;
use app\models\doctor\UserLogin;
use app\models\LoginWechat;
use app\models\wechat\WeChatOAuth;
use yii\base\InvalidRouteException;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\HttpException;

class CommonController extends Controller
{
    public function beforeAction($action)
    {
        $beforeAction = parent::beforeAction($action);
        if (!\Yii::$app->user->isGuest) {

            $openid = \Yii::$app->user->identity->login->openid;
            define('OPENID', $openid);
        }else {
            $cookies = \Yii::$app->request->cookies;//注意此处是request
            if (isset($_GET['state']) && isset($_GET['code'])) {
                $info = WeChatOAuth::getAccessTokenAndOpenId($_GET['code']);
                if ($info['openid']) {
                    $openid = $info['openid'];
                    define('OPENID', $openid);
                    $cookies = \Yii::$app->response->cookies;//注意此处是request
                    $cookies->add(new \yii\web\Cookie([
                        'name' => 'openid',
                        'value' => $openid,
                        'expire'=>time()+3600*24,
                    ]));
                }
            }elseif($cookies->has('openid')){
                $openid=$cookies->get('openid');
                define('OPENID', $openid);
            }else{
                throw new HttpException('101','非法访问');
            }
        }


        $model = new UserLogin();

        $jump=[
            'login',
            'validate-form',
            'validate-phone',
            'send-code',
            'register',
        ];
        if (($model->load(['UserLogin'=>['openid'=>OPENID]]) && $model->login()) || in_array(\Yii::$app->controller->action->id,$jump)) {
            return $beforeAction;
        }else{
            return \YII::$app->getResponse()->redirect(['/user/login']);
        }
    }
}