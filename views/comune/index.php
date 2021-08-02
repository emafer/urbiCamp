<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Comuni';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comune-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crea Comune', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nome',
            'provincia.nome',
            'stato.nome',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
