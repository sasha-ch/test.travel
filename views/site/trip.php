<?php

/* @var $this yii\web\View */
use yii\grid\GridView;

$this->title = Yii::$app->name = 'Trip Table';
?>
<div class="site-index">
    <p>
    <?php
echo GridView::widget([
    'dataProvider' => $dataProvider,
]);
?>
</div>
