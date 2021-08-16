<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DocumentoImmagine */

$this->title = Yii::t('app', 'Update Documento Immagine: {name}', [
    'name' => $model->documento_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Documento Immagines'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->documento_id, 'url' => ['view', 'documento_id' => $model->documento_id, 'immagine_id' => $model->immagine_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="documento-immagine-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
