<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\search\InternatoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Internatos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="internato-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Internato'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'anagrafica.nomeCompleto',
            'provenienzaDa.nome',
            'provienzaDaCampo.nome',
            'matricola',
            'data_arrivo',
            'data_uscita',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
