<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\search\FaldoneSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $archivio_id string */
$this->title = 'Faldoni';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faldone-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
        if (!$archivio_id) {
            echo Html::a('Crea Faldone', ['create'], ['class' => 'btn btn-success']);
        } else {
           echo  Html::a('Crea Faldone', ['create', 'archivio_id' => $archivio_id], ['class' => 'btn btn-success']);
        } ?>
    </p>

    <?php $dataProvider->setSort([
        'defaultOrder' => [
            'classificazione' => SORT_ASC
        ]])
    // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'archivio.abbr',
            'classificazione',
            'descrizione',
            'note',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' =>'{view} {update} {delete} {lista}',
                'buttons' => [
                    'lista' => function ($url, $model, $key) {
                        return Html::a('<i class="glyphicon glyphicon-list"></i>', ['fascicolo/lista', 'faldone'=>$model->id]);
                    },
                    ],
                ],
            ]
        ]);
    ?>
</div>
