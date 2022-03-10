<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dataset".
 *
 * @property int $id
 * @property string $name
 * @property string $timezone
 * @property string $day_of_week
 * @property string $available_at
 * @property string $available_until
 */
class Dataset extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dataset';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'timezone', 'day_of_week', 'available_at', 'available_until'], 'required'],
            [['name', 'timezone', 'day_of_week', 'available_at', 'available_until'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'timezone' => 'Timezone',
            'day_of_week' => 'Day Of Week',
            'available_at' => 'Available At',
            'available_until' => 'Available Until',
            'coaches_master_id' => 'Coaches Master Id',

        ];
    }
}
