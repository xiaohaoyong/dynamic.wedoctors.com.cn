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
use app\models\doctor\PhoneLoginFrom;
use app\models\doctor\User;
use app\models\doctor\UserInfo;
use app\models\doctor\UserLogin;
use app\models\wechat\UserManage;

class UserController extends CommonController
{
    public function actionIndex()
    {
        if(!\Yii::$app->user->identity->info->avatar)
        {
            $user=UserManage::getUserInfo(OPENID);
            if($user['headimgurl']) {
                $baseName = substr(md5($user['headimgurl']), 8, 16);
                $img = $baseName . '.jpg';

                $ch = curl_init($user['headimgurl']);
                $fp = fopen(__ROOT__."/../".\Yii::$app->params['imageDir']."/upload/" . $img, 'wb');
                curl_setopt($ch, CURLOPT_FILE, $fp);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_exec($ch);
                curl_close($ch);
                fclose($fp);
                $info=\Yii::$app->user->identity->info;
                $info->avatar=\Yii::$app->params['imageUrl'].$img;
                $info->save();

            }
        }
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
        return $this->renderPartial('register', [
            'login' =>$login,
            'info' => $info,
            'code' => $code,
        ]);
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new PhoneLoginFrom();
        if(\Yii::$app->request->isPost) {
            if ($model->load(\Yii::$app->request->post()) && $model->login()) {
                $user=\Yii::$app->user->identity;
                $login=$user->login;
                $login->openid=OPENID;
                $login->save();

                return $this->goBack();
            } else {
                $model->firstErrors;
                \Yii::$app->getSession()->setFlash('error', '用户名或密码错误！');
            }
        }
        return $this->renderPartial('login',[
            'model'=>$model,
        ]);
    }
    public function actionValidateLogin()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model=new PhoneLoginFrom();
        $model->load(\Yii::$app->request->post());
        $phonevalidate = \yii\widgets\ActiveForm::validate($model);
        if($phonevalidate) {
            return $phonevalidate;
        }

        return $phonevalidate;
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