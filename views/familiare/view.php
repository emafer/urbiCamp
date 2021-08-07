<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Familiare */

$this->title = $model->anagrafica_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Familiares'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="familiare-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'anagrafica_id' => $model->anagrafica_id, 'familiare_id' => $model->familiare_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'anagrafica_id' => $model->anagrafica_id, 'familiare_id' => $model->familiare_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'anagrafica_id',
            'familiare_id',
            'ruolo_id',
        ],
    ]) ?>

</div>
