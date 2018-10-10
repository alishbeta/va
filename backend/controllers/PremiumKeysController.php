<?php

namespace backend\controllers;

use common\models\Filehostings;
use common\models\Servers;
use Yii;
use common\models\PremiumKeys;
use common\models\PremiumKeysSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PremiumKeysController implements the CRUD actions for PremiumKeys model.
 */
class PremiumKeysController extends Controller
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
     * Lists all PremiumKeys models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PremiumKeysSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PremiumKeys model.
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
     * Creates a new PremiumKeys model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PremiumKeys();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $fh = ArrayHelper::map(Filehostings::find()->asArray()->all(), 'id', 'name');
        $s_id = ArrayHelper::map(Servers::find()->asArray()->all(),'id', 'ip');

        return $this->render('create', [
            'model' => $model,
            'fh' => $fh,
            's_id' => $s_id,
        ]);
    }

    /**
     * Updates an existing PremiumKeys model.
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

        $fh = ArrayHelper::map(Filehostings::find()->asArray()->all(), 'id', 'name');
        $s_id = ArrayHelper::map(Servers::find()->asArray()->all(),'id', 'ip');

        return $this->render('update', [
            'model' => $model,
            'fh' => $fh,
            's_id' => $s_id,
        ]);
    }

    /**
     * Deletes an existing PremiumKeys model.
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
     * Finds the PremiumKeys model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PremiumKeys the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PremiumKeys::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
