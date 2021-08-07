<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DocumentazioneFotografica */
/* @var $immagine app\models\Immagine */

$this->title = Yii::t('app', 'Create Documentazione Fotografica');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Documentazione Fotograficas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documentazione-fotografica-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'immagine' => $immagine,
    ]) ?>

</div>
