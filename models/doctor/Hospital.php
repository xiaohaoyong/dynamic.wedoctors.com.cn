<?php

namespace app\models\doctor;

use Yii;

/**
 * This is the model class for table "hospital".
 *
 * @property integer $id
 * @property string $name
 * @property integer $province
 * @property integer $city
 * @property integer $county
 * @property integer $type
 * @property integer $rank
 * @property integer $nature
 * @property integer $createtime
 * @property string $area
 */
class Hospital extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hospital';
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
            [['name'], 'required'],
            [['province', 'city', 'county', 'type', 'rank', 'nature', 'createtime'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['area'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'province' => 'Province',
            'city' => 'City',
            'county' => 'County',
            'type' => 'Type',
            'rank' => 'Rank',
            'nature' => 'Nature',
            'createtime' => 'Createtime',
            'area' => 'Area',
        ];
    }
}
