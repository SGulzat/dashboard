<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Employees */

$this->title = Yii::t('backend', 'Update', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Employees'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="employees-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'departments' => $departments,
        'developerLevels' => $developerLevels
    ]) ?>

</div>
