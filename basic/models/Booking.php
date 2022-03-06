<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "booking".
 *
 * @property int $id
 * @property string $coache_name
 * @property string $booking_date
 * @property string $time_slot
 */
class Booking extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'booking';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['coache_name', 'booking_date', 'time_slot'], 'required'],
            [['booking_date'], 'safe'],
            [['coache_name', 'time_slot'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'coache_name' => 'Coache Name',
            'booking_date' => 'Booking Date',
            'time_slot' => 'Time Slot',
            'coaches_master_id' => 'Coaches Master Id',
            
        ];
    }
}
