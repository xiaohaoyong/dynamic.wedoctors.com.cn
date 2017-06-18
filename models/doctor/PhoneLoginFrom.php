<?php
/**
 * Created by PhpStorm.
 * User: wangzhen
 * Date: 2017/6/18
 * Time: 上午9:52
 */

namespace app\models\doctor;


use yii\base\Model;

class PhoneLoginFrom extends Model
{
    public $phone;
    public $password;
    public $_user;
    public function rules()
    {
        return [
            [['phone','password'],'required'],
            ['phone','match','pattern'=>'/^1[3|4|5|6|7|8|][0-9]{9,9}$/','message'=>'请输入正确{attribute}'],
            ['password','validatePassword'],
        ];

    }
    public function validatePassword($attribute,$params)
    {
        if(!$this->hasErrors()){
            $user=$this->getUser();
            if(!$user || $user->login->validatePassword($this->password)){
                $this->addError($attribute,'用户名或密码错误！');
            }
        }

    }

    public function login()
    {
        if($this->validate())
        {
            return \Yii::$app->user->login($this->getUser(),3600*24);
        }else{
            return false;
        }

    }

    public function getUser()
    {
        if(!$this->_user)
        {
            $this->_user=User::findPhoneRow($this->phone);
        }

        return $this->_user;
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'phone'=>'手机号',
            'password'=>'密码'
        ];
    }
}