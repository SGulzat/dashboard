<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\DeveloperLevel */

$this->title = Yii::t('backend', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Developer Levels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="developer-level-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
