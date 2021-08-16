<?php

use demogorgorn\ajax\AjaxSubmitButton;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Anagrafica */
/* @var $form yii\widgets\ActiveForm */
/* @var $ajax boolean */
/* @var $fid string */
?>

<div class="anagrafica-form">

    <?php $form = ActiveForm::begin([
            'id' => 'add-anag-form'
    ]); ?>
<?php $comuni = \yii\helpers\ArrayHelper::map(\app\models\Comune::find()->all(), 'id', 'nome');?>
<div class="row">
    <div class="col-md-6"><?= $form->field($model, 'cognome')->textInput(['maxlength' => true]) ?></div>
    <div class="col-md-6">
        <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'secondo_nome')->textInput(['maxlength' => true]) ?></div>
</div>
<div class="row">
    <div class="col-md-6"><?= $form->field($model, 'nato_il')->textInput(['type' => 'date']) ?></div>
    <div class="col-md-6"><?= $form->field($model, 'nato_a_id')->dropDownList($comuni, ['prompt' =>'']); ?></div>
</div>
<div class="row">
    <div class="col-md-6"><?= $form->field($model, 'morto_il')->textInput(['type' => 'date']) ?></div>
    <div class="col-md-6"><?= $form->field($model, 'morto_a_id')->dropDownList($comuni, ['prompt' =>'']) ?>
        <?= $form->field($model, 'morto_shoah')->checkbox() ?></div>
</div>
<div class="row">
    <div class="col-md-6"><?= $form->field($model, 'patronimico')->textInput() ?></div>
    <div class="col-md-6"><?= $form->field($model, 'matronimico')->textInput() ?></div>
</div>
  <div class="form-group">
      <?php

      if ($ajax) {
          AjaxSubmitButton::begin([
              'label' => 'Crea',
              'useWithActiveForm' => 'add-anag-form',
              'ajaxOptions' => [
                  'url' => 'index.php?r=anagrafica/create&via=ajax&fid=' . $fid,
                  'type' => 'POST',
                  'processData' => false, // Don't process the files
                  'contentType' => false, // Set content type to false as jQuery will tell the server its a query string request
                  'data' => new \yii\web\JsExpression("new FormData($('#add-anag-form')[0])"), // Do not stringify the form
                  'success' => new \yii\web\JsExpression("function(data) {
                             if (data.status == true)
                                {
                                    $('#add-anag-form').trigger('reset');
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
