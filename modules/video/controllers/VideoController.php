<?php

namespace app\modules\video\controllers;

use Yii;
use app\modules\video\models\Video;
use app\modules\video\models\VideoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
// include composer autoload
//use yii\helpers\Html;
// import the Intervention Image Manager Class

// configure with favored image driver (gd by default)


/**
 * VideoController implements the CRUD actions for Video model.
 */
class VideoController extends DefaultController {

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
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
        $model = new Video();

        if ($model->load(Yii::$app->request->post()))
        {
            $file = UploadedFile::getInstance($model, 'origin_img');

            if (!empty($file))
            {
                $filename = uniqid() . '.' . $file->extension;
                $path = 'uploads/' . $filename;
                if ($file->saveAs($path))
                {
                    $model->origin_img = $filename;
                    
                    $model->saveImage($filename);
            
                    $model->small_img = 'small_' . $filename;
                    $model->big_img = 'big_' . $filename;
                }
            }
            
            
            $file = UploadedFile::getInstance($model, 'trailer');
            if (!empty($file))
            {
                $filename = uniqid() . '.' . $file->extension;
                $path = 'uploads/' . $filename;
                if ($file->saveAs($path))
                {
                    $model->trailer = $filename;
                }
            }
            
            if ($model->save())
            {
                return $this->redirect(['index']);
            }
            else
            {
                \Yii::$app->getSession()->setFlash('error', 'Не удалось загрузить');
            }
        }
        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Video model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $oldFile = 'uploads/' . $model->origin_img;
        $oldTrailer = 'uploads/' . $model->trailer;
        
        $oldFile_name = $model->origin_img;
        $oldTrailer_name = $model->trailer;
        
        if ($model->load(Yii::$app->request->post()))
        {

            $file = UploadedFile::getInstance($model, 'origin_img');
            if (isset($file))
            {
                if (file_exists($oldFile))
                {
                    @unlink('uploads/' . $oldFile_name);
                    @unlink('uploads/small_' . $oldFile_name);
                    @unlink('uploads/big_' . $oldFile_name);
                }
                $filename = uniqid() . '.' . $file->extension;
                $path = 'uploads/' . $filename;
                if ($file->saveAs($path))
                {
                    $model->origin_img = $filename;
                    $model->saveImage($filename);
                    $model->small_img = 'small_' . $filename;
                    $model->big_img = 'big_' . $filename;
                }
            }
           else 
                $model->origin_img = $oldFile_name;
            
        
      
            $file = UploadedFile::getInstance($model, 'trailer');
            if (isset($file))
            {
                if (file_exists($oldTrailer))
                {
                    @unlink('uploads/' . $oldTrailer_name);
                }
                $filename = uniqid() . '.' . $file->extension;
                $path = 'uploads/' . $filename;
                if ($file->saveAs($path))
                {
                    $model->trailer = $filename;
                }
            }
            else 
                $model->trailer = $oldTrailer_name;
            
            if ($model->save())
            {
                return $this->redirect(['index']);
            }
            else
            {
                \Yii::$app->getSession()->setFlash('error', 'Не удалось загрузить');
            }
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Video model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        @unlink('uploads/' . $model->origin_img);
        @unlink('uploads/' . $model->small_img);
        @unlink('uploads/' . $model->big_img);
        @unlink('uploads/' . $model->trailer);
        $model->delete();
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
        if (($model = Video::findOne($id)) !== null)
        {
            return $model;
        }
        else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
