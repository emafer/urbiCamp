<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Archivio */

$this->title = 'Create Archivio';
$this->params['breadcrumbs'][] = ['label' => 'Archivios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="archivio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
