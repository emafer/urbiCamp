<?php

namespace app\controllers;

use app\models\DocumentoImmagine;
use app\models\FascicoloImmagine;
use Yii;
use app\models\Immagine;
use app\search\ImmagineSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ImmagineController implements the CRUD actions for Immagine model.
 */
use yii\web\Controller;
class ImmagineController extends UrbiCampController
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
     * Lists all Immagine models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ImmagineSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Immagine model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if ($this->isAjax()) {

            return $this->renderAjax('view', [
                'model' => $this->findModel($id),
            ]);
        } else {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new Immagine model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Immagine();
        if (Yii::$app->request->post()) {
            $model->load(Yii::$app->request->post());
            $model->path = UploadedFile::getInstance($model, 'path');
            $model->upload();
            $model->save();
            if (
                $this->isAjax()) {
                $return = [
                    'status' => true,
                    'id_immagine' => $model->id
                ];
                switch (Yii::$app->request->post('targetModel')) {
                    case 'Fascicolo':
                        $Dimm = new FascicoloImmagine();
                        $Dimm->immagine_id = $model->id;
                        $Dimm->fascicolo_id = Yii::$app->request->post('mid');
                        $Dimm->ordine =1;
                        if ($Dimm->validate()) {
                            $Dimm->save();
                        } else {
                            $return['status'] = false;
                            $return['errors'] = $Dimm->errors;
                        }
                        break;
                        case 'Documento':
                        $Dimm = new DocumentoImmagine();
                        $Dimm->immagine_id = $model->id;
                        $Dimm->documento_id = Yii::$app->request->post('mid');
                        $Dimm->ordine =1;
                        if ($Dimm->validate()) {
                            $Dimm->save();
                        } else {
                            $return['status'] = false;
                            $return['errors'] = $Dimm->errors;
                        }
                        break;
                    default:
                        $return['status'] = false;
                        break;
                }
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return $this->asJson($return);
            } else {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        if ($this->isAjax()) {
            return $this->renderAjax('create', [
                'model' => $model,
                'ajax' => true,
                'mid' => Yii::$app->request->get('mid'),
                'targetModel' => Yii::$app->request->get('targetModel'),
            ]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'ajax' => false
        ]);
}
    }

    /**
     * Updates an existing Immagine model.
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
     * Deletes an existing Immagine model.
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
     * Finds the Immagine model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Immagine the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Immagine::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
