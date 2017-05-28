<?php
/**
 * Created by PhpStorm.
 * User: wangzhen
 * Date: 2016/12/19
 * Time: 17:09
 */

namespace app\commands\helper;


use yii\base\Object;

class RandChar extends Object
{
    static function getRandChar($length){
        $str = null;
        $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
        $max = strlen($strPol)-1;

        for($i=0;$i<$length;$i++){
            $str.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
        }
        return $str;
    }
}