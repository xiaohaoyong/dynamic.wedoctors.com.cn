<?php

namespace app\models\doctor;

use Yii;

/**
 * This is the model class for table "account".
 *
 * @property integer $id
 * @property integer $userid
 * @property integer $createtime
 * @property string $remarks
 * @property string $money
 * @property integer $type
 * @property integer $source
 */
class Account extends \yii\db\ActiveRecord
{
    public static $typeText=[1=>'增',2=>'减'];
    public static $sourceText=[
        1=>'公开课点评绩效奖励',
        2=>'病例研讨绩效奖励',
        3=>'线下培训绩效奖励',
        4=>'巡回义诊绩效奖励',
        5=>'线上培训绩效奖励',
        6=>'绩效提现',
    ];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'account';
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
            [['userid', 'createtime', 'type', 'source'], 'integer'],
            [['money'], 'number'],
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
            'userid' => 'Userid',
            'createtime' => 'Createtime',
            'remarks' => 'Remarks',
            'money' => 'Money',
            'type' => 'Type',
            'source' => 'Source',
        ];
    }
}
