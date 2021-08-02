<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Fascicolo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fascicolo-form">
<div class="row">
    <?php $form = ActiveForm::begin();
    $items = \yii\helpers\ArrayHelper::map(\app\models\Faldone::find()->all(), 'id', 'nomeCompleto');?>
    <?= $form->field($model, 'faldone_id')->dropDownList($items, ['placeholder' =>'']) ?>

    <?= $form->field($model, 'descrizione')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>
    <?php \app\commands\HelperUrbiCampFormController::creaSelect2Internati($form, $model, 'internati', ''); ?>
</div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
