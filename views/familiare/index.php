<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Familiares');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="familiare-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Familiare'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'anagrafica.nomeCompleto',
            'familiare.nomeCompleto',
            'ruolo.ruolo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
