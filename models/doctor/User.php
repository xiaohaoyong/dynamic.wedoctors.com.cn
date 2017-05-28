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
 */
class User extends \yii\db\ActiveRecord
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
        return $this->hasOne(Userinfo::className(),['id'=>'userid']);
    }
}
