<?php

namespace app\models\dynamic;

use Yii;

/**
 * This is the model class for table "dc_dynamic_open".
 *
 * @property integer $dynamicid
 * @property string $title
 * @property string $intro
 * @property integer $userid
 * @property integer $starttime
 * @property string $video
 * @property integer $state
 * @property string $ftitle
 * @property integer $whenlong
 */
class DyOpen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dc_dynamic_open';
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
            [['dynamicid'], 'required'],
            [['dynamicid', 'userid', 'starttime', 'state', 'whenlong'], 'integer'],
            [['title'], 'string', 'max' => 20],
            [['intro'], 'string', 'max' => 200],
            [['video'], 'string', 'max' => 100],
            [['ftitle'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'dynamicid' => 'Dynamicid',
            'title' => 'Title',
            'intro' => 'Intro',
            'userid' => 'Userid',
            'starttime' => 'Starttime',
            'video' => 'Video',
            'state' => 'State',
            'ftitle' => 'Ftitle',
            'whenlong' => 'Whenlong',
        ];
    }
}
