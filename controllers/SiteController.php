<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;

use yii\data\ActiveDataProvider;
use app\models\NemoAirportName;
use app\models\Trip;
use yii\web\NotFoundHttpException;

class SiteController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->redirect("/site/trip?corporate_id=3&service_id=2&airport_name=" . urlencode("Домодедово, Москва"));
        //airport_id=758
    }

    /**
     * @param int $corporate_id
     * @param int $service_id
     * @param int $airport_id
     *
     * @return string
     */
    public function actionTrip(int $corporate_id, int $service_id, string $airport_name)
    {
        //Probably non-production example
        $depAirport = NemoAirportName::findOne(['value' => $airport_name]);

        if(empty($depAirport)){
            throw new NotFoundHttpException("Selected airport not found");
        }

        $airport_id = $depAirport->airport_id;

        $query = Trip::find()->filterByCorpServAirport($corporate_id, $service_id, $airport_id)
                     ->asArray();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('trip', ['dataProvider' => $dataProvider]);
    }
}
