<?php
/**
 * Created by PhpStorm.
 * User: wangzhen
 * Date: 2017/1/6
 * Time: 13:37
 */

namespace app\models\wechat;

use yii\base\Object;

class WxJsSdk extends Object{
    private $appId;
    private $appSecret;

    public function __construct($appId, $appSecret) {
        $this->appId = $appId;
        $this->appSecret = $appSecret;
    }

    public function getSignPackage() {
        $jsapiTicket = $this->getJsApiTicket();
        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $timestamp = time();
        $nonceStr = $this->createNonceStr();

        // 这里参数的顺序要按照 key 值 ASCII 码升序排序
        $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";
        $signature = sha1($string);

        $signPackage = array(
            "appId"     => $this->appId,
            "nonceStr"  => $nonceStr,
            "timestamp" => $timestamp,
            "signature" => $signature,
            "jsApiList" =>[
                'uploadImage','chooseImage','getNetworkType','openLocation','getLocation'
            ],
        );
        return json_encode($signPackage);
    }

    private function createNonceStr($length = 16) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

    private function getJsApiTicket() {
        // jsapi_ticket 应该全局存储与更新，以下代码以写入到文件中做示例
        $data = json_decode(file_get_contents(ACRDIR.'config/jsapi_ticket.json'),true);
        if(!$data || (time() - $data['time'] > $data['expires_in']-10)){
            $accessToken = AccessToken::getAccessToken();
            $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
            $res = Curl::callWebServer($url, '', 'GET');
            $ticket = $res['ticket'];
            if ($ticket) {
                $res['time']=time();
                file_put_contents(ACRDIR.'config/jsapi_ticket.json',json_encode($res));
            }
        } else {
            $ticket = $data['ticket'];
        }

        return $ticket;
    }

}