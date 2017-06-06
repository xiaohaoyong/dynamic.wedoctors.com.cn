<?php
namespace app\components\helper;
/**
 * Created by PhpStorm.
 * User: wangzhen
 * Date: 2017/6/6
 * Time: 上午9:42
 */
class WeUrl extends \yii\helpers\Url
{
    public static function to($url = '', $scheme = true)
    {
        $url=urlencode(parent::to($url,$scheme));
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . WECHAT_APPID . '&redirect_uri=' . $url . '&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
        return $url;
    }

}