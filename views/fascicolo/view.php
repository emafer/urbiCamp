<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Fascicolo */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Fascicolos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="fascicolo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php
    echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'faldone.archivio.abbr',
            'faldone.descrizione',
            'descrizione',
            'note',
        ]
    ]);
    echo '<h3>Immagini</h3>';
    echo Html::a('<span class="glyphicon glyphicon-plus"></span>',
        \yii\helpers\Url::toRoute(['/immagine/create','via' => 'ajax', 'mid' => $model->id, 'targetModel' => 'Fascicolo']),
        [
            'data-toggle'=>'modal',
            'data-target'=>'#modalImgCreate',
        ]
    );
    ?>
    <div class="row">
    <?php

    foreach ($model->fascicoloImmagines as $fascicoloImmagine) {
   echo '<div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">' . $fascicoloImmagine->immagine->nome . '</h5>
                    <img src="/uploads/' . $fascicoloImmagine->immagine->path. '" class="card-img-top">
                    <p class="card-text">' . $fascicoloImmagine->immagine->descrizione . '</p>';

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