<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Anagrafica */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="anagrafica-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nato_a_id')->textInput() ?>

    <?= $form->field($model, 'morto_a_id')->textInput() ?>

    <?= $form->field($model, 'cognome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nato_il')->textInput() ?>

    <?= $form->field($model, 'morto_il')->textInput() ?>

    <?= $form->field($model, 'secondo_nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'morto_shoah')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
