<?php

namespace app\controllers;

use Yii;
use app\models\AnnouncedPuResults;
use app\models\PollingUnit;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AnnouncedPuResultsController implements the CRUD actions for AnnouncedPuResults model.
 */
class AnnouncedPuResultsController extends Controller
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
     * Lists all AnnouncedPuResults models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => AnnouncedPuResults::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AnnouncedPuResults model.
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
     * Creates a new AnnouncedPuResults model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {    
        $model = new AnnouncedPuResults();


        if ($model->load(Yii::$app->request->post())) {
             echo "<pre>";
            var_dump($model);
            echo "</pre>";
            die();
            return $this->redirect(['view', 'id' => $model->result_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

     public function actionNew()
    {
        $model = new AnnouncedPuResults();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->result_id]);
        } else {
            return $this->render('new', [
                'model' => $model,
            ]);
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


     public function actionLists($id){                        
        
        $results = AnnouncedPuResults::find()->where(['polling_unit_uniqueid' => $id])->all();
 
        if (!empty($results)) {           

            foreach($results as $result) {
                echo "<li>".$result->party_abbreviation." : ".$result->party_score."</li>"
                ;
            }
        } else {
            echo "<li>nothing</li>";
        }
    }
    
    public function actionAdd($id){ 
                       
        $polls = PollingUnit::find()->where(['lga_id' => $id])->all();

        if (!empty($polls)) {
             foreach ($polls as $poll) {
                  $added = AnnouncedPuResults::find()->where(['polling_unit_uniqueid' => $poll])->all();
                  if (!empty($added)) {
                    
                   foreach ($added as $key ) {

               $rows = AnnouncedPuResults::findBySql("SELECT party_abbreviation, SUM(party_score) FROM announced_pu_results WHERE polling_unit_uniqueid = $key->polling_unit_uniqueid GROUP BY party_abbreviation ")->all();
                     foreach ($rows as $row) {
                          echo "<pre>";
                         var_dump($row);
                         echo "</pre>";
                      } 
              
                   }
               }
           }
       }

       else
       {
        echo "<li>nothing</li>";
       }    
    }



    /**
     * Updates an existing AnnouncedPuResults model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->result_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AnnouncedPuResults model.
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
     * Finds the AnnouncedPuResults model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AnnouncedPuResults the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AnnouncedPuResults::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
