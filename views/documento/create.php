<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Documento */

$this->title = Yii::t('app', 'Create Documento');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Documentos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documento-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
