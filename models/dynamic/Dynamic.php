<?php

namespace app\models\dynamic;

use Yii;

/**
 * This is the model class for table "dc_dynamic".
 *
 * @property integer $id
 * @property integer $userid
 * @property integer $createtime
 * @property integer $type
 * @property integer $source
 * @property integer $level
 * @property integer $pushstate
 */
class Dynamic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dc_dynamic';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbdc');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'createtime'], 'required'],
            [['userid', 'createtime', 'type', 'source', 'level', 'pushstate'], 'integer'],
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
            'type' => 'Type',
            'source' => 'Source',
            'level' => 'Level',
            'pushstate' => 'Pushstate',
        ];
    }
}
