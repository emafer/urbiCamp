<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Campo */

$this->title = 'Create Campo';
$this->params['breadcrumbs'][] = ['label' => 'Campi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="campo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
