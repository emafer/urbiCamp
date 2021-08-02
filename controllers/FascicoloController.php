<?php

namespace app\controllers;

use app\models\Faldone;
use app\models\FaldoneImmagine;
use app\models\FascicoloInternato;
use app\models\Immagine;
use Yii;
use app\models\Fascicolo;
use app\search\FascicoloSearch;
use yii\base\BaseObject;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * FascicoloController implements the CRUD actions for Fascicolo model.
 */
class FascicoloController extends Controller
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
     * Lists all Fascicolo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FascicoloSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Fascicolo models in archivio.
     * @return mixed
     */
    public function actionLista()
    {
        $searchModel = new FascicoloSearch(['faldone_id' => Yii::$app->request->get('faldone')] );
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'faldone_id' => Yii::$app->request->get('faldone'),
            'faldone' => Faldone::findOne(Yii::$app->request->get('faldone'))
        ]);
    }
    /**
     * Displays a single Fascicolo model.
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
     * Creates a new Fascicolo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        if (Yii::$app->request->get('faldone_id')) {
            $model = new Fascicolo(['faldone_id' => Yii::$app->request->get('faldone_id')]);
        } else{
            $model = new Fascicolo();
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $session = \Yii::$app->session;
                $fascicoloPost = Yii::$app->request->post('Fascicolo');
                $this->salvaFascInternati($fascicoloPost['internati'], $model, $session);
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }

    /**
     * Updates an existing Fascicolo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {
            $session = \Yii::$app->session;
            if (Yii::$app->request->post('cambiaInternati')) {
                FascicoloInternato::deleteAll(['fascicolo_id' => $model->id]);
                $fascicoloPost = Yii::$app->request->post('Fascicolo');
                $this->salvaFascInternati($fascicoloPost['internati'], $model, $session);
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model
        ]);
    }

    /**
     * Deletes an existing Fascicolo model.
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
     * Finds the Fascicolo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Fascicolo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Fascicolo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionFascicoloImmagine($id)
    {
        $model = FaldoneImmagine::findOne($id);
    }
    /**
     * @param $internati
     * @param Fascicolo $model
     * @param $session
     */
    protected function salvaFascInternati($internati, Fascicolo $model, $session): void
    {
        foreach ($internati as $idDaAbbinare) {
            $dest = new FascicoloInternato([
                'internato_id' => $idDaAbbinare,
                'fascicolo_id' => $model->id
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
