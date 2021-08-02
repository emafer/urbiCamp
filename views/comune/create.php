<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Comune */

$this->title = 'Crea Comune';
$this->params['breadcrumbs'][] = ['label' => 'Comuni', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comune-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
