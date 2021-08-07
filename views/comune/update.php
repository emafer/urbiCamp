<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Comune */
/* @var $ajax boolean */
/* @var $fid string */

$this->title = 'Update Comune: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Comunes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="comune-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'ajax' => $ajax,
        'fid' => $fid ?? ''
    ]) ?>

</div>
