<?php

namespace app\models\doctor;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property integer $level
 * @property integer $type
 * @property integer $createtime
 * @property integer $state
 * @property integer $source
 */
class User extends \yii\db\ActiveRecord  implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
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
            [['level', 'type', 'createtime', 'state'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'level' => 'Level',
            'type' => 'Type',
            'createtime' => 'Createtime',
            'state' => 'State',
        ];
    }
    public function getInfo()
    {
        return $this->hasOne(UserInfo::className(),['id' => 'userid']);
    }
    public function getLogin()
    {
        return $this->hasOne(UserLogin::className(),['userid'=>'id']);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
        //return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
        /*foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;*/
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|integer an ID that uniquely identifies a user identity.
     */
    public function getId(){
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }
}
