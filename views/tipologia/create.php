<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tipologia */
/* @var $ajax boolean */
/* @var $fid string */

$this->title = Yii::t('app', 'Create Tipologia');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tipologias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php if ($ajax) {
?>
<div class="modal-header">
    <div class="text-right">
        <button type="button" id="closeModal" class="btn-close" data-dismiss="modal" aria-label="Close"><i class="glyphicon glyphicon-log-out"></i></button>
    </div>
</div><div class="modal-body">
    <?php
    }
    ?>
<div class="tipologia-create">

    <h1><?= Html::encode($this->title) ?></h1>
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