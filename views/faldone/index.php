<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\search\FaldoneSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Faldoni';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faldone-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crea Faldone', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'archivio.abbr',
            'descrizione',
            'note',
            'classificazione',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
