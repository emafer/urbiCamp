<?php

use app\models\Immagine;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \yii\base\Model */
/* @var $form yii\widgets\ActiveForm */
foreach ($model->getImmagines() as $key => $linkImmagine) {
    $immagine = new Immagine($linkImmagine->immagine_id);
  ?>
    <div class="row">
        <div class="immagine-form">
            <div class="col-md-3">
                <div id="preview">
                    <?php
                    if ($model->path) {
                        echo '<img src="/uploads/' . $immagine->path . '" width="300">';
                    }
                    ?>
                </div>
            </div>
            <div class="col-md-9">
                <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($immagine, 'path')->fileInput(['onchange' => 'getFileData(this);']) ?>
                <?= $form->field($immagine, 'nome')->textInput(['maxlength' => true]) ?>
                <?= $form->field($immagine, 'descrizione')->textInput(['maxlength' => true]) ?>
                <?= $form->field($immagine, 'lato')->dropDownList(['R' => 'R', 'V' => 'V', 'destra' => 'destra',
                    'sinistra' => 'sinistra', 'sotto' => 'sotto', 'sopra' => 'sopra', 'davanti' => 'davanti', 'dietro' => 'dietro']) ?>
                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
<?php
}