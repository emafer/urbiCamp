<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Anagrafica */
/* @var $ajax boolean */

$this->title = 'Update Anagrafica: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Anagrafiche', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Aggiorna';
?>
<?php if ($ajax) {
?>
    <div class="modal-header">
        <h5 class="modal-title">Aggiornamento Anagrafica</h5>
        <div class="text-right">
            <button type="button" id="closeModal" class="btn-close" data-dismiss="modal" aria-label="Close"><i class="glyphicon glyphicon-log-out"></i></button>
        </div>
    </div><div class="modal-body">
    <?php
    }
    ?>
    <div class="anagrafica-update">

        <h1><?= Html::encode($this->title) ?></h1>

        <?= $this->render('_form', [
            'model' => $model,
            'ajax' => $ajax
        ]) ?>

    </div>
    <?php if ($ajax) {
    ?>
</div>
<?php
}
?>
