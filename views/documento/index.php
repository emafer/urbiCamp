<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\search\DocumentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $fascicolo_id string */
/* @var $fascicolo \app\models\Fascicolo */

$this->title = Yii::t('app', 'Documentos');
$this->params['breadcrumbs'][] = $this->title;
if (!isset($fascicolo_id)) { $fascicolo_id = '';}
?>
<div class="documento-index">


    <h1><?php
        if ($fascicolo_id) {
            echo Html::encode('Documenti contenuti nel fascicolo ' . $fascicolo->getNomeCompleto());
        } else {
            echo Html::encode($this->title);
        } ?></h1>

    <p>

        <?php
        if (!$fascicolo_id) {
            echo Html::a('Crea Documento', ['create'], ['class' => 'btn btn-success']);
        } else {
            echo  Html::a('Crea Documento',
                ['create', 'fascicolo_id' => $fascicolo_id],
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
            'fascicolo.nomeCompleto',
            'tipologia.abbr',
            'data',
            'oggetto',
            'nomeMittenti',
            'nomeDestinatari',
            'nomeInteressati',
            'printDataFittizia',
            'descrizione',
            //'documento_di_riferimento_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
