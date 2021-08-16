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
            'nomeInternati',
            'tipologia.descrizione',
            'descrizione',
            'descrizione_en',
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
    $images = [];
    ?>
    <div class="row">
        <?php
        foreach ($model->documentoImmagini as $docImmagine) {
            $images[] = [
                'src' => '/web/uploads/' . $docImmagine->immagine->path,
                'title' =>  $docImmagine->immagine->descrizione,
            ];
            echo '<div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">' . $docImmagine->immagine->nome . '</h5>
                    <img src="/web/uploads/' . $docImmagine->immagine->path. '" class="card-img-top">
                    <p class="card-text">' . $docImmagine->immagine->descrizione . '</p>';
            echo '</div>
<div class="card-footer">
<a href="/index.php?r=documento-immagine%2Fdelete&amp;immagine_id=' .  $docImmagine->immagine_id .'&amp;documento_id=' .  $model->id .'" title="Delete" aria-label="Delete" data-pjax="0" data-confirm="Are you sure you want to delete this item?" data-method="post"><svg aria-hidden="true" style="display:inline-block;font-size:inherit;height:1em;overflow:visible;vertical-align:-.125em;width:.875em" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M32 464a48 48 0 0048 48h288a48 48 0 0048-48V128H32zm272-256a16 16 0 0132 0v224a16 16 0 01-32 0zm-96 0a16 16 0 0132 0v224a16 16 0 01-32 0zm-96 0a16 16 0 0132 0v224a16 16 0 01-32 0zM432 32H312l-9-19a24 24 0 00-22-13H167a24 24 0 00-22 13l-9 19H16A16 16 0 000 48v32a16 16 0 0016 16h416a16 16 0 0016-16V48a16 16 0 00-16-16z"></path></svg></a>
</div>
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