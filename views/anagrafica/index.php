<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\search\AnagraficaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Anagraficas';
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

            'id',
            'nato_a_id',
            'morto_a_id',
            'cognome',
            'nome',
            //'nato_il',
            //'morto_il',
            //'secondo_nome',
            //'morto_shoah',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
