<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\search\StatoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Statos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stato-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Stato', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nome',
            'nome_pulito',
            'cittadinanza',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
