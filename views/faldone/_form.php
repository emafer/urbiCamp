<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Faldone */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="faldone-form">

    <?php $form = ActiveForm::begin();
    $items = \yii\helpers\ArrayHelper::map(\app\models\Archivio::find()->all(), 'id', 'descrizione');?>

    <?= $form->field($model, 'archivio_id')->dropDownList($items, ['placeholder' =>'']) ?>

    <?= $form->field($model, 'descrizione')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'classificazione')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
