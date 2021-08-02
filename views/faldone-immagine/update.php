<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FaldoneImmagine */

$this->title = Yii::t('app', 'Update Faldone Immagine: {name}', [
    'name' => $model->faldone_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Faldone Immagines'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->faldone_id, 'url' => ['view', 'faldone_id' => $model->faldone_id, 'immagine_id' => $model->immagine_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="faldone-immagine-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
