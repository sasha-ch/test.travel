<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "trip_service".
 *
 * @property int $id
 * @property int $trip_id
 * @property int $service_id
 * @property int $status
 * @property int $type_booking Тип заказа
 * @property int $variants Варианты
 * @property string $price
 * @property string $currency
 * @property string $confirmation_number
 * @property int $deadline
 * @property int $date_start
 * @property int $date_end
 * @property int $start_city_id
 * @property int $start_point_id
 * @property int $end_point_id
 * @property int $end_city_id
 * @property string $description
 *
 * @property FlightSegment[] $flightSegments
 * @property Trip $trip
 */
class TripService extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trip_service';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['trip_id', 'service_id', 'type_booking', 'variants', 'description'], 'required'],
            [['trip_id', 'service_id', 'status', 'type_booking', 'variants', 'deadline', 'date_start', 'date_end', 'start_city_id', 'start_point_id', 'end_point_id', 'end_city_id'], 'integer'],
            [['price'], 'number'],
            [['description'], 'string'],
            [['currency'], 'string', 'max' => 3],
            [['confirmation_number'], 'string', 'max' => 16],
            [['trip_id'], 'exist', 'skipOnError' => true, 'targetClass' => Trip::className(), 'targetAttribute' => ['trip_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'trip_id' => Yii::t('app', 'Trip ID'),
            'service_id' => Yii::t('app', 'Service ID'),
            'status' => Yii::t('app', 'Status'),
            'type_booking' => Yii::t('app', 'Тип заказа'),
            'variants' => Yii::t('app', 'Варианты'),
            'price' => Yii::t('app', 'Price'),
            'currency' => Yii::t('app', 'Currency'),
            'confirmation_number' => Yii::t('app', 'Confirmation Number'),
            'deadline' => Yii::t('app', 'Deadline'),
            'date_start' => Yii::t('app', 'Date Start'),
            'date_end' => Yii::t('app', 'Date End'),
            'start_city_id' => Yii::t('app', 'Start City ID'),
            'start_point_id' => Yii::t('app', 'Start Point ID'),
            'end_point_id' => Yii::t('app', 'End Point ID'),
            'end_city_id' => Yii::t('app', 'End City ID'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFlightSegments()
    {
        return $this->hasMany(FlightSegment::className(), ['flight_id' => 'id'])->inverseOf('flight');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrip()
    {
        return $this->hasOne(Trip::className(), ['id' => 'trip_id'])->inverseOf('tripServices');
    }
}
