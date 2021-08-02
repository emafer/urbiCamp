<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class UrbiCampController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'ghost-access'=> [
                'class' => 'webvimark\modules\UserManagement\components\GhostAccessControl',
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