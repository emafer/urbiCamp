<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Immagine */

$this->title = 'Create Immagine';
$this->params['breadcrumbs'][] = ['label' => 'Immagines', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="immagine-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
