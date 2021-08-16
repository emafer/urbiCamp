<?php

namespace app\controllers;

use Yii;
use app\models\DocumentoImmagine;
use app\search\DocumentoImmagineSearch;
use app\controllers\UrbiCampController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DocumentoImmagineController implements the CRUD actions for DocumentoImmagine model.
 */
class DocumentoImmagineController extends UrbiCampController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all DocumentoImmagine models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DocumentoImmagineSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DocumentoImmagine model.
     * @param integer $documento_id
     * @param integer $immagine_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($documento_id, $immagine_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($documento_id, $immagine_id),
        ]);
    }

    /**
     * Creates a new DocumentoImmagine model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DocumentoImmagine();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'documento_id' => $model->documento_id, 'immagine_id' => $model->immagine_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing DocumentoImmagine model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $documento_id
     * @param integer $immagine_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($documento_id, $immagine_id)
    {
        $model = $this->findModel($documento_id, $immagine_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'documento_id' => $model->documento_id, 'immagine_id' => $model->immagine_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing DocumentoImmagine model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $documento_id
     * @param integer $immagine_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($documento_id, $immagine_id)
    {
        $this->findModel($documento_id, $immagine_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DocumentoImmagine model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $documento_id
     * @param integer $immagine_id
     * @return DocumentoImmagine the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($documento_id, $immagine_id)
    {
        if (($model = DocumentoImmagine::findOne(['documento_id' => $documento_id, 'immagine_id' => $immagine_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
