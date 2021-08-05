<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Documento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="documento-form">

    <?php $form = ActiveForm::begin();
    $items = \yii\helpers\ArrayHelper::map(\app\models\Fascicolo::find()->all(), 'id', 'nomeCompleto');?>
    <?= $form->field($model, 'fascicolo_id')->dropDownList($items, ['placeholder' =>'']) ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'protocollo')->textInput() ?>
        </div>
        <div class="col-md-6">
    <?= $form->field($model, 'data')->textInput(['type' => 'date']) ?>
            <?= $form->field($model, 'data_fittizia')->checkbox() ?>
        </div>
    </div>
<div class="row">
    <div class="col-md-6">
        <?php
        \app\commands\HelperUrbiCampFormController::creaSelect2Anagrafica($form, $model, 'mittenti', 'Scegli un mittente...');
        ?>
    </div>
    <div class="col-md-6">
        <?php
        \app\commands\HelperUrbiCampFormController::creaSelect2Anagrafica($form, $model, 'destinatari', 'Scegli un destinatario...');
        ?>
    </div>
</div>

    <?= $form->field($model, 'oggetto')->textInput(['maxlength' => true]) ?>


<fieldset>
    <legend>Dati Studio</legend>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'descrizione')->textarea() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'descrizione_en')->textarea() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?php
            \app\commands\HelperUrbiCampFormController::creaSelect2Anagrafica($form, $model, 'interessati', 'Scegli un interessato...');
            ?>
        </div>
        <div class="col-md-6">
            <?php echo $form->field($model, 'nota_matita')->checkbox();?>
            <?= $form->field($model, 'testoNotaMatita')->textarea() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?php
            echo $form->field($model, 'documento_di_riferimento_id')->widget(Select2::class, [
                'data' => [],
                'options' => ['multiple'=>false, 'placeholder' => 'Cerca per oggetto'],
                'pluginOptions' => [
                    'allowClear' => true,
                    'minimumInputLength' => 3,
                    'language' => [
                        'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
                    ],
                    'ajax' => [
                        'url' => \yii\helpers\Url::to(['list']),
                        'dataType' => 'json',
                        'data' => new JsExpression('function(params) { return {q:params.term}; }')
                    ],
                    'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                    'templateResult' => new JsExpression('function(city) { return city.text; }'),
                    'templateSelection' => new JsExpression('function (city) { return city.text; }'),
                ],
            ]);
            ?>
        </div>
        <div class="col-md-6">
            <?php
            $dataList = \app\models\Tipologia::find()->andWhere(['id' => $model->tipologia_id])->all();
            $data = \yii\helpers\ArrayHelper::map($dataList, 'id', 'descrizione');

            echo $form->field($model, 'tipologia_id')->widget(Select2::classname(), [
                'data' => $data,
                'options' => ['multiple'=>true, 'placeholder' => 'Cerca ...'],
                'pluginOptions' => [
                    'allowClear' => true,
                    'minimumInputLength' => 3,
                    'language' => [
                        'errorLoading' => new JsExpression("function () { return 'un istante...'; }"),
                    ],
                    'ajax' => [
                        'url' => $url = \yii\helpers\Url::to(['tipologia/list']),
                        'dataType' => 'json',
                        'data' => new JsExpression('function(params) { return {q:params.term}; }')
                    ],
                    'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                    'templateResult' => new JsExpression('function(city) { return city.text; }'),
                    'templateSelection' => new JsExpression('function (city) { return city.text; }'),
                ],
            ]);
        ?>
        </div>
        <div class="col-md-6">
            <?php
            \app\commands\HelperUrbiCampFormController::creaSelect2Internati(
                    $form,
                $model,
                'internati',
                ''
            );
            ?>
        </div>
        <div class="col-md-6">
            <?php echo $form->field($model, 'manoscritto')->checkbox();?>
        </div>
        <div class="col-md-6">
            <?php echo $form->field($model, 'disegno')->checkbox();?>
        </div>
    </div>
    <?= $form->field($model, 'note')->textarea() ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>
</fieldset>

    <?php ActiveForm::end(); ?>

</div>
