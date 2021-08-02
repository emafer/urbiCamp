<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Comune */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comune-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php $comuni = \yii\helpers\ArrayHelper::map(\app\models\Provincia::find()->all(), 'id', 'nome');?>
    <?= $form->field($model, 'provincia_id')->dropDownList($comuni, ['prompt' =>'']); ?>
    <?php $comuni = \yii\helpers\ArrayHelper::map(\app\models\Stato::find()->all(), 'id', 'nome');?>
    <?= $form->field($model, 'stato_id')->dropDownList($comuni, ['prompt' =>'']); ?>
    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
