<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Anagrafica */
/* @var $ajax boolean */
/* @var $fid string */

$this->title = 'Crea Anagrafica';
$this->params['breadcrumbs'][] = ['label' => 'Anagraficas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if ($ajax) {
   ?>
<div class="modal-header">
    <h5 class="modal-title">Creazione anagrafica</h5>
    <div class="text-right">
        <button type="button" id="closeModal" class="btn-close" data-dismiss="modal" aria-label="Close"><i class="glyphicon glyphicon-log-out"></i></button>
    </div>
</div><div class="modal-body">
<?php
}
?>
<div class="anagrafica-create">
<?php if (!$ajax) { ?>
    <h1><?= Html::encode($this->title) ?></h1>
<?php } ?>
    <?= $this->render('_form', [
        'model' => $model,
        'ajax' => $ajax,
        'fid' => $fid ?? ''
    ]) ?>

</div>
    <?php if ($ajax) {
    ?>
</div>
<?php
        }
        ?>
