<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\DocumentazioneFotografica */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Documentazione Fotograficas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="documentazione-fotografica-view">

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
            'id',
            'fascicolo_id',
            'data',
            'data_fittizia',
            'documento_di_riferimento_id',
            'note:ntext',
            'descrizione:ntext',
            'descrizione_en:ntext',
            'nota_matita',
            'testoNotaMatita:ntext',
            'immagine_id',
            'autore',
            'creato_il',
            'modificato_da',
            'modificato_il',
        ],
    ]) ?>

</div>
