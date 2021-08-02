<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@tests' => '@app/tests',
    ],
    'modules'=>[
        'user-management' => [
            'class' => 'webvimark\modules\UserManagement\UserManagementModule',
            'controllerNamespace'=>'vendor\webvimark\modules\UserManagement\controllers', // To prevent yii help from crashing
        ],

        'media' => [
            'class' => 'wdmg\media\Module',
            'routePrefix' => '/',
            'mediaRoute' => '/web/uploads', // Routes to render media item (use "/" - for root)
            'mediaCategoriesRoute' => '/media/categories', // Routes to render media categories (use "/" - for root)
            'mediaPath' => 'uploads', // Path to save media files in @webroot
            'mediaThumbsPath' => 'uploads/_thumbs', // Path to save media thumbnails in @webroot
            'maxFilesToUpload' => 10, // maximum files to upload
            'maxUploadSize' => 5242880, // max file size in bytes to upload
            'allowedMime' => [ // allowed mime types
                'image/png' => true,
                'image/jpeg' => true,
                'image/gif' => true,
                'image/svg+xml' => true,
                'application/pdf' => true,
                'application/msword' => true,
                'application/vnd.ms-excel' => true,
                'application/rtf' => true,
                'text/csv' => true,
                'text/plain' => true,
            ]
        ],
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
    ],
    'params' => $params,
    /*
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
    ],
    */
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
