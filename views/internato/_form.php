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
    $campi = \yii\helpers\ArrayHelper::map(\app\models\Campo::find()->all(), 'id', 'nome');

    foreach ($model->internatoCampi as $k =>$item) {
        echo $this->render('../internatoCampo/_form', [
            'item' => $item,
            'form' => $form,
            'k' => $k,
            'campi' => $campi,
            'new' => false
        ]);
    }
    echo $this->render('../internatoCampo/_form', [
        'item' => new \app\models\InternatoCampo(),
        'form' => $form,
        'k' => count($model->internatoCampi),
        'campi' => $campi,
        'new' => true
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
