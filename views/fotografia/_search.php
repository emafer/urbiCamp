<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\search\FotograficaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="documentazione-fotografica-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'fascicolo_id') ?>

    <?= $form->field($model, 'data') ?>

    <?= $form->field($model, 'data_fittizia') ?>

    <?= $form->field($model, 'documento_di_riferimento_id') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'descrizione') ?>

    <?php // echo $form->field($model, 'descrizione_en') ?>

    <?php // echo $form->field($model, 'nota_matita') ?>

    <?php // echo $form->field($model, 'testoNotaMatita') ?>

    <?php // echo $form->field($model, 'immagine_id') ?>

    <?php // echo $form->field($model, 'autore') ?>

    <?php // echo $form->field($model, 'creato_il') ?>

    <?php // echo $form->field($model, 'modificato_da') ?>

    <?php // echo $form->field($model, 'modificato_il') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
