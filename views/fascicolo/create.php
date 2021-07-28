<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Fascicolo */

$this->title = 'Create Fascicolo';
$this->params['breadcrumbs'][] = ['label' => 'Fascicolos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fascicolo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
