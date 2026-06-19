<?php

namespace app\controllers;

use app\models\Application;
use app\models\Feedback;
use app\models\Image;
use app\models\UploadForm;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * AccountController implements the CRUD actions for Application model.
 */
class AccountController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Application models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Application::find()->where(['user_id' => Yii::$app->user->id]),

            'pagination' => [
                'pageSize' => 5
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],

        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Application model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Application model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Application();
        $uploadForm = new UploadForm();
        $image = new Image();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                $uploadForm->imageFile = UploadedFile::getInstance($uploadForm, 'imageFile');
                if ($path = $uploadForm->upload()) {

                    $model->user_id = Yii::$app->user->id;
                    $model->status_id = 1;

                    if ($model->save()) {
                        $image->application_id = $model->id;
                        $image->path = $path;
                        $image->save();

                        Yii::$app->session->setFlash('success', 'Вы успешно создали заявку!');
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'uploadForm' => $uploadForm,
        ]);
    }

    /**
     * Updates an existing Application model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionFeedback($id)
    {
        $model = $this->findModel($id);
        $feedback = new Feedback();

        if ($this->request->isPost && $feedback->load($this->request->post())) {
            $feedback->application_id = $model->id;

            if ($feedback->save()) {
                Yii::$app->session->setFlash('success', 'Вы успешно оставили отзыв!');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('feedback', [
            'model' => $model,
            'feedback' => $feedback,
        ]);
    }

    /**
     * Finds the Application model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Application the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Application::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
