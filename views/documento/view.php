<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Documento */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Documenti'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="documento-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'fascicolo.nomeCompleto',
            'oggetto',
            'data',
            'printDataFittizia',
            'nomeMittenti',
            'nomeDestinatari',
            'nomeInteressati',
            'tipologia.descrizione',
            'descrizione',
            'note'
        ],
    ]);
    echo '<h3>Immagini</h3>';
    echo Html::a('<span class="glyphicon glyphicon-plus"></span>',
    \yii\helpers\Url::toRoute(['/immagine/create','via' => 'ajax', 'mid' => $model->id, 'targetModel' => 'Documento']),
    [
    'data-toggle'=>'modal',
    'data-target'=>'#modalImgCreate',
    ]
    );
    ?>
    <div class="row">
        <?php
        foreach ($model->documentoImmagini as $docImmagine) {
            echo '<div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">' . $docImmagine->immagine->nome . '</h5>
                    <img src="/uploads/' . $docImmagine->immagine->path. '" class="card-img-top">
                    <p class="card-text">' . $docImmagine->immagine->descrizione . '</p>';

            echo '</div>
            </div>
        </div>';
        }

        ?>
    </div>
</div>
<div class="modal remote fade" id="modalImgCreate">
    <div class="modal-dialog">
        <div class="modal-content  loader-lg"> <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div></div>
    </div>
</div>
<div class="modal remote fade" id="showImage">
    <div class="modal-dialog">
        <div class="modal-content loader-lg"></div>
    </div>
</div>
