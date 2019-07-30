<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Trip]].
 *
 * @see Trip
 */
class TripQuery extends \yii\db\ActiveQuery
{
    public function filterByCorpServAirport(int $corporate_id, int $service_id, int $airport_id)
    {
        return $this->andWhere(['corporate_id' => $corporate_id])
                    ->innerJoinWith([
                        'tripServices' => function ($query) use ($airport_id){
                            $query->innerJoinWith('flightSegments', false)
                                  ->andWhere(['depAirportId' => $airport_id]);
                        },
                    ], false)
                    ->andWhere(['service_id' => $service_id])
                    ->distinct();
    }
}
