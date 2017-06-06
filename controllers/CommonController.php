<?php
/**
 * Created by PhpStorm.
 * User: wangzhen
 * Date: 2016/12/13
 * Time: 15:37
 */

namespace app\controllers;


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
            $openid = \Yii::$app->user->identity->openid;
            define('OPENID', $openid);
        }else {
            if (isset($_GET['state']) && isset($_GET['code'])) {
                $info = WeChatOAuth::getAccessTokenAndOpenId($_GET['code']);
                if ($info['openid']) {
                    $openid = $info['openid'];
                    define('OPENID', $openid);
                }
            }elseif(\Yii::$app->request->get('openid',0)){
                $openid = \Yii::$app->request->get('openid',0);
                define('OPENID', $openid);
            }else{
                throw new HttpException('101','非法访问');
            }
        }
        $model = new UserLogin();


       if (($model->load(['openid'=>OPENID],'UserLogin') && $model->login()) || \Yii::$app->controller->action->id=='register') {
            return $beforeAction;
        }else{
            return \YII::$app->getResponse()->redirect(\WeUrl::to(['/user/register']));
        }
    }
}