<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tipologia */
/* @var $ajax boolean */

$this->title = Yii::t('app', 'Update Tipologia: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tipologias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tipologia-update">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= $this->render('_form', [
        'model' => $model,
        'ajax' => $ajax
    ]) ?>

</div>
