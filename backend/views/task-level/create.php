<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TaskLevel */

$this->title = Yii::t('backend', 'Create Task Level');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Task Levels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-level-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
