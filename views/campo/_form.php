<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Campo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="campo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php \app\commands\HelperUrbiCampFormController::creaSelect2Comuni($form, $model, 'comune_id', ''); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'data_creazione')->textInput(['type' => 'date']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
