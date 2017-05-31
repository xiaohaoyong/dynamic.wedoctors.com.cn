<?php
/**
 * Created by PhpStorm.
 * User: wangzhen
 * Date: 2017/5/28
 * Time: 下午6:50
 */

namespace app\controllers;


use app\models\doctor\User;
use app\models\doctor\UserInfo;
use app\models\doctor\UserLogin;

class UserController extends CommonController
{
    public function actionIndex()
    {
        echo 111;
    }
    public function actionRegister()
    {
        $login = new UserLogin();
        $info   =   new UserInfo();
        if(\Yii::$app->request->isPost)
        {
            var_dump($_POST);exit;
        }
        return $this->render('register', [
            'login' =>$login,
            'info' => $info,
        ]);
    }

}