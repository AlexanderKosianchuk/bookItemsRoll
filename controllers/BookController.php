<?php

namespace app\controllers;

use Yii;
use app\models\Book;
use app\models\BookSearch;
use app\models\Author;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yii\base\DynamicModel;

/**
 * BookController implements the CRUD actions for Book model.
 */
class BookController extends Controller
{
    public function behaviors()
    {
        return [
        	'access' => [
        		'class' => AccessControl::className(),
        		'rules' => [
        			[
        				'allow' => true,
        				'roles' => ['@'],
        			],
        		],
        	],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }
    
    /**
     * Lists all Book models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BookSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $authors = Author::find()->all();
        $dropDownSearchItems = ArrayHelper::map($authors,'id','lastname');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        	'dropDownSearchItems' => $dropDownSearchItems
        ]);
    }

    /**
     * Displays a single Book model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
    	$request = Yii::$app->request;
    	if ($request->isAjax) {
    		return $this->renderPartial('view', [
    				'model' => $this->findModel($id),
    		]);
    	} else {
	        return $this->render('view', [
	            'model' => $this->findModel($id),
	        ]);
    	}
    }

    /**
     * Creates a new Book model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Book();
        
        $returning = function() use ($model) {
        	$authors = Author::find()->all();
        	$dropDownSearchItems = ArrayHelper::map($authors,'id','lastname');

            return $this->render('create', [
                'model' => $model,
        		'dropDownAuthorItems' => $dropDownSearchItems
            ]);
        };
        
        if($model->load(Yii::$app->request->post())) {
	        $model->image = UploadedFile::getInstance($model, 'image');
	        if(is_object($model->image)) {
		        $preview = 'preview_img/' . uniqid() . '_' . $model->image->name;
		        $model->image->saveAs($preview);
		        $model->image = null;
		        $model->preview = '/' . $preview;
	        }
	        
        	if ($model->save()) {
            	return $this->redirect(['view', 'id' => $model->id]);
            } else {
            	return $returning();
           	}
        } else {
        	return $returning();
        }
    }

    /**
     * Updates an existing Book model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {   	
        $model = $this->findModel($id);
        
        $returning = function() use ($model) {
        	$authors = Author::find()->all();
        	$dropDownSearchItems = ArrayHelper::map($authors,'id','lastname');
        	 
        	return $this->render('update', [
        			'model' => $model,
        			'dropDownAuthorItems' => $dropDownSearchItems
        	]);
        };
        
        if($model->load(Yii::$app->request->post())) {
	        $model->image = UploadedFile::getInstance($model, 'image');
	        if(is_object($model->image)) {
		        $preview = 'preview_img/' . uniqid() . '_' . $model->image->name;
		        $model->image->saveAs($preview);
		        $model->image = null;
		        $model->preview = '/' . $preview;
	        }
        	 
        	if ($model->save()) {
        		return $this->redirect(['view', 'id' => $model->id]);
        	} else {
        		return $returning();
        	}
        } else {
        	return $returning();
        }
    }

    /**
     * Deletes an existing Book model.
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
     * Finds the Book model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Book the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Book::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
