<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Comune */
/* @var $ajax boolean */
/* @var $fid string */

$this->title = 'Crea Comune';
$this->params['breadcrumbs'][] = ['label' => 'Comuni', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php if ($ajax) {
?>
<div class="modal-header">
    <h4 class="modal-title">Creazione Comune</h4>
    <div class="text-right">
        <button type="button" id="closeModal" class="btn-close" data-dismiss="modal" aria-label="Close"><i class="glyphicon glyphicon-log-out"></i></button>
    </div>
</div><div class="modal-body">
    <?php
    }
    ?>
<div class="comune-create">

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
