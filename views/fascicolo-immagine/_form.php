<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FascicoloImmagine */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fascicolo-immagine-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fascicolo_id')->textInput() ?>

    <?= $form->field($model, 'immagine_id')->textInput() ?>

    <?= $form->field($model, 'ordine')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
