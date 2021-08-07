<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\search\AnagraficaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Anagrafiche';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anagrafica-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Anagrafica', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'cognome',
            'nome',
            'nato',
            'morto',
            ['class' => 'yii\grid\ActionColumn',
                'template' =>'{view} {update} {delete} {lista}',
                'buttons' => [
                    'lista' => function ($url, $model, $key) {
                        return Html::a('<i class="glyphicon glyphicon-list"></i>', ['familiare/lista', 'anagrafica'=>$model->id], ['alt'=>'familiari', 'title' => 'familiari']);
                    },
                    ],
                ],
            ],
    ]); ?>


</div>
