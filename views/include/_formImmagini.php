<?php

use app\models\Immagine;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \yii\base\Model */
/* @var $form yii\widgets\ActiveForm */
/* @var $immagini array */
$numImg = 0;
foreach ($immagini as $immagine) {
    /** @var Immagine $immagine */

  ?>
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
                 <?= $form->field($immagine, 'path')->fileInput(['onchange' => 'getFileData(this);', 'name' =>'Immagini[' . $numImg . '][path]']) ?>
                <?= $form->field($immagine, 'nome')->textInput(['maxlength' => true, 'name' =>'Immagini[' . $numImg . '][path]']) ?>
                <?= $form->field($immagine, 'descrizione')->textInput(['maxlength' => true, 'name' =>'Immagini[' . $numImg . '][path]']) ?>
                <?= $form->field($immagine, 'lato')->dropDownList(['R' => 'R', 'V' => 'V', 'destra' => 'destra',
                    'sinistra' => 'sinistra', 'sotto' => 'sotto', 'sopra' => 'sopra', 'davanti' => 'davanti', 'dietro' => 'dietro'],['name' =>'Immagini[' . $numImg . '][path]']) ?>
                <input type="number" name="Immagini[<?php echo $numImg; ?>][ordinamento]" value="<?php echo $numImg+1; ?>">
            </div>
        </div>
    </div>
<?php
    $numImg++;
}