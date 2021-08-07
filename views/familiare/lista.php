<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $anagrafica \app\models\Anagrafica */
/* @var $anagrafica_id integer */

$this->title = Yii::t('app', 'Familiari di ' . $anagrafica->getNomeCompleto());
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="familiare-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p><?php

        if (!$anagrafica_id) {
            echo Html::a('Crea Familiare', ['create'], ['class' => 'btn btn-success']);
        } else {
            echo  Html::a('Crea Familiare', ['create', 'anagrafica' => $anagrafica_id], ['class' => 'btn btn-success']);
        }
        ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'familiare.nomeCompleto',
            'ruolo.ruolo',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
