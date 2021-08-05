<?php

/* @var $this yii\web\View */

use app\search\DocumentoSearch;

$this->title = 'Casa della memoria di Urbisaglia';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Il progetto</h1>
</div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Documenti</h2>

                <p>Al momento sono presenti <?php
                    $searchModel = new DocumentoSearch();
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                    echo $dataProvider->count; ?> documenti</p>

                <p><a class="btn btn-default" href="/?r=documento">Documenti &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Internati</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="/?r=internato">Internati &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Archivi</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>



                <p><a class="btn btn-default" href="/?r=archivio">Archivio &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
