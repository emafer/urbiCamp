<?php

namespace app\controllers;

use app\models\Destinatari;
use app\models\DocumentoInternato;
use app\models\Fascicolo;
use app\models\Interessato;
use app\models\Mittenti;
use Yii;
use app\models\Documento;
use app\search\DocumentoSearch;
use yii\db\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DocumentoController implements the CRUD actions for Documento model.
 */
class DocumentoController extends  UrbiCampController
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
     * Lists all Documento models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DocumentoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setSort([
            'defaultOrder' => [
                'data' => SORT_ASC
            ]]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Documento model.
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
     * Creates a new Documento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->request->get('fascicolo_id')) {
            $model = new Documento(['fascicolo_id' => Yii::$app->request->get('fascicolo_id')]);
            if ($model->fascicolo->internati) {
                $model->internati = $model->fascicolo->internati;
            }
        } else{
            $model = new Documento();
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                $session = \Yii::$app->session;
                $documentoPost = Yii::$app->request->post('Documento');
                $this->salvaDocInternati($documentoPost['internati'], $model, $session);
                $this->salvaDocDestinatari($documentoPost['destinatari'], $model, $session);
                $this->salvaDocMittenti($documentoPost['mittenti'], $model, $session);
                if (!$documentoPost['interessati']) {
                    $documentoPost['interessati'] = [];
                }
                $this->salvaDocInteressati($documentoPost['interessati'], $model, $session);
            }else {
                var_dump($model->errors);die;
                }

                return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Documento model.
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
            $documentoPost = Yii::$app->request->post('Documento');
            if (Yii::$app->request->post('cambiaDestinatari')) {
                Destinatari::deleteAll(['documento_id' => $model->id]);
               $this->salvaDocDestinatari($documentoPost['destinatari'], $model, $session);
            }
            if (Yii::$app->request->post('cambiaInternati')) {
                DocumentoInternato::deleteAll(['documento_id' => $model->id]);
                $this->salvaDocInternati($documentoPost['internati'], $model, $session);
            }
            if (Yii::$app->request->post('cambiaMittenti')) {
                Mittenti::deleteAll(['documento_id' => $model->id]);
                $this->salvaDocMittenti($documentoPost['mittenti'], $model, $session);
            }
            if (Yii::$app->request->post('cambiaInteressati')) {
                Interessato::deleteAll(['documento_id' => $model->id]);
                $this->salvaDocInteressati($documentoPost['interessati'], $model, $session);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Documento model.
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
     * Lists all Documento models in Fascicolo.
     * @return mixed
     */
    public function actionLista()
    {
        $searchModel = new DocumentoSearch(['fascicolo_id' => Yii::$app->request->get('fascicolo')] );
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setSort([
            'defaultOrder' => [
                'data' => SORT_ASC
            ]]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'fascicolo_id' => Yii::$app->request->get('fascicolo'),
            'fascicolo' => Fascicolo::findOne(['id' => Yii::$app->request->get('fascicolo')])
        ]);
    }
    /**
     * Finds the Documento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Documento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Documento::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    public function actionList($q = null, $id = null) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = new Query();
            $query->select('id, oggetto AS text')
                ->from('documento')
                ->where(['like', 'oggetto', $q])
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => Documento::find($id)->nomeCompleto];
        }
        return $out;
    }

    /**
     * @param $internati
     * @param Documento $model
     * @param $session
     */
    protected function salvaDocInternati($internati, Documento $model, $session): void
    {
        foreach ($internati as $idDaAbbinare) {
            $dest = new DocumentoInternato([
                'internato_id' => $idDaAbbinare,
                'documento_id' => $model->id
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
     * @param $destinatari
     * @param Documento $model
     * @param $session
     */
    protected function salvaDocDestinatari($destinatari, Documento $model, $session): void
    {
        foreach ($destinatari as $idDaAbbinare) {
            $dest = new Destinatari([
                'anagrafica_id' => $idDaAbbinare,
                'documento_id' => $model->id
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
     * @param $mittenti
     * @param Documento $model
     * @param $session
     */
    protected function salvaDocMittenti($mittenti, Documento $model, $session): void
    {
        foreach ($mittenti as $idDaAbbinare) {
            $dest = new Mittenti([
                'anagrafica_id' => $idDaAbbinare,
                'documento_id' => $model->id
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
     * @param $interessati
     * @param Documento $model
     * @param $session
     */
    protected function salvaDocInteressati($interessati, Documento $model, $session): void
    {
        foreach ($interessati as $idDaAbbinare) {
            $dest = new Interessato([
                'anagrafica_id' => $idDaAbbinare,
                'documento_id' => $model->id
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
