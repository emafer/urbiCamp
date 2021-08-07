<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\search\FotograficaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Documentazione Fotograficas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documentazione-fotografica-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Documentazione Fotografica'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'fascicolo_id',
            'data',
            'data_fittizia',
            'documento_di_riferimento_id',
            //'note:ntext',
            //'descrizione:ntext',
            //'descrizione_en:ntext',
            //'nota_matita',
            //'testoNotaMatita:ntext',
            //'immagine_id',
            //'autore',
            //'creato_il',
            //'modificato_da',
            //'modificato_il',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
