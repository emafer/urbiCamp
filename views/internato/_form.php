<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Internato */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="internato-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php
    \app\commands\HelperUrbiCampFormController::creaSelect2Anagrafica($form, $model, 'anagrafica_id', '...', false);
    ?>
    <?php
    \app\commands\HelperUrbiCampFormController::creaSelect2Comuni($form, $model, 'provenienza_da_id', '');

    $campi = \yii\helpers\ArrayHelper::map(\app\models\Campo::find()->all(), 'id', 'nome');
        echo $form->field($model, 'provienza_da_campo_id')->dropDownList($campi, ['prompt' =>'']);
        echo $form->field($model, 'campo_differente_id')->dropDownList($campi, ['prompt' =>'']);
?>

    <?= $form->field($model, 'matricola')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'data_arrivo')->textInput() ?>

    <?= $form->field($model, 'data_uscita')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
