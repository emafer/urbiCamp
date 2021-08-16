<?php

use demogorgorn\ajax\AjaxSubmitButton;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Tipologia */
/* @var $form yii\widgets\ActiveForm */
/* @var $ajax boolean */
/* @var $fid string */
?>

<div class="tipologia-form">

    <?php $form = ActiveForm::begin([
        'id' => 'add-tipo-form'
    ]); ?>

    <?= $form->field($model, 'descrizione')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'abbr')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?php

        if ($ajax) {
            AjaxSubmitButton::begin([
                'label' => 'Crea',
                'useWithActiveForm' => 'add-tipo-form',
                'ajaxOptions' => [
                    'url' => 'index.php?r=tipologia/create&via=ajax&fid=' . $fid,
                    'type' => 'POST',
                    'processData' => false, // Don't process the files
                    'contentType' => false, // Set content type to false as jQuery will tell the server its a query string request
                    'data' => new \yii\web\JsExpression("new FormData($('#add-tipo-form')[0])"), // Do not stringify the form
                    'success' => new \yii\web\JsExpression("function(data) {
                             if (data.status == true)
                                {
                                    $('#closeModal').click();
                                    $('#add-tipo-form').trigger('reset');
                                    $('#' + data.fid ).append('<option value=\"' + data.id + '\" selected=\"selected\">' + data.nome + '</option>');
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
