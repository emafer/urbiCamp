<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\search\ImmagineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Immagines';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="immagine-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Immagine', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [

                'attribute' => 'path',
                'format' => 'html',
                'label' => 'ImageColumnLabel',
                'value' => function ($data) {
                    return Html::img('/uploads/' . $data['path'],
                        ['width' => '60px']);
                },

            ],
            'lato',
            'nome',
            'descrizione',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
