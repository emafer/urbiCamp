<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DocumentoImmagine */

$this->title = Yii::t('app', 'Create Documento Immagine');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Documento Immagines'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documento-immagine-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
