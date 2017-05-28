<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/3
 * Time: 0:37
 */

namespace app\models\wxpay;


use yii\base\Object;

class WxOrder
{
    public static $appid;
    public static $attach;
    public static $bank_type;
    public static $cash_fee;
    public static $fee_type;
    public static $is_subscribe;
    public static $mch_id;
    public static $nonce_str;
    public static $openid;
    public static $out_trade_no;
    public static $result_code;
    public static $return_code;
    public static $sign;
    public static $time_end;
    public static $total_fee;
    public static $trade_type;
    public static $transaction_id;

    public static function set(array $config = [])
    {
        foreach($config as $k=>$v)
        {
            self::$$k=$v;
        }
    }
    public static function get()
    {
        $return['appid']=self::$appid;
        $return['attach']=self::$attach;
        $return['bank_type']=self::$bank_type;
        $return['cash_fee']=self::$cash_fee;
        $return['fee_type']=self::$fee_type;
        $return['is_subscribe']=self::$is_subscribe;
        $return['mch_id']=self::$mch_id;
        $return['nonce_str']=self::$nonce_str;
        $return['openid']=self::$openid;
        $return['out_trade_no']=self::$out_trade_no;
        $return['result_code']=self::$result_code;
        $return['return_code']=self::$return_code;
        $return['sign']=self::$sign;
        $return['time_end']=self::$time_end;
        $return['total_fee']=self::$total_fee;
        $return['trade_type']=self::$trade_type;
        $return['transaction_id']=self::$transaction_id;
        return $return;
    }
}