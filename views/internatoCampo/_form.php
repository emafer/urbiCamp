<?php

/* @var $this yii\web\View */
/* @var $item app\models\InternatoCampo */
/* @var $form yii\widgets\ActiveForm */
/* @var $k integer */
/* @var $campi array */
/* @var $new boolean */
$numero = $k+1;
?>
<div class="container border-dark" style="border: 1px solid; margin-bottom: 5px">
<div class="row">
    <div class="col-md-4">
    </div>
    <div class="col-md-4 text-center">
        <?php if ($new) { echo '<h3>Aggiungi</h3>'; }   ?>
    <?= $form->field($item, 'campo_id')->dropDownList($campi, ['prompt' =>'',
        'name' => 'InternatoCampo[' . $numero .'][campo_id]',
        'id' => 'InternatoCampo_' . $numero .'_campo_id'
            ]
    ) ?>
    </div>
<div class="col-md-4">
</div>
</div>
<div class="row">
<div class="col-md-4">
<?php
\app\commands\HelperUrbiCampFormController::creaSelect2Comuni($form, $item, 'provenienza_da_id', '',
    'InternatoCampo[' . $numero .'][provenienza_da_id]',
    'InternatoCampo_' . $numero .'_provenienza_da_id');
echo $form->field($item, 'provenienza_da_campo_id')->dropDownList($campi, ['prompt' =>'',
    'name' => 'InternatoCampo[' . $numero .'][provenienza_da_campo_id]',
    'id' => 'InternatoCampo_' . $numero .'_provenienza_da_campo_id'
]);
echo '
</div>
    <div class="col-md-4">' . $form->field($item, 'matricola')->textInput(['maxlength' => true,
        'name' => 'InternatoCampo[' . $numero .'][matricola]',
        'id' => 'InternatoCampo_' . $numero .'matricola']) . '</div>
    <div class="col-md-4">' . $form->field($item, 'data_arrivo')->textInput([
            'type' => 'date',
        'name' => 'InternatoCampo[' . $numero .'][data_arrivo]',
        'id' => 'InternatoCampo_' . $numero .'data_arrivo']) .
    $form->field($item, 'data_uscita')->textInput([
        'type' => 'date',
        'name' => 'InternatoCampo[' . $numero .'][data_uscita]',
        'id' => 'InternatoCampo_' . $numero .'data_uscita']) .'</div>
</div>';
?></div>