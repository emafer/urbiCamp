<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Immagine */
/* @var $ajax boolean */
/* @var $targetModel string */
/* @var $mid integer */

$this->title = 'Create Immagine';
$this->params['breadcrumbs'][] = ['label' => 'Immagines', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?> <div class="modal-header">
    <h5 class="modal-title">Modal title</h5>
    <div class="text-right">
        <button type="button" id="closeModal" class="btn-close" data-dismiss="modal" aria-label="Close"><i class="glyphicon glyphicon-log-out"></i></button>
    </div>
</div><div class="modal-body">
<div class="immagine-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'ajax' => $ajax,
        'mid' => $ajax? $mid : '',
        'targetModel' => $ajax? $targetModel: '',
    ]) ?>

</div>
</div>
