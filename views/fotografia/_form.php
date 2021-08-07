<?php
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DocumentazioneFotografica */
/* @var $immagine app\models\Immagine */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="documento-form">

    <?php $form = ActiveForm::begin(['options' => [
        'enctype' => 'multipart/form-data'
    ]]);
    $items = \yii\helpers\ArrayHelper::map(\app\models\Fascicolo::find()->all(), 'id', 'nomeCompleto');?>
    <?= $form->field($model, 'fascicolo_id')->dropDownList($items, ['placeholder' =>'']) ?>
    <div class="row">
        <div class="col-md-6">
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'data')->textInput(['type' => 'date']) ?>
            <?= $form->field($model, 'data_fittizia')->checkbox() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
        </div>
        <div class="col-md-6">
        </div>
    </div>

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
                $campi = \yii\helpers\ArrayHelper::map(\app\models\Campo::find()->all(), 'id', 'nome');
                echo $form->field($model, 'campo_id')->dropDownList($campi, ['prompt' =>''] ); ?>
            </div>
            <div class="col-md-6">
                <?php
                \app\commands\HelperUrbiCampFormController::creaSelect2Internati(
                    $form,
                    $model,
                    'internati',
                    'cerca'
                );
                ?>
            </div>
            <div class="col-md-6">

            </div>
            <div class="col-md-6">
            </div>
        </div>
        <?= $form->field($model, 'note')->textarea() ?>
        <div class="row">
            <div class="immagine-form">
                <div class="col-md-3">
                    <div id="preview">
                        <?php
                        if ($immagine->path) {
                            echo '<img src="/uploads/' . $immagine->path . '" width="300">';
                        }
                        ?>
                    </div>
                </div>
                <div class="col-md-9">
                    <?php $form = ActiveForm::begin([
                        'id' => 'add-form',
                        'options' => ['class' => 'form-inline'],
                    ]); ?>
                    <?= $form->field($immagine, 'path')->fileInput(['onchange' => 'getFileData(this);']) ?>
                    <?= $form->field($immagine, 'nome')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($immagine, 'descrizione')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($immagine, 'lato')->dropDownList(['R' => 'R', 'V' => 'V', 'destra' => 'destra',
                        'sinistra' => 'sinistra', 'sotto' => 'sotto', 'sopra' => 'sopra', 'davanti' => 'davanti', 'dietro' => 'dietro']) ?>
                    <div class="form-group">
                        <?php
                        Html::submitButton('Save', ['class' => 'btn btn-success']);
                        ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>
    </fieldset>

    <?php ActiveForm::end(); ?>

</div>
