<?php

namespace frontend\controllers;

use common\models\Department;
use common\models\TaskLevel;
use common\models\Tasks;
use frontend\models\TaskCommentForm;
use Yii;
use common\models\TaskAssign;
use frontend\models\MyTasksSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MyTasksController implements the CRUD actions for TaskAssign model.
 */
class MyTasksController extends Controller
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
     * Lists all TaskAssign models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MyTasksSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TaskAssign model.
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
     * Creates a new TaskAssign model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TaskAssign();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TaskAssign model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $taskAssign = TaskAssign::findOne($id);

        if (!$taskAssign) {
            throw new NotFoundHttpException();
        }

        $model = Tasks::findOne($taskAssign->task_id);
        if (!$model) {
            throw new NotFoundHttpException();
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Статус успешно обновлен!');
            return $this->redirect(['index']);
        }

        $departments = Department::find()->asArray()->all();
        $departments = ArrayHelper::map($departments, 'id', 'name');

        $taskLevels = TaskLevel::find()->asArray()->all();
        $taskLevels = ArrayHelper::map($taskLevels, 'level_number', 'name');

        $taskCommentForm = new TaskCommentForm();

        return $this->render('update', [
            'model' => $model,
            'departments' => $departments,
            'taskLevels' => $taskLevels,
            'taskCommentForm' => $taskCommentForm
        ]);
    }

    /**
     * Deletes an existing TaskAssign model.
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
     * Finds the TaskAssign model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TaskAssign the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TaskAssign::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }

    /**
     * Displays a single TaskAssign model.
     * @param integer $task_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionTaskView($task_id)
    {
        $model = Tasks::findOne($task_id);
        if (!$model) {
            throw new NotFoundHttpException();
        }

        return $this->render('task-view', [
            'model' => $model
        ]);
    }

    /**
     * @return \yii\web\Response
     * @throws \yii\db\Exception
     */
    public function actionAddComment()
    {
        $model = new TaskCommentForm();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Контент успешно сохранен!');
            return $this->redirect($this->request->referrer);
        }
    }
}
