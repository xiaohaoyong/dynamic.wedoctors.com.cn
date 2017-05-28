<?php

namespace app\models\doctor;

use Yii;

/**
 * This is the model class for table "user_info".
 *
 * @property integer $userid
 * @property string $name
 * @property integer $sex
 * @property integer $age
 * @property integer $birthday
 * @property string $phone
 * @property integer $hospitalid
 * @property integer $subject_b
 * @property integer $subject_s
 * @property integer $title
 * @property string $intro
 * @property string $avatar
 * @property string $skilful
 * @property string $idnum
 * @property integer $province
 * @property integer $county
 * @property integer $city
 * @property integer $atitle
 * @property integer $otype
 * @property string $authimg
 */
class UserInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_info';
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
            [['userid', 'idnum'], 'required'],
            [['userid', 'sex', 'age', 'birthday', 'phone', 'hospitalid', 'subject_b', 'subject_s', 'title', 'province', 'county', 'city', 'atitle', 'otype'], 'integer'],
            [['name'], 'string', 'max' => 15],
            [['intro', 'avatar', 'skilful'], 'string', 'max' => 150],
            [['idnum'], 'string', 'max' => 18],
            [['authimg'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userid' => 'Userid',
            'name' => 'Name',
            'sex' => 'Sex',
            'age' => 'Age',
            'birthday' => 'Birthday',
            'phone' => 'Phone',
            'hospitalid' => 'Hospitalid',
            'subject_b' => 'Subject B',
            'subject_s' => 'Subject S',
            'title' => 'Title',
            'intro' => 'Intro',
            'avatar' => 'Avatar',
            'skilful' => 'Skilful',
            'idnum' => 'Idnum',
            'province' => 'Province',
            'county' => 'County',
            'city' => 'City',
            'atitle' => 'Atitle',
            'otype' => 'Otype',
            'authimg' => 'Authimg',
        ];
    }
}
