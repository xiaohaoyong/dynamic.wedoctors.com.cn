<?php
namespace app\controllers;
use app\models\Order;
use app\models\PayNotifyCallBack;
use app\models\wechat\Menu;
use app\models\wechat\Wechat;
use app\models\WxOrder;
use app\models\WxPayApi;
use app\models\WxPayNotify;
use yii\helpers\Url;
use yii\web\Controller;
/**
 * Created by PhpStorm.
 * User: wangzhen
 * Date: 2016/12/12
 * Time: 14:03
 */
class WechatController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {

        $wechat=new Wechat(WECHAT_TOKEN);
        //return $wechat->checkSignature();

        return $wechat->run();
    }

    public function actionSetmenu()
    {

        $user_index = urlencode(Url::to('user/index',["t"=>time()]));
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . WECHAT_APPID . '&redirect_uri=' . $user_index . '&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';

        $menuList = array(
            array('id' => '1', 'pid' => '0', 'name' => '拉手学院', 'type' => 'view', 'code' => 'http://www.wedoctors.com.cn/down/app.html'),
            array('id' => '2', 'pid' => '0', 'name' => '全科学院', 'type' => 'view', 'code' => 'http://www.wedoctors.com.cn/down/app.html'),
            array('id' => '3', 'pid' => '0', 'name' => '我的', 'type' => 'view', 'code' =>''),
            array('id' => '4', 'pid' => '3', 'name' => '下载APP', 'type' => 'view', 'code' =>'http://www.wedoctors.com.cn/down/app.html'),
            array('id' => '5', 'pid' => '3', 'name' => '个人中心', 'type' => 'view', 'code' =>$url),
        );
        print_r($menuList);
        $result = Menu::setMenu($menuList);
        var_dump($result);
    }

    public function actionNotify()
    {
        $notify = new PayNotifyCallBack();
        $notify->Handle(false);
    }
}