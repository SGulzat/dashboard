<?php

namespace backend\controllers;

use common\jobs\TaskAssignJob;
use common\models\Employees;
use common\models\TaskLevel;
use common\models\Tasks;
use Yii;
use common\models\TaskAssign;
use backend\models\TaskAssignSearch;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaskAssignController implements the CRUD actions for TaskAssign model.
 */
class TaskAssignController extends Controller
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
        $searchModel = new TaskAssignSearch();
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
     * @return string|\yii\web\Response
     * @throws \yii\db\Exception
     */
    public function actionCreate()
    {
        $model = new TaskAssign();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $task = Tasks::findOne(['id' => $model->task_id]);
            $taskLevel = TaskLevel::findOne(['id' => $task->level_id]);
            $employees = (new Query())
                ->select(['employees.id', 'developer_level.level_number AS level'])
                ->from('employees')
                ->innerJoin('developer_level', 'employees.level_id = developer_level.id')
                ->where(['department_id' => $task->department_id])
                ->all();

            $data = [
                'developers' => array_map(function($employee) {
                    return [
                        'id' => (int)$employee['id'],
                        'level' => (int)$employee['level'],
                    ];
                }, $employees),
                'task_id' => (int)$task->id,
                'task_level' => (int)$taskLevel->level_number,
            ];

            Yii::$app->queue->push(new TaskAssignJob([
                'taskAssignId' => $model->id,
                'url' => 'http://localhost:8080/assign-task',
                'data' => $data
            ]));

            Yii::$app->session->setFlash('success', 'Задача добавлено в очередь. Пожалуйста, подождите. Задача автоматически назначается сотруднику!');

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
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
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
}
