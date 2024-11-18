<?php

use common\widgets\Panel;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DeveloperLevelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Developer Levels');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="developer-level-index">

    <?php Panel::begin([
        'title' => $this->title,
        'buttonsTemplate' => '{create}'
    ])?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name:html',
            'description:html',
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function (\common\models\DeveloperLevel $model) {
                    if ($model->status === $model::STATUS_PUBLISHED) {
                        $class = 'label-success';
                    } else if ($model->status === $model::STATUS_NOT_PUBLISHED) {
                        $class = 'label-warning';
                    }
                    return Html::tag('span', $model->getStatusLabel(), ['class' => 'label ' . $class]);
                },
                'filter' => \common\models\DeveloperLevel::getStatuses()
            ],
            'level_number',
            'created_at',
            'updated_at',

            ['class' => '\common\components\grid\ActionColumn',
                'template' => '{update}{view}{delete}'],
        ],
    ]); ?>

    <?php Panel::end() ?>

</div>