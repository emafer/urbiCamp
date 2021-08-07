<?php

use demogorgorn\ajax\AjaxSubmitButton;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Comune */
/* @var $form yii\widgets\ActiveForm */
/* @var $ajax boolean */
/* @var $fid string */

?>

<div class="comune-form">

    <?php $form = ActiveForm::begin([
        'id' => 'add-comune-form'
    ]); ?>

    <?php $comuni = \yii\helpers\ArrayHelper::map(\app\models\Provincia::find()->all(), 'id', 'nome');?>
    <?= $form->field($model, 'provincia_id')->dropDownList($comuni, ['prompt' =>'']); ?>
    <?php $comuni = \yii\helpers\ArrayHelper::map(\app\models\Stato::find()->all(), 'id', 'nome');?>
    <?= $form->field($model, 'stato_id')->dropDownList($comuni, ['prompt' =>'']); ?>
    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?php

        if ($ajax) {
            AjaxSubmitButton::begin([
                'label' => 'Crea',
                'useWithActiveForm' => 'add-comune-form',
                'ajaxOptions' => [
                    'url' => 'index.php?r=comune/create&via=ajax&fid=' . $fid,
                    'type' => 'POST',
                    'processData' => false, // Don't process the files
                    'contentType' => false, // Set content type to false as jQuery will tell the server its a query string request
                    'data' => new \yii\web\JsExpression("new FormData($('#add-comune-form')[0])"), // Do not stringify the form
                    'success' => new \yii\web\JsExpression("function(data) {
                             if (data.status == true)
                                {
                                    $('#modalCreate modal-content').html('');
                                    $('#' + data.fid ).append('<option value=\"' + data.id + '\" selected=\"selected\">' + data.nome + '</option>');
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
