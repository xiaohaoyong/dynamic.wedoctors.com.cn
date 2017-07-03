<?php

namespace app\models\dynamic;

use Yii;

/**
 * This is the model class for table "dc_dynamic_imgs".
 *
 * @property integer $id
 * @property string $src
 * @property integer $createtime
 * @property integer $dynamicid
 */
class Dyimgs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dc_dynamic_imgs';
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
            [['src', 'dynamicid'], 'required'],
            [['createtime', 'dynamicid'], 'integer'],
            [['src'], 'string', 'max' => 63],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'src' => 'Src',
            'createtime' => 'Createtime',
            'dynamicid' => 'Dynamicid',
        ];
    }
}
