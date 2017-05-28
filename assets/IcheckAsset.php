<?php
/**
 * Created by PhpStorm.
 * User: wangzhen
 * Date: 2017/2/6
 * Time: 16:15
 */

namespace app\assets;
use yii\web\AssetBundle;

class IcheckAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'js/icheck/skins/all.css',
    ];
    public $js = [
        'js/icheck/icheck.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}