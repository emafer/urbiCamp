<?php

namespace app\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;

class UrbiCampController extends Controller
{
    public array $freeAccessActions = [];
    public function __construct($id, $module, $config = [])
    {
        if ($_SERVER['HTTP_HOST'] == 'urbicamp.it') {
            $this->freeAccessActions = ['index', 'lista', 'view', 'list'];
        }
        parent::__construct($id, $module, $config);
    }

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