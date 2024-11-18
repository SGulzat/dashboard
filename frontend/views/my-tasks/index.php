<?php

use common\widgets\Panel;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MyTasksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Мои задачи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-assign-index">

    <?php Panel::begin([
        'title' => $this->title
    ])?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'format' => 'text',
                'headerOptions' => ['style' => 'width:5%'],
            ],
            [
                'attribute' => 'task_id',
                'format' => 'html',
                'value' => function (\common\models\TaskAssign $model) {
                    $task = \common\models\Tasks::findOne($model->task_id);
                    return $task ? $task->name : 'Задача не указан';
                }
            ],
            [
                'attribute' => 'employee_id',
                'format' => 'html',
                'value' => function (\common\models\TaskAssign $model) {

                    $employee = \common\models\Employees::findOne($model->employee_id);
                    return $employee ? $employee->full_name : 'Сотрудник еще не назначен!';
                }
            ],
            [
                'attribute' => 'execute_status',
                'label' => 'Статус выполнение',
                'format' => 'html',
                'value' => function (\common\models\TaskAssign $model) {
                    $class = 'label-info';

                    $task = \common\models\Tasks::findOne($model->task_id);
                    if ($task) {

                        if ($task->execute_status === $task::EXECUTE_STATUS_TO_DO) {
                            $class = 'label-warning';
                        } else if ($task->status === $task::EXECUTE_STATUS_IN_PROGRESS) {
                            $class = 'label-primary';
                        } else if ($task->status === $task::EXECUTE_STATUS_DONE) {
                            $class = 'label-success';
                        } else if ($task->status === $task::EXECUTE_STATUS_ON_PAUSE) {
                            $class = 'label-danger';
                        } else if ($task->status === $task::EXECUTE_STATUS_TESTING) {
                            $class = 'label-danger';
                        } else if ($task->status === $task::EXECUTE_STATUS_TESTED) {
                            $class = 'label-danger';
                        }
                        return Html::tag('span', $task->getExecuteStatusLabel(), ['class' => 'label ' . $class]);
                    } else {
                        return '';
                    }
                },
                'filter' => \common\models\Tasks::getExecuteStatuses()
            ],
            //'data:ntext',
            /*
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function (\common\models\TaskAssign $model) {
                    if ($model->status === $model::STATUS_WAITING) {
                        $class = 'label-warning';
                    } else if ($model->status === $model::STATUS_IN_PROGRESS) {
                        $class = 'label-primary';
                    } else if ($model->status === $model::STATUS_IN_DONE) {
                        $class = 'label-success';
                    }
                    return Html::tag('span', $model->getStatusLabel(), ['class' => 'label ' . $class]);
                },
                'filter' => \common\models\Employees::getStatuses()
            ],
            */
            'created_at',

            [
                'class' => '\common\components\grid\ActionColumn',
                'template' => '{update}{view}',
                'buttons' => [
                    'view' => function ($url, \common\models\TaskAssign $model, $key) {
                        // Измените URL ссылки здесь
                        $customUrl = Yii::$app->urlManager->createUrl(['my-tasks/task-view', 'task_id' => $model->task_id]);
                        return \yii\helpers\Html::a('<svg aria-hidden="true" style="display:inline-block;font-size:inherit;height:1em;overflow:visible;vertical-align:-.125em;width:1.125em" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M573 241C518 136 411 64 288 64S58 136 3 241a32 32 0 000 30c55 105 162 177 285 177s230-72 285-177a32 32 0 000-30zM288 400a144 144 0 11144-144 144 144 0 01-144 144zm0-240a95 95 0 00-25 4 48 48 0 01-67 67 96 96 0 1092-71z"></path></svg>', $customUrl, [
                            'title' => 'Подробно о задаче',
                            'data-pjax' => '0',
                            'class' => 'btn btn-sm btn-default'
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>

    <?php Panel::end() ?>
</div>
