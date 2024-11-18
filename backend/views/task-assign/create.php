<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TaskAssign */

$this->title = Yii::t('backend', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Task Assigns'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-assign-create">

    <h2>
        Выберите задачу. Задача автоматически сотруднику с помощью смарт-контракта блокчейна.
    </h2>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
