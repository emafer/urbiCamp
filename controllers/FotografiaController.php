<?php

namespace app\controllers;

use app\models\DocumentoInternato;
use app\models\FotografiaAnagrafica;
use app\models\FotografiaInternato;
use app\models\Immagine;
use app\models\Interessato;
use Yii;
use app\models\DocumentazioneFotografica;
use app\search\FotograficaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * FotografiaController implements the CRUD actions for DocumentazioneFotografica model.
 */
class FotografiaController extends UrbiCampController
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
     * Lists all DocumentazioneFotografica models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FotograficaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DocumentazioneFotografica model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new DocumentazioneFotografica model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DocumentazioneFotografica();

        if ($model->load(Yii::$app->request->post())) {
            $immagine = new Immagine(Yii::$app->request->post('Immagine'));
            $immagine->path = UploadedFile::getInstance($immagine, 'path');
            $immagine->upload();
            $immagine
                ->save();
            $model->immagine_id = $immagine->id;
            $model->save();
            $session = \Yii::$app->session;
            $documentoPost = Yii::$app->request->post('DocumentazioneFotografica');
            if (Yii::$app->request->post('cambiaInternati')) {
                $this->salvaFotoInternati($documentoPost['internati'], $model, $session);
            }
            if (Yii::$app->request->post('cambiaInteressati')) {
                $this->salvaFotoInteressati($documentoPost['interessati'], $model, $session);
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'immagine' => new Immagine(),
        ]);
    }

    /**
     * Updates an existing DocumentazioneFotografica model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $session = \Yii::$app->session;
            $documentoPost = Yii::$app->request->post('DocumentazioneFotografica');
            if (Yii::$app->request->post('cambiaInternati')) {
                FotografiaInternato::deleteAll(['fotografia_id' => $model->id]);
                $this->salvaFotoInternati($documentoPost['internati'], $model, $session);
            }
            if (Yii::$app->request->post('cambiaInteressati')) {
                FotografiaAnagrafica::deleteAll(['fotografia_id' => $model->id]);
                $this->salvaFotoInteressati($documentoPost['interessati'], $model, $session);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing DocumentazioneFotografica model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        FotografiaInternato::deleteAll(['fotografia_id' => $model->id]);
        FotografiaAnagrafica::deleteAll(['fotografia_id' => $model->id]);
        $model->delete();
        $model->immagine->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DocumentazioneFotografica model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DocumentazioneFotografica the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DocumentazioneFotografica::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /**
     * @param $interessati
     * @param DocumentazioneFotografica $model
     * @param $session
     */
    protected function salvaFotoInteressati($interessati, DocumentazioneFotografica $model, $session): void
    {
        foreach ($interessati as $idDaAbbinare) {
            $dest = new FotografiaAnagrafica([
                'anagrafica_id' => $idDaAbbinare,
                'fotografia_id' => $model->id
            ]);
            if (!$dest->save()) {
                $session->addFlash('1',
                    [
                        'type' => 'error',
                        'msg' => 'Qualcosa &egrave; andato storto nel salvataggio...',
                    ]
                );
            };
        }
    }

    /**
     * @param $internati
     * @param DocumentazioneFotografica $model
     * @param $session
     */
    protected function salvaFotoInternati($internati, DocumentazioneFotografica $model, $session): void
    {
        foreach ($internati as $idDaAbbinare) {
            $dest = new FotografiaInternato([
                'internato_id' => $idDaAbbinare,
                'fotografia_id' => $model->id
            ]);
            if (!$dest->save()) {
                $session->addFlash('1',
                    [
                        'type' => 'error',
                        'msg' => 'Qualcosa &egrave; andato storto nel salvataggio...',
                    ]
                );
            };
        }
    }
}
