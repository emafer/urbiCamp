<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\search\CampoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Campi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="campo-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crea Campo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'nome',
            'comune.nome',
            'data_creazione',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
