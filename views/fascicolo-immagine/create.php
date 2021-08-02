<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FascicoloImmagine */

$this->title = Yii::t('app', 'Create Fascicolo Immagine');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fascicolo Immagines'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fascicolo-immagine-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
