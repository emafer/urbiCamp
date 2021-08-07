<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Familiare */

$this->title = Yii::t('app', 'Update Familiare: {name}', [
    'name' => $model->anagrafica_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Familiares'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->anagrafica_id, 'url' => ['view', 'anagrafica_id' => $model->anagrafica_id, 'familiare_id' => $model->familiare_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="familiare-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
