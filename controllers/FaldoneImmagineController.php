<?php

namespace app\controllers;

use Yii;
use app\models\FaldoneImmagine;
use app\search\FaldoneImmagineSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FaldoneImmagineController implements the CRUD actions for FaldoneImmagine model.
 */
class FaldoneImmagineController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all FaldoneImmagine models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FaldoneImmagineSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FaldoneImmagine model.
     * @param integer $faldone_id
     * @param integer $immagine_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($faldone_id, $immagine_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($faldone_id, $immagine_id),
        ]);
    }

    /**
     * Creates a new FaldoneImmagine model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FaldoneImmagine();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'faldone_id' => $model->faldone_id, 'immagine_id' => $model->immagine_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing FaldoneImmagine model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $faldone_id
     * @param integer $immagine_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($faldone_id, $immagine_id)
    {
        $model = $this->findModel($faldone_id, $immagine_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'faldone_id' => $model->faldone_id, 'immagine_id' => $model->immagine_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing FaldoneImmagine model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $faldone_id
     * @param integer $immagine_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($faldone_id, $immagine_id)
    {
        $this->findModel($faldone_id, $immagine_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FaldoneImmagine model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $faldone_id
     * @param integer $immagine_id
     * @return FaldoneImmagine the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($faldone_id, $immagine_id)
    {
        if (($model = FaldoneImmagine::findOne(['faldone_id' => $faldone_id, 'immagine_id' => $immagine_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
