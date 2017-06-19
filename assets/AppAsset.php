<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'http://static.c.wedoctors.com.cn/css.css',
    ];
    public $js =[
        'http://static.j.wedoctors.com.cn/js/zepto.min.js',
        'http://static.j.wedoctors.com.cn/js/flexible.js',
        'http://static.j.wedoctors.com.cn/js/login_reg.js?t=2',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
