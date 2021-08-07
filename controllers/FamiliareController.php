<?php

namespace app\controllers;

use Yii;
use app\models\Familiare;
use yii\data\ActiveDataProvider;
use app\controllers\UrbiCampController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FamiliareController implements the CRUD actions for Familiare model.
 */
class FamiliareController extends UrbiCampController
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
     * Lists all Familiare models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Familiare::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Familiare model.
     * @param integer $anagrafica_id
     * @param integer $familiare_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($anagrafica_id, $familiare_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($anagrafica_id, $familiare_id),
        ]);
    }

    /**
     * Creates a new Familiare model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Familiare();
        if ($model->load(Yii::$app->request->post())) {
            $model->save();
            if ($model->ruolo->opposto) {
                $familiareN = new Familiare(
                    [
                        'anagrafica_id' => $model->familiare_id,
                        'familiare_id'  => $model->anagrafica_id,
                        'ruolo_id'  => $model->ruolo->opposto,
                        ]
                );
                $familiareN->save();
            }
            return $this->redirect(['view', 'anagrafica_id' => $model->anagrafica_id, 'familiare_id' => $model->familiare_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Familiare model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $anagrafica_id
     * @param integer $familiare_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($anagrafica_id, $familiare_id)
    {
        $model = $this->findModel($anagrafica_id, $familiare_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            if ($model->ruolo->opposto) {
                $familiareN = Familiare::findOne(
                    [
                        'anagrafica_id' => $model->familiare_id,
                        'familiare_id'  => $model->anagrafica_id,
                    ]
                );
                if (!$familiareN) {
                    $familiareN = new Familiare( [
                        'anagrafica_id' => $model->familiare_id,
                        'familiare_id'  => $model->anagrafica_id,
                        ]
                    );
                }

                $familiareN->ruolo_id  = $model->ruolo->opposto;

                $familiareN->save();
            } else {
                $familiareN = Familiare::findOne(
                    [
                        'anagrafica_id' => $model->familiare_id,
                        'familiare_id'  => $model->anagrafica_id,
                    ]
                );
                if ($familiareN) {
                    $familiareN->delete();
                }
            }
            return $this->redirect(['view', 'anagrafica_id' => $model->anagrafica_id, 'familiare_id' => $model->familiare_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Familiare model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $anagrafica_id
     * @param integer $familiare_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($anagrafica_id, $familiare_id)
    {
        $this->findModel($anagrafica_id, $familiare_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Familiare model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $anagrafica_id
     * @param integer $familiare_id
     * @return Familiare the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($anagrafica_id, $familiare_id)
    {
        if (($model = Familiare::findOne(['anagrafica_id' => $anagrafica_id, 'familiare_id' => $familiare_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
