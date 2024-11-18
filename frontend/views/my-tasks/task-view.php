<?php

use common\widgets\Panel;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Tasks */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Tasks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tasks-view">

    <?php Panel::begin([
        'title' => $this->title
    ])?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description:html',
            'date_start',
            'date_end',
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function (\common\models\Tasks $model) {
                    if ($model->status === $model::STATUS_PUBLISHED) {
                        $class = 'label-success';
                    } else if ($model->status === $model::STATUS_NOT_PUBLISHED) {
                        $class = 'label-warning';
                    }
                    return Html::tag('span', $model->getStatusLabel(), ['class' => 'label ' . $class]);
                },
                'filter' => \common\models\Tasks::getStatuses()
            ],
            [
                'attribute' => 'department_id',
                'format' => 'html',
                'value' => function (\common\models\Tasks $model) {
                    $depertment = \common\models\Department::findOne($model->department_id);
                    return $depertment ? $depertment->name : 'Отдел не указан';
                }
            ],
            [
                'attribute' => 'level_id',
                'format' => 'html',
                'value' => function (\common\models\Tasks $model) {
                    $level = \common\models\DeveloperLevel::findOne(['level_number' => $model->level_id]);
                    return $level ? $level->name : 'Уровень не указан';
                }
            ],
            'created_at',
            'updated_at',
        ],
    ]) ?>
    <?php Panel::end() ?>
</div>
