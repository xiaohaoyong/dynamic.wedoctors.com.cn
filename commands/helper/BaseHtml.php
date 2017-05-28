<?php
namespace app\commands\helper;
/**
 * Created by PhpStorm.
 * User: wangzhen
 * Date: 2016/12/15
 * Time: 8:59
 */
class BaseHtml extends \yii\helpers\BaseHtml
{


    public static function activeDateInput($model, $attribute, $options = [])
    {
        return static::activeInput('date', $model, $attribute, $options);
    }
}