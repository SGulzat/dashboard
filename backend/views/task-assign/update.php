<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TaskAssign */

$this->title = Yii::t('backend', 'Update', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Task Assigns'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="task-assign-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
