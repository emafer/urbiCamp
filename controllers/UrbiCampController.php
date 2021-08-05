<?php

namespace app\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;

class UrbiCampController extends Controller
{

    public $freeAccessActions = ['index', 'lista', 'view', 'list'];
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'ghost-access'=> [
                'class' => 'webvimark\modules\UserManagement\components\GhostAccessControl',
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    /**
     * @return bool
     */
    protected function isAjax(): bool
    {
        return Yii::$app->request->get('via') && Yii::$app->request->get('via') == 'ajax';
    }
}