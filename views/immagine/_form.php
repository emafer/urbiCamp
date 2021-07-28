<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Immagine */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="immagine-form">
        <div class="col-md-3">
            <div id="preview">
                <?php
                if ($model->path) {
                    echo '<img src="/uploads/' . $model->path . '" width="300">';
                }
                ?>
            </div>
        </div>
        <div class="col-md-9">
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'path')->fileInput(['onchange' => 'getFileData(this);']) ?>
            <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'descrizione')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'lato')->dropDownList(['R' => 'R', 'V' => 'V', 'destra' => 'destra',
                'sinistra' => 'sinistra', 'sotto' => 'sotto', 'sopra' => 'sopra', 'davanti' => 'davanti', 'dietro' => 'dietro']) ?>
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div   >
</div>