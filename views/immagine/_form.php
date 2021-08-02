<?php

use demogorgorn\ajax\AjaxSubmitButton;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Immagine */
/* @var $form yii\widgets\ActiveForm */
/* @var $ajax boolean */
/* @var $targetModel string */
/* @var $mid integer */
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
            <?php $form = ActiveForm::begin([
                'id' => 'add-form',
                'options' => ['class' => 'form-inline'],
            ]); ?>
            <?= $form->field($model, 'path')->fileInput(['onchange' => 'getFileData(this);']) ?>
            <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'descrizione')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'lato')->dropDownList(['R' => 'R', 'V' => 'V', 'destra' => 'destra',
                'sinistra' => 'sinistra', 'sotto' => 'sotto', 'sopra' => 'sopra', 'davanti' => 'davanti', 'dietro' => 'dietro']) ?>
            <input type="hidden" name ="mid" value="<?php echo $mid;?>"/>
            <input type="hidden" name ="targetModel" value="<?php echo $targetModel;?>"/>
            <div class="form-group">
                <?php
                if ($ajax) {
                    AjaxSubmitButton::begin([
                        'label' => 'Crea',
                        'useWithActiveForm' => 'add-form',
                        'ajaxOptions' => [
                            'url' => 'index.php?r=immagine/create&via=ajax',
                            'type' => 'POST',
                            'processData' => false, // Don't process the files
                            'contentType' => false, // Set content type to false as jQuery will tell the server its a query string request
                            'data' => new \yii\web\JsExpression("new FormData($('#add-form')[0])"), // Do not stringify the form
                            'success' => new \yii\web\JsExpression("function(data) {
                             if (data.status == true)
                                {
                                    $('#modalImgCreate modal-content').html('');
                                    $('#closeModal').click();
                                }                                            
            }"),
                        ],
                        'options' => ['class' => 'btn btn-primary', 'type' => 'submit', 'id' =>'add-button'],
                    ]);
                    AjaxSubmitButton::end();
                } else {
                    echo Html::submitButton('Save', ['class' => 'btn btn-success']);
                }
                ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>