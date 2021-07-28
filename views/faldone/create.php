<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Faldone */

$this->title = 'Create Faldone';
$this->params['breadcrumbs'][] = ['label' => 'Faldones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faldone-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
