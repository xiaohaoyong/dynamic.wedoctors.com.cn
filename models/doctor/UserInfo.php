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
            [['userid', 'idnum','phone'], 'required'],
            [['phone'], 'unique','targetClass' => 'app\models\doctor\UserInfo','message'=>'{attribute}已经被占用了'],
            ['phone','match','pattern'=>'/^1[3|4|5|6|7|8|][0-9]{9,9}$/','message'=>'请输入正确{attribute}'],

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
            'userid' => '用户ID',
            'name' => '姓名',
            'sex' => '性别',
            'age' => '年龄',
            'birthday' => '十个八个如',
            'phone' => '手机号码',
            'hospitalid' => '所以在医院',
            'subject_b' => '一级科室',
            'subject_s' => '二级科室',
            'title' => '职称',
            'intro' => '简介',
            'avatar' => '头像',
            'skilful' => '擅长',
            'idnum' => '身份证号码',
            'province' => '省',
            'county' => '县',
            'city' => '市',
            'atitle' => '行政职称',
            'otype' => '职业类型',
            'authimg' => '证件照',
        ];
    }
}
