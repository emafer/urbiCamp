<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fondi d\'archivio';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="archivio-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Archivio', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'descrizione',
            'abbr',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' =>'{view} {update} {delete} {lista}',
            'buttons' => [
                'lista' => function ($url, $model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-list"></i>', ['faldone/lista', 'fondo'=>$model->id]);
                },
            ]
            ],
        ],
    ]); ?>
<i>Struttura dei fondi d'archivio da usare;</i>
    <ul>
        <li><strong>Fondi Privati</strong>: inserire ogni fondo privato come se fosse una "busta" dell'archivio FONDO PRIVATO</li>
        <li><strong>Fondi Bibliografici</strong>: inserire ogni autore come se fosse una "busta" e ogni libro come "fascicolo"</li>
    </ul>

</div>
