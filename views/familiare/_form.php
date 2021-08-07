<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Familiare */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="familiare-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php \app\commands\HelperUrbiCampFormController::creaSelect2Anagrafica($form,
    $model,
    'anagrafica_id',
    'Cerca per cognome',
    false
    ); ?>
    <?php \app\commands\HelperUrbiCampFormController::creaSelect2Anagrafica($form,
        $model,
        'familiare_id',
        'Cerca per cognome',
        false
    ); ?>

    <?php
    $items = \yii\helpers\ArrayHelper::map(\app\models\Ruolo::find()->all(), 'id', 'ruolo');
    echo $form->field($model, 'ruolo_id')->dropDownList($items, ['placeholder' =>'']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
