<?php

use yii\db\Migration;

/**
 * Class m190730_140716_mk_foreign_keys
 */
class m190730_140716_mk_foreign_keys extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('fk-trip_service-trip_id', 'trip_service', 'trip_id', 'trip', 'id');
        $this->addForeignKey('fk-flight_segment-flight_id', 'flight_segment', 'flight_id', 'trip_service', 'id');
        $this->execute("ALTER TABLE nemo_guide_etalon.airport_name MODIFY airport_id INT NULL DEFAULT NULL");
        $this->execute("INSERT INTO nemo_guide_etalon.airport_name (airport_id,`value`) SELECT DISTINCT depAirportId, '' 
                            FROM cbt.flight_segment LEFT JOIN nemo_guide_etalon.airport_name ON depAirportId=airport_id WHERE airport_id IS NULL");
        $this->addForeignKey('fk-flight_segment-depAirportId', 'flight_segment', 'depAirportId',
            'nemo_guide_etalon.airport_name', 'airport_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "This migration is partially non-convertible";
        $this->dropForeignKey('fk-trip_service-trip_id', 'trip_service');
        $this->dropForeignKey('fk-flight_segment-flight_id', 'flight_segment');
        $this->dropForeignKey('fk-flight_segment-depAirportId', 'flight_segment');
        $this->execute("DELETE FROM nemo_guide_etalon.airport_name WHERE airport_id IS NULL");
        $this->execute("ALTER TABLE nemo_guide_etalon.airport_name MODIFY airport_id INT NOT NULL");
    }

}
