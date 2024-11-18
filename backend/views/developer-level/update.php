<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\DeveloperLevel */

$this->title = Yii::t('backend', 'Update', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Developer Levels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="developer-level-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
