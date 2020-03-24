<?php
namespace app\controllers;

use app\models\Post;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\HttpException;
use yii\filters\VerbFilter;

class PostController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['create','update'],
                'rules' => [
                    //allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    //everything else denied
                ],
            ],
        ];
    }
    public function actionCreate()
    {
        $model = new Post;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Post has been updated.')); //updated
            return $this->redirect(['update', 'id' => $model->id]);
        } elseif (!\Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->get());
            $model->tag_ids = ArrayHelper::map($model->tags, 'name', 'name');
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Post has been updated.'));
            return $this->redirect(['update', 'id' => $model->id]);
        } elseif (!\Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->get());
            $model->tag_ids = ArrayHelper::map($model->tags, 'name', 'name');
        }

        return $this->render('update', ['model' => $model]);
    }

    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        }
        throw new HttpException(404, 'The requested page does not exist.');
    }
}