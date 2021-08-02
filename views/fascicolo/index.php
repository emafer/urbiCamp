<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\search\FascicoloSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $faldone_id string */
/* @var $faldone \app\models\Faldone */

if (!isset($faldone_id)) {
    $faldone_id = '';
}
$this->title = 'Fascicoli';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="fascicolo-index">

    <h1><?php
        if ($faldone_id) {
            echo Html::encode('Fascicoli contenuti nel faldone ' . $faldone->getNomeCompleto());
        } else {
            echo Html::encode($this->title);
        } ?></h1>

    <p>
        <?php
        if (!$faldone_id) {
            echo Html::a('Crea Fascicolo', ['create'], ['class' => 'btn btn-success']);
        } else {
            echo  Html::a('Crea Fascicolo',
                ['create', 'faldone_id' => $faldone_id],
                ['class' => 'btn btn-success']
            );
        } ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'faldone.archivio.abbr',
            'faldone.classificazione',
            'descrizione',
            'note',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' =>'{view} {update} {delete} {lista}',
                'buttons' => [
                    'lista' => function ($url, $model, $key) {
                        return Html::a('<i class="glyphicon glyphicon-list"></i>', ['documento/lista', 'fascicolo'=>$model->id]);
                    },
                    ],
                ],
            ]
    ]); ?>


</div>
