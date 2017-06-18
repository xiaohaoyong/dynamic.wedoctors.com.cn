<?php

namespace app\models\doctor;

use Yii;

/**
 * This is the model class for table "user_login".
 *
 * @property integer $userid
 * @property string $password
 * @property string $openid
 */
class UserLogin extends \yii\db\ActiveRecord
{
    public $_user=false;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_login';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbus');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'password'], 'required'],
            [['userid'], 'integer'],
            [['openid'],'string'],
            [['password'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userid' => 'Userid',
            'password' => '密码',
        ];
    }
    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->get_User()) {
            return Yii::$app->user->login($this->get_User(),3600*24*30);
        }
        return false;
    }

    public static function findByOpenid($openid)
    {
        $userLogin=self::findOne(['openid'=>$openid]);
        if($userLogin)
        {
            return User::findOne($userLogin->userid);
        }
    }

    public function getInfo()
    {
        return $this->hasOne(UserInfo::className(),['userid' => 'userid']);
    }
    public function getUser()
    {
        return $this->hasOne(User::className(), ['userid' => 'id']);
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function get_User()
    {
        if ($this->_user === false) {
            $user=self::findByOpenid($this->openid);
            $this->_user=$user;
        }
        return $this->_user;
    }

    public function validatePassword($password)
    {
        return $this->password==md5($password.'KzhRb99Tn37dPP4u');
    }
}
