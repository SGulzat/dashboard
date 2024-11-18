<?php

use yii\widgets\DetailView;
use common\widgets\Panel;

/* @var $this yii\web\View */
/* @var $model common\models\News */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('news', 'News'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-view">

    <?php Panel::begin([
        'title' => $this->title,
        'buttonsTemplate' => '{delete}{cancel}'
    ])?>
    <div class="box-body table-responsive no-padding">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'title',
                'content:ntext',
                'img',
                'status',
                'slug',
                'meta_description',
                'meta_keywords',
                'created_at',
                'updated_at',
            ],
        ]) ?>
    </div>
    <?php Panel::end() ?>

</div>
