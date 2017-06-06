<?php
/**
 * Created by PhpStorm.
 * User: wangzhen
 * Date: 2017/6/6
 * Time: 下午4:29
 */

namespace app\models;


use app\components\send\Sms;
use yii\base\Model;

class Code extends Model
{
    public $code;
    public $phone;
    public function rules()
    {
        return [
            ['code','trim'],
            ['code','required','message' => '请输入动态码'],
            ['code','validateCode'],
        ];
    }

    //验证手机验证码
    public function validateCode($attribute, $params)
    {
        $sms=new Sms($this->phone);
        if(!$sms->validate($this->code)) {
            $this->addError($attribute,'验证码错误！');
        }
    }

}