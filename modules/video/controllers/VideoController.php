<?php

namespace app\modules\video\controllers;

use app\modules\job\RuTubeVideo;
use app\modules\job\VimeoVideo;
use app\modules\job\YandexVideo;
use app\modules\job\YouTubeVideo;
use Yii;
use app\modules\video\models\Video;
use app\modules\video\models\VideoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VideoController implements the CRUD actions for Video model.
 */
class VideoController extends Controller
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
     * Lists all Video models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VideoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Video model.
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
     * Creates a new Video model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $video = new \app\modules\job\Video();

        if(!empty(Yii::$app->request->post()) && $video->setParams(Yii::$app->request->post()) && $video->save()){
            return $this->redirect(['view', 'id' => $video->getModel()->id]);
        } else {
            return $this->render('create', [
                'model' => new Video(),
            ]);
        }
    }

    /**
     * Updates an existing Video model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $video = new \app\modules\job\Video();
        $model = $this->findModel($id);
        $video->setModel($model);

        if(!empty(Yii::$app->request->post()) && $video->setParams(Yii::$app->request->post()) && $video->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Video model.
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
     * Finds the Video model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Video the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Video::findOne($id)) !== null) {
            switch ($model->source){
                case 'youtube' : $model = YouTubeVideo::findOne($id); break;
                case 'rutube' : $model = RuTubeVideo::findOne($id); break;
                case 'vimeo' : $model = VimeoVideo::findOne($id); break;
                case 'yandex' : $model = YandexVideo::findOne($id); break;
            }
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
