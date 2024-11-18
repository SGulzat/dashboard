<?php

use common\widgets\Panel;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TaskAssign */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Task Assigns'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="task-assign-view">

    <?php Panel::begin([
        'title' => $this->title
    ])?>

    <p>
        <?= Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
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
            'created_at',
            'updated_at',
        ],
    ]) ?>
    <?php Panel::end() ?>
</div>
