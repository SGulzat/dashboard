<?php

use common\widgets\Panel;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EmployeesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Employees');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employees-index">

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
                'attribute' => 'image',
                'format' => 'html',
                'value' => function (\common\models\Employees $model) {
                    return Html::img($model->getImgUrl(), ['width' => '100']);
                }
            ],
            'full_name',
            'email',
            'phone',
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function (\common\models\Employees $model) {
                    if ($model->status === $model::STATUS_PUBLISHED) {
                        $class = 'label-success';
                    } else if ($model->status === $model::STATUS_NOT_PUBLISHED) {
                        $class = 'label-warning';
                    }
                    return Html::tag('span', $model->getStatusLabel(), ['class' => 'label ' . $class]);
                },
                'filter' => \common\models\Employees::getStatuses()
            ],
            [
                'attribute' => 'department_id',
                'format' => 'html',
                'value' => function (\common\models\Employees $model) {
                    $depertment = \common\models\Department::findOne($model->department_id);
                    return $depertment ? $depertment->name : 'Отдел не указан';
                }
            ],
            [
                'attribute' => 'level_id',
                'format' => 'html',
                'value' => function (\common\models\Employees $model) {
                    $level = \common\models\DeveloperLevel::findOne(['id' => $model->level_id]);
                    return $level ? $level->name : 'Уровень не указан';
                }
            ],
            'created_at',
            'updated_at',

            ['class' => '\common\components\grid\ActionColumn',
                'template' => '{update}{view}{delete}'],
        ],
    ]); ?>
    <?php Panel::end() ?>

</div>
