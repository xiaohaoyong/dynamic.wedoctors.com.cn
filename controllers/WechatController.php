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
        return $wechat->checkSignature();

        return $wechat->run();
    }

    public function actionSetmenu()
    {
        $order_index = urlencode(Url::to('order/index',["t"=>time()]));
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . WECHAT_APPID . '&redirect_uri=' . $order_index . '&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
        $order_lists = urlencode(Url::to('order/lists',["t"=>time()]));
        $listsUrl = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . WECHAT_APPID . '&redirect_uri=' . $order_lists . '&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
        $userViews = urlencode(Url::to('user/register',["t"=>time(),"type"=>"edit"]));
        $userUrl = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . WECHAT_APPID . '&redirect_uri=' . $userViews . '&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';

        $insuranceViews = urlencode(Url::to('insurance/create',["t"=>time()]));
        $insuranceUrl = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . WECHAT_APPID . '&redirect_uri=' . $insuranceViews . '&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';

        $joinViews = urlencode(Url::to('insurance/join',["t"=>time()]));
        $joinUrl = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . WECHAT_APPID . '&redirect_uri=' . $joinViews . '&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';

        $contentViews = urlencode(Url::to('content/create',["t"=>time()]));
        $contentUrl = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . WECHAT_APPID . '&redirect_uri=' . $contentViews . '&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';

        $menuList = array(
            array('id' => '1', 'pid' => '0', 'name' => '约车/接单', 'type' => 'view', 'code' => $url),
            array('id' => '2', 'pid' => '0', 'name' => '我的订单', 'type' => 'view', 'code' => $listsUrl),
            array('id' => '3', 'pid' => '0', 'name' => '我的', 'type' => 'view', 'code' =>''),
            array('id' => '4', 'pid' => '3', 'name' => '我的信息', 'type' => 'view', 'code' =>$userUrl),
            array('id' => '5', 'pid' => '3', 'name' => '车险报价', 'type' => 'view', 'code' =>$insuranceUrl),
            array('id' => '6', 'pid' => '3', 'name' => '加盟申请', 'type' => 'view', 'code' =>$joinUrl),
            array('id' => '7', 'pid' => '3', 'name' => '投诉建议', 'type' => 'view', 'code' =>$contentUrl),


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