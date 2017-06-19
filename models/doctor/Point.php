<?php

namespace app\models\doctor;

use Yii;

/**
 * This is the model class for table "point".
 *
 * @property integer $id
 * @property integer $point
 * @property integer $createtime
 * @property integer $userid
 * @property string $remarks
 * @property integer $source
 * @property integer $type
 */
class Point extends \yii\db\ActiveRecord
{
    public static $typeText=[1=>'增',2=>'减'];
    public static $sourceText=[
        1=>'拉手医生签到',
        2=>'公开课签到积分',
        3=>'病例研讨签到积分',
        4=>'参与互动',
        5=>'其他',
        6=>'兑换积分'
    ];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'point';
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
            [['point', 'createtime', 'userid', 'source', 'type'], 'integer'],
            [['remarks'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'point' => 'Point',
            'createtime' => 'Createtime',
            'userid' => 'Userid',
            'remarks' => 'Remarks',
            'source' => 'Source',
            'type' => 'Type',
        ];
    }
}
