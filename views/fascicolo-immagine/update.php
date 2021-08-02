<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FascicoloImmagine */

$this->title = Yii::t('app', 'Update Fascicolo Immagine: {name}', [
    'name' => $model->fascicolo_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fascicolo Immagines'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fascicolo_id, 'url' => ['view', 'fascicolo_id' => $model->fascicolo_id, 'immagine_id' => $model->immagine_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="fascicolo-immagine-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
