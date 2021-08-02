<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Internato */

$this->title = Yii::t('app', 'Create Internato');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Internatos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="internato-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
