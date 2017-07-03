<?php

namespace app\models\dynamic;

use Yii;

/**
 * This is the model class for table "dc_dynamic_seminar".
 *
 * @property integer $dynamicid
 * @property string $title
 * @property string $phase
 * @property integer $state
 * @property integer $userid
 * @property string $content
 * @property string $ftitle
 * @property string $intro
 */
class DySeminar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dc_dynamic_seminar';
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
            [['dynamicid', 'title', 'phase', 'content'], 'required'],
            [['dynamicid', 'state', 'userid'], 'integer'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 30],
            [['phase'], 'string', 'max' => 10],
            [['ftitle'], 'string', 'max' => 50],
            [['intro'], 'string', 'max' => 200],
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
            'phase' => 'Phase',
            'state' => 'State',
            'userid' => 'Userid',
            'content' => 'Content',
            'ftitle' => 'Ftitle',
            'intro' => 'Intro',
        ];
    }
}
