<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Faldone */

$this->title = 'Update Faldone: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Buste', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="faldone-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
