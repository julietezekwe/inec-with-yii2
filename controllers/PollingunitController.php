<?php

namespace app\controllers;

use Yii;
use app\models\PollingUnit;
use app\models\AnnouncedPuResults;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PollingunitController implements the CRUD actions for PollingUnit model.
 */
class PollingunitController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all PollingUnit models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => PollingUnit::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PollingUnit model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PollingUnit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PollingUnit();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->uniqueid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }


    public function actionNew()
    {
        $model = new PollingUnit();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->uniqueid]);
        } else {
            return $this->render('new', [
                'model' => $model,
            ]);
        }
    }

   

    public function actionLists($id){ 
                       
        
        $units = PollingUnit::find()->where(['lga_id' => $id])->all();
 
        if (!empty($units)) {

            foreach($units as $unit) {
                echo "<option value='".$unit->uniqueid."'>".$unit->polling_unit_name."</option>";
            }
        } else {
            echo "<option>-</option>";
        }        
 
    }
public function actionAdd($id){ 
                       
        
        $results = PollingUnit::find()->where(['lga_id' => $id])->all();
 
        if (!empty($results)) { 

            var_dump($results);
            die();

        } else {
            echo "<li>nothing</li>";
        }

       

        
 
    }

    public function actionSum()
    {
        $model = new AnnouncedPuResults();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->result_id]);
        } else {
            return $this->render('sum', [
                'model' => $model,
            ]);
        }
    }


    /**
     * Updates an existing PollingUnit model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->uniqueid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PollingUnit model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PollingUnit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PollingUnit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PollingUnit::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
