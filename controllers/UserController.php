<?php
/**
 * Created by PhpStorm.
 * User: wangzhen
 * Date: 2017/5/28
 * Time: 下午6:50
 */

namespace app\controllers;


use app\components\helper\WeUrl;
use app\components\send\Sms;
use app\models\Code;
use app\models\doctor\User;
use app\models\doctor\UserInfo;
use app\models\doctor\UserLogin;

class UserController extends CommonController
{
    public function actionIndex()
    {
        return $this->render('index', [
        ]);
    }
    public function actionRegister()
    {
        $login = new UserLogin();
        $info   =   new UserInfo();
        $code = new Code();
        if(\Yii::$app->request->isPost) {
            $post = \Yii::$app->request->post();
            $login->load($post);
            $info->load($post);
            $code->load($post);
            $code->phone = $info->phone;
            if ($code->validate())
            {
                $user=new User();
                $user->type=0;
                $user->level=0;
                $user->source=1;
                $user->createtime=time();
                if($user->save())
                {
                    $info->userid=$user->id;
                    $info->save();

                    $login->userid=$user->id;
                    $login->password=md5($login->password.WEDOCTORS_KEY);
                    $login->save();
                    return $this->redirect(WeUrl::to('user/index'));
                }
            }else{
                return $code->errors;

            }
        }
        return $this->render('register', [
            'login' =>$login,
            'info' => $info,
            'code' => $code,
        ]);
    }
    public function actionValidateForm()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new UserInfo();
        $model->load(\Yii::$app->request->post());
        $phonevalidate = \yii\widgets\ActiveForm::validate($model);
        if($phonevalidate) {
            return $phonevalidate;
        }

        $code = new Code();
        $code->load(\Yii::$app->request->post());
        $code->phone=$model->phone;
        $phonevalidate = \yii\widgets\ActiveForm::validate($code);
        return $phonevalidate;
    }

    public function actionValidatePhone()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new UserInfo();
        $model->load(['UserInfo'=>\Yii::$app->request->post()]);
        return \yii\widgets\ActiveForm::validate($model);
    }
    public function actionSendCode()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $phone=\Yii::$app->request->post('phone',0);
        if($phone)
        {
            $code=rand(100000,999999);

            $sms = new Sms($phone);
            $retVal = $sms->send('SMS_63950776',$code,$phone);
            $data['smsCode']=$code;
            if($retVal)
            {
                return ['status'=>1,'msg'=>'成功'];
            }else{
                return ['status'=>-1,'msg'=>'失败'];
            }
        }
        return ['status'=>-1,'msg'=>'手机号不能为空'];
    }
}