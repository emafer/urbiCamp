<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\FascicoloImmagine */

$this->title = $model->fascicolo_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fascicolo Immagines'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="fascicolo-immagine-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'fascicolo_id' => $model->fascicolo_id, 'immagine_id' => $model->immagine_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'fascicolo_id' => $model->fascicolo_id, 'immagine_id' => $model->immagine_id], [
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
            'fascicolo_id',
            'immagine_id',
            'ordine',
        ],
    ]) ?>

</div>
