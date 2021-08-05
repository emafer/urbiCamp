<?php

namespace app\controllers;

use app\models\InternatoCampo;
use Yii;
use app\models\Internato;
use app\search\InternatoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InternatoController implements the CRUD actions for Internato model.
 */
class InternatoController extends  UrbiCampController
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
     * Lists all Internato models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InternatoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Internato model.
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
     * Creates a new Internato model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Internato();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            var_dump(Yii::$app->request->post('InternatoCampo'));die;
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Internato model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            InternatoCampo::deleteAll(['internato_id' => $model->id]);
            $session = \Yii::$app->session;
            foreach (Yii::$app->request->post('InternatoCampo') as $newIntCamp) {
                if(!$newIntCamp['campo_id']) {
                    continue;
                }
                $dest = new InternatoCampo([
                    'internato_id' => $model->id,
                    'provenienza_da_id' => $newIntCamp['provenienza_da_id'],
                    'provenienza_da_campo_id' => $newIntCamp['provenienza_da_campo_id'],
                    'matricola' => $newIntCamp['matricola'],
                    'data_arrivo' => $newIntCamp['data_arrivo'],
                    'data_uscita' => $newIntCamp['data_uscita'],
                    'campo_id' => $newIntCamp['campo_id'],
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
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Internato model.
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
     * Finds the Internato model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Internato the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Internato::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
