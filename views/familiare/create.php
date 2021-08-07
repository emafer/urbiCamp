<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Familiare */

$this->title = Yii::t('app', 'Create Familiare');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Familiares'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="familiare-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
