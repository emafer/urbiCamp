<?php

namespace app\controllers;

use Yii;
use app\models\Faldone;
use app\search\FaldoneSearch;
use yii\base\BaseObject;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FaldoneController implements the CRUD actions for Faldone model.
 */
class FaldoneController extends  UrbiCampController
{

    /**
     * Lists all Faldone models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FaldoneSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'archivio_id' => ''
        ]);
    }
    /**
     * Lists all Faldone models in archivio.
     * @return mixed
     */
    public function actionLista()
    {
        $archivio_id = Yii::$app->request->get('fondo');
        $searchModel = new FaldoneSearch(['archivio_id' => $archivio_id] );
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'archivio_id' => $archivio_id
        ]);
    }

    /**
     * Displays a single Faldone model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Faldone model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->request->get('archivio_id')) {
            $model = new Faldone(['archivio_id' => Yii::$app->request->get('archivio_id')]);
        } else{
            $model = new Faldone();
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['fascicolo/lista', 'faldone' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Faldone model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Faldone model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Faldone model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Faldone the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Faldone::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
