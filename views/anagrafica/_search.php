<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\search\AnagraficaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="anagrafica-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nato_a_id') ?>

    <?= $form->field($model, 'morto_a_id') ?>

    <?= $form->field($model, 'cognome') ?>

    <?= $form->field($model, 'nome') ?>

    <?php // echo $form->field($model, 'nato_il') ?>

    <?php // echo $form->field($model, 'morto_il') ?>

    <?php // echo $form->field($model, 'secondo_nome') ?>

    <?php // echo $form->field($model, 'morto_shoah') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
