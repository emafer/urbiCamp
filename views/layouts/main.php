<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use webvimark\modules\UserManagement\UserManagementModule;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => '/index.php?r=site%2Findex',
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $items = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'Documenti',
            'items' => [
                ['label' => 'Documenti', 'url' => ['/documento/index']],
                ['label' => 'Fotografie', 'url' => ['/fotografia/index']]
            ]],
        ['label' => 'Archivi',
            'items' =>[
                ['label' => 'Fondi', 'url' => ['/archivio']],
                ['label' => 'Buste', 'url' => ['/faldone']],
                ['label' => 'Fascicoli', 'url' => ['/fascicolo']],
                ['label' => 'Tipologie', 'url' => ['/tipologia']],
                ['label' => 'Campi', 'url' => ['/campo']],
            ]
        ],
        ['label' => 'Anagrafiche',
            'items' => [
                    ['label' => 'Anagrafiche', 'url' => ['/anagrafica/index']],
                    ['label' => 'Internati', 'url' => ['/internato/index']]
            ]
        ],
    ];
    if (Yii::$app->user->isGuest) {
        $items[] =  ['label' => 'Login', 'url' => ['/user-management/auth/login']];
    } else {
        $sub = UserManagementModule::menuItems();
        $sub[] = ['label' => 'Logout', 'url' => ['/user-management/auth/logout']];
        $items[] =  [
            'label' => 'User',
            'items'=> $sub
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $items
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">

    <div class="modal remote fade" id="modalAnagCreate">
        <div class="modal-dialog">
            <div class="modal-content  loader-lg"> <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div></div>
        </div>
    </div>
    <div class="modal remote fade" id="modalCreate">
        <div class="modal-dialog">
            <div class="modal-content  loader-lg"> <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div></div>
        </div>
    </div>

    <div class="container">
        <p class="pull-left">&copy; Casa della Memoria - Urbisaglia <?= date('Y') ?></p>

    </div>
</footer>
<script src="/js/imageForm.js"></script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
