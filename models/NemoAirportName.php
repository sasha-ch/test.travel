<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nemo_guide_etalon.airport_name".
 *
 * @property int $id
 * @property int $airport_id
 * @property int $language_id
 * @property string $value
 */
class NemoAirportName extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nemo_guide_etalon.airport_name';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['airport_id', 'language_id'], 'integer'],
            [['value'], 'required'],
            [['value'], 'string', 'max' => 255],
            [['airport_id', 'language_id'], 'unique', 'targetAttribute' => ['airport_id', 'language_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'airport_id' => Yii::t('app', 'Airport ID'),
            'language_id' => Yii::t('app', 'Language ID'),
            'value' => Yii::t('app', 'Value'),
        ];
    }
}
