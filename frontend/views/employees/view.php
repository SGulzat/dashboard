<?php

use common\widgets\Panel;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Employees */

$this->title = $model->full_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Employees'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="employees-view">

    <?php Panel::begin([
        'title' => $this->title
    ])?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'image',
                'format' => 'html',
                'value' => function (\common\models\Employees $model) {
                    return Html::img($model->getImgUrl(), ['width' => '200px']);
                }
            ],
            'full_name',
            'email',
            'phone',
            'username',
            'password',
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
        ],
    ]) ?>
    <?php Panel::end() ?>

</div>
