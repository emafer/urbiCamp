<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\search\InternatoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="internato-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'anagrafica_id') ?>

    <?= $form->field($model, 'provenienza_da_id') ?>

    <?= $form->field($model, 'provienza_da_campo_id') ?>

    <?= $form->field($model, 'matricola') ?>

    <?php // echo $form->field($model, 'data_arrivo') ?>

    <?php // echo $form->field($model, 'data_uscita') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
