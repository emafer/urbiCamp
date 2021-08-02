<?php

namespace app\controllers;

use Yii;
use app\models\FascicoloImmagine;
use app\search\FascicoloImmagineSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FascicoloImmagineController implements the CRUD actions for FascicoloImmagine model.
 */
class FascicoloImmagineController extends Controller
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
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all FascicoloImmagine models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FascicoloImmagineSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FascicoloImmagine model.
     * @param integer $fascicolo_id
     * @param integer $immagine_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($fascicolo_id, $immagine_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($fascicolo_id, $immagine_id),
        ]);
    }

    /**
     * Creates a new FascicoloImmagine model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FascicoloImmagine();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'fascicolo_id' => $model->fascicolo_id, 'immagine_id' => $model->immagine_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing FascicoloImmagine model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $fascicolo_id
     * @param integer $immagine_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($fascicolo_id, $immagine_id)
    {
        $model = $this->findModel($fascicolo_id, $immagine_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'fascicolo_id' => $model->fascicolo_id, 'immagine_id' => $model->immagine_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing FascicoloImmagine model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $fascicolo_id
     * @param integer $immagine_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($fascicolo_id, $immagine_id)
    {
        $this->findModel($fascicolo_id, $immagine_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FascicoloImmagine model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $fascicolo_id
     * @param integer $immagine_id
     * @return FascicoloImmagine the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($fascicolo_id, $immagine_id)
    {
        if (($model = FascicoloImmagine::findOne(['fascicolo_id' => $fascicolo_id, 'immagine_id' => $immagine_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
