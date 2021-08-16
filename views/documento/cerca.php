<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\search\DocumentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $fascicolo_id string */
/* @var $fascicolo \app\models\Fascicolo */

$this->title = Yii::t('app', 'Documenti');
$this->params['breadcrumbs'][] = $this->title;
if (!isset($fascicolo_id)) { $fascicolo_id = '';}
?>
<div class="modal-header">
    <div class="text-right">
        <button type="button" id="closeModal" class="btn-close" data-dismiss="modal" aria-label="Close"><i class="glyphicon glyphicon-log-out"></i></button>
    </div>
</div>
<div class="modal-body">
<div class="documento-index">


    <h1>Cerca documento</h1>

    <?= \fedemotta\datatables\DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //'documento_di_riferimento_id',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' =>'{usami}',
                'buttons' => [
                    'usami' => function ($url, $model, $key) {
                        return Html::a('<i class="glyphicon glyphicon-hand-left"></i>', '#', ['onclick' => new \yii\web\JsExpression("pippo({$model->id}, '{$model->oggetto}');"),
                            'data-target' => $model->id
                        ]);

                    },
                ],
            ],
//            'fascicolo.nomeCompleto',
//            'tipologia.abbr',
            'data',
            'oggetto',
            'nomeMittenti',
            'nomeDestinatari',
//            'nomeInteressati',
            'printDataFittizia',
            'descrizione',
        ],
    ]); ?>


</div>

</div>
