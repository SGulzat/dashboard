<?php

use common\widgets\Panel;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TaskAssignSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Task Assigns');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-assign-index">

    <?php Panel::begin([
        'title' => $this->title,
        'buttonsTemplate' => '{create}'
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
            //'data:ntext',
            [
                'attribute' => 'status_task',
                'format' => 'html',
                'value' => function (\common\models\TaskAssign $model) {
                    $class = 'label-success';

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
                'filter' => \common\models\Employees::getStatuses()
            ],
            'created_at',
            'updated_at',

            ['class' => '\common\components\grid\ActionColumn',
                'template' => '{update}{view}{delete}'],
        ],
    ]); ?>

    <?php Panel::end() ?>
</div>
